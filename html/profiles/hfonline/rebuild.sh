#!/bin/bash

# Replace non-core
replace_drupal_non_core () {
    NON_CORE_TEMP_DIR="drush_make_temp_non_core";
    drush make --no-core --contrib-destination=$NON_CORE_TEMP_DIR --force-complete hfonline.make -y;

    if [ ! -d $NON_CORE_TEMP_DIR ]; then
       echo "Fetching projects failed.";
       return 1;
    fi;

    echo -e "Replacing projects...\c";

    for PROJECT_TYPE in `ls $NON_CORE_TEMP_DIR`; do
      if [ ! -d "./$PROJECT_TYPE" ]; then
         mkdir -p "./$PROJECT_TYPE";
      fi;

      for PROJECT in `ls "$NON_CORE_TEMP_DIR/$PROJECT_TYPE"`; do
          rm -rf "./$DIR/$PROJECT";
          cp -R "$NON_CORE_TEMP_DIR/$PROJECT_TYPE/$PROJECT" "./$PROJECT_TYPE/";
          echo -e ".\c";
      done;
    done;
    rm -rf $NON_CORE_TEMP_DIR;
    echo -e "\nReplace non-core projects finished.";
    return 0;
}


# Options array
declare -a options
options[${#options[*]}]="Replace contribed extensions";
options[${#options[*]}]="Cancel.";

echo "Simple project rebuilder";
PS3='Please enter your choice: '
select opt in "${options[@]}"; do
    case "$REPLY" in
        1) echo "You choose to replace the contribed extensions.";
            replace_drupal_non_core;
            break;;
        4) echo "Goodbye!"; break;;
        *) echo "Invalid option. Try another one.";continue;;
    esac
done

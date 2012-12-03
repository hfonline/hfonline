#!/usr/bin/env bash

drush site-install hfonline \
	--locale=en \
	--db-url=mysql://root:admin@localhost:3306/hfonline_local \
	--clean-url=1 \
	--site-name="博思在线订餐系统" \
	--site-mail=jziwenchen@gmail.com \
	--account-name=admin \
	--account-pass=admin \
	--account-mail=jziwenchen@gmail.com -y
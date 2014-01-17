<?php
$I = new APIGuy($scenario);
$I->wantTo('register new user');

$I->haveHttpHeader("Content-Type", "appliction/x-www-form-urlencoded");
$I->sendPOST("user/post", 
        array("mail" => "jziwenchen@gmail.com", "pass" => "admin"));
$I->seeResponseCodeIs("200");
//$I->seeResponseIsJson();
$I->seeResponseContains('mail has existed already');


<?php

$I = new APIGuy($scenario);
$I->wantTo("Add new address");

$I->sendPOST("user/addaddress", array(
    "address" => "hello world",
));

$I->haveHttpHeader("Content-Type", "appliction/x-www-form-urlencoded");

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains("success");


<?php

$I = new APIGuy($scenario);
$I->wantTo("User address");

$I->sendGET("user/address");

//$I->seeResponseCodeIs(200);
//$I->seeResponseIsJson();
$I->seeResponseContains("success");


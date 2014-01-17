<?php
$I = new APIGuy($scenario);
$I->wantTo('perform actions and see result');
$I->sendGET("user/list");
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains('"success":true');
$I->seeResponseContains("total");

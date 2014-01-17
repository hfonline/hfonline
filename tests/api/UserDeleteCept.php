<?php
$I = new APIGuy($scenario);
$I->sendPost("user/delete", array(
    "user_id" => 1
));
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains("success");
$I->wantTo('perform actions and see result');

<?php
$I = new APIGuy($scenario);
$I->sendPost("user/delete", array(
    "user_id" => 15
));
$I->seeResponseCodeIs(200);
//$I->seeResponseIsJson();
$I->seeResponseContains("success");

<?php
$I = new APIGuy($scenario);
$I->wantTo('perform actions and see result');
$I->sendGET("user/list", array(
    "role" => 3
));
//$I->seeResponseCodeIs(200);
//$I->seeResponseIsJson();
$I->seeResponseContains('jziwenchen@gmail.com');
//$I->seeResponseContains("total");

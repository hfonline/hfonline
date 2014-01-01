<?php

$http = "http://hfonlineadmin.local/user/post";
$req = curl_init();

curl_setopt($req, CURLOPT_POST, TRUE);
curl_setopt($req, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($req, CURLOPT_URL, $http);
curl_setopt($req, CURLOPT_POSTFIELDS, array(
    "name" => "admin",
    "pass" => "admin",
    "mail" => "admin@admin.com",
    "phone" => "15821121753",
    "avatar" => "http://xxx.com/image.png",
));

$res = curl_exec($req);

echo $res;

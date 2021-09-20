<?php
function GetPost($accessToken)
{
    $url = 'https://api.instagram.com/v1/users/self/media/recent?access_token=' . $accessToken;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = json_decode(curl_exec($ch), true);

    curl_close($ch);

    return $data;
}
$result = GetPost('IGQVJWeTlkWExDWHN1Y3c0YnFvSHk2VnRnSm1rR2lKVFNGMVdlOGc1ODhaeGticl96ay1jcmhMWXBHSFFvUTRlMGhXMm4tSFAySXhQSU5qMnB0MndfWjR1RTBBT2daSndlTEo1TmZAxOElfUjlEYWxxOQZDZD');
var_dump($result);

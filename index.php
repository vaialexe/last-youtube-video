<?php

    require_once("Mobile_Detect.php");
    $key = "YOUTUBE_API_KEY"; // INSERT YOUTUBE DATA API KEY
    $channelId = "CHANNEL_ID"; // INSERT YOUR YOUTUBE CHANNEL ID, LIKE "UCpqYAzgbclBfP1RzH6z7QUw"
    $defaultVideo = "-FS5INturoY"; // THIS IS A VIDEO THAT WILL BE OPEN IF THE YOUTUBE API KEY DOESN'T WORK

    $videoID = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=".$channelId."&maxResult=1&key=".$key), true)["items"]["0"]["id"]["videoId"];
    if (empty($videoID)) $videoID = $defaultVideo;

    $detect = new Mobile_Detect;
    if ($detect->isiOS()) header("location: youtube://".$videoID);
    else if ($detect->isMobile() && ($detect->isChrome() || $detect->isTablet())) header("location: intent://".$videoID."/#Intent;scheme=vnd.youtube;package=com.google.android.youtube;S.browser_fallback_url=market://details?id=com.google.android.youtube;end;");
    else header("location: https://youtube.com/watch?v=".$videoID);

?>

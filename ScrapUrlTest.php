<?php
    include './ScrapUrl.php';
    set_time_limit(86400);
    $url = $_POST['url'];
    $scrap = new ScrapUrl($url);
    
        


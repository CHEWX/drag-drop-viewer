<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>Drag Drop Viewer</title>
    <meta name="description" content="">

    <!--<link rel="dns-prefetch" href="//ajax.googleapis.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//fast.fonts.net">-->

    <link rel="icon" type="image/png" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--<link rel="stylesheet" href="assets/css/main.css">-->
    <!--[if lt IE 9]> <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script> <![endif]-->

    <style type="text/css">
        body {
            padding: 0;
            margin: 0;
            text-align: center;
            font-family: arial;
            font-size: 14px;
        }

        .l-main {
            width: 100%;
        }

        ul {
            position: fixed;
            left: 0;
            top: 45%;
            margin: 0;
            padding: 15px 0;
            background-color: rgba(255, 255, 255, .9);
            border-top: 1px dotted #666666;
            border-bottom: 1px dotted #666666;
        }

        ul li {
            display: block;
            list-style: none;
        }

        li.active a {
            color: #999999;
        }

        a {
            padding: 10px 40px;
            text-transform: uppercase;
            display: block;
            text-decoration: none;
            color: #010101;
            text-align: left;
        }

        a:hover {
            color: #666666;
        }
    </style>
</head>
<body>

    <?php

    if(isset($_GET['site'])) {
        $site = $_GET['site'];
    }

    $directory = 'sites/' . $site . '/';

    if(is_dir($directory)) {

        // Check if the directory exists
        if($handle = opendir($directory)) {
            // Check if its able to open the directory
            $images = array();

            // Loop through files
            while(false !== ($entry = readdir($handle))) {
                if($entry != '.' && $entry != '..') {

                    // If the file exists store it in array
                    // Build the full file path
                    $images[] = '/' . $directory . $entry;
                }
            }

            // Close directory and sort array
            closedir($handle);
            sort($images);

            //print_r($images);

            // Check if images exists and loop through them
            if(!empty($images)) {

                // Only display menu if site is set
                if(isset($_GET['site'])) {

                    echo '<ul>';
                    // Loop for menu
                    foreach($images as $image) {

                        $file_name = pathinfo($image);

                        ?>

                        <li<?php if(isset($_GET['page']) && $_GET['page'] == $file_name['filename']) { echo ' class="active"'; } ?>><a href="/?site=<?php echo $site; ?>&page=<?php echo $file_name['filename']; ?>"><?php echo str_replace('-', ' ', $file_name['filename']); ?></a></li>

                        <?php
                    }

                    echo '</ul>';

                }

                // Loop for pages
                foreach($images as $image) {

                    $file_name = pathinfo($image);
                    $size = getimagesize(substr($image, 1));

                    // Create switch for each page
                    switch($_GET['page']) {

                        case $file_name['filename'] :

                            echo '<main class="l-main" style="background: url(' . $image . ') top center no-repeat; height: ' . $size[1] . 'px;"></main>';

                        break;

                    }

                }
            }
        }
    }

    ?>

    <?php /*
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/jquery-1.10.1.min.js"><\/script>')</script>

    <?php if(strstr($_SERVER['HTTP_HOST'], "8888")!=false) { ?>
        <script src="assets/js/libs/modernizr.js"></script>
        <script src="assets/js/src/global.js"></script>
    <?php } else { ?>
        <script src="assets/js/main.js"></script>
    <?php } ?>
    */ ?>

    <!-- Google Analytics here -->

</body>
</html>
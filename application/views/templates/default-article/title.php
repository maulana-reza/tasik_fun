<?php
$uri_string = uri_string();
if (!@$page_title) {
    switch (true) {
        case $uri_string=="auth/login":
            echo "Login";
            break;
        default :
            $text = str_ireplace("_", " ", $uri_string);
            $text = str_ireplace("/", " >> ", $text);
            echo ucwords($text);
            break;
    }
} else {
    echo $page_title;
}
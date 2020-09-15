<?php
session_start();

if (isset($_SESSION['code']) && isset($_POST['entered_code'])) {
    if ($_SESSION['code'] == $_POST['entered_code']) {
        echo 1;
    } else {
        echo 0;
    }
}
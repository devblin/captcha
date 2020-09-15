<?php
session_start();
if (isset($_SESSION['code']) && isset($_POST['enteredcode'])) {
    if ($_SESSION['code'] == $_POST['enteredcode']) {
        echo 1;
    } else {
        echo 0;
    }
}
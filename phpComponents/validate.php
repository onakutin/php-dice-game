<?php

$_SESSION = [];
$valid = true;

if (!is_numeric($numberOfDice)) {
    $valid = false;
    $errors[] = "Number of dice must be a number";
}

if ($numberOfDice > 10) {
    $valid = false;
    $errors[] = "Max 10 dice possible";
}

if (!$valid) {
    $_SESSION['errors'] = $errors;
    $_SESSION['request_data'] = $_POST;
    header('Location: http://www.exercises.test/exercises/php-dice-throwing-game/');
    exit();
}

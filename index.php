<?php
require_once 'Dice4.php';
require_once 'Dice6.php';
require_once 'Dice8.php';
require_once 'Dice9.php';
require_once 'Dice10.php';
require_once 'Dice20.php';

session_start();


$errors = [];
$request_data = [];

if ($_POST) {
    $_SESSION['request_data'] = $_POST;
}

$errors = $_SESSION['errors'] ?? [];
// $request_data = $_SESSION['request_data'] ?? [];
$requestedNumberOfDice = $_SESSION['request_data']['dice'] ?? 0;

// var_dump($_SESSION);

$numberOfDice = $_POST['dice'] ?? 0;

$allDiceSides = [];

if ($numberOfDice > 0) {
    for ($i = 1; $i <= $numberOfDice; $i++) {
        $allDiceSides[] = $_SESSION['request_data']['sides' . $i] ?? '6';
    }
}

var_dump($allDiceSides);

// var_dump($requestedNumberOfSides1);

$_SESSION = [];

$valid = true;

if (!is_numeric($numberOfDice) && $numberOfDice != null) {
    $valid = false;
    $errors[] = "Number of dice must be a number";
}



if (!$valid) {
    $_SESSION['errors'] = $errors;
    $_SESSION['request_data'] = $_POST;
    header('Location: http://www.exercises.test/exercises/php-dice-throwing-game/');
    exit();
}



$allDice = [];

if (count($allDiceSides) > 0) {

    for ($i = 0; $i < $numberOfDice; $i++) {
        switch ($allDiceSides[$i]) {
            case '4':
                $allDice[] = new Dice4;
                break;
            case '8':
                $allDice[] = new Dice8;
                break;
            case '9':
                $allDice[] = new Dice9;
                break;
            case '10':
                $allDice[] = new Dice10;
                break;
            case '20':
                $allDice[] = new Dice20;
                break;

            default:
                $allDice[] = new Dice6;
                break;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dice throwing</title>
</head>

<body>
    <?php if ($errors) : ?>
        <span>
            <?= $errors[0] ?>
        </span>
    <?php endif; ?>
    <form action="" method="post">
        <label>Number of dice:
            <input type="text" name="dice" placeholder="Enter a number" value=<?= $requestedNumberOfDice ?>>
        </label>
        <button>Update</button>
    </form>


    <?php if ($numberOfDice > 0) : ?>
        <form action="" method="post">

            <label>Selected number of dice
                <input type="text" name="dice" value=<?= $numberOfDice ?> readonly>
            </label>
            <?php for ($i = 0; $i < $numberOfDice; $i++) : ?>
                <label>Number of sides
                    <select name="sides<?= $i + 1 ?>">
                        <option value="4" <?php if ($allDiceSides[$i] === '4') : ?> <?= 'selected' ?> <?php endif; ?>>4</option>
                        <option value="6" <?php if ($allDiceSides[$i] === '6') : ?> <?= 'selected' ?> <?php endif; ?>>6</option>
                        <option value="8" <?php if ($allDiceSides[$i] === '8') : ?> <?= 'selected' ?> <?php endif; ?>>8</option>
                        <option value="9" <?php if ($allDiceSides[$i] === '9') : ?> <?= 'selected' ?> <?php endif; ?>>9</option>
                        <option value="10" <?php if ($allDiceSides[$i] === '10') : ?> <?= 'selected' ?> <?php endif; ?>>10</option>
                        <option value="20" <?php if ($allDiceSides[$i] === '20') : ?> <?= 'selected' ?> <?php endif; ?>>20</option>
                    </select>
                </label>
            <?php endfor; ?>
            <button>ROLL</button>
        </form>
    <?php endif; ?>
    <span>
        <?php foreach ($allDice as $dice) : ?>
            <?= $dice ?>
        <?php endforeach ?>
    </span>
</body>

</html>
<?php
require_once './lib/bootstrap.php';

session_start();

$errors = [];
$errors = $_SESSION['errors'] ?? [];
$request_data = $_SESSION['request_data'] ?? [];
$allDiceSides = []; // individual dice's number of sides

//number of dice after the first (and every Update) post - not used for rolling
$numberOfDice = $_POST['dice'] ?? 0;

// empty session and validate
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


// if the number of sides of each dice has been selected, put them into session ...
if (isset($_POST['sides1'])) {
    $_SESSION['request_data'] = $_POST;

    //... and into variable to be used for rolling
    for ($i = 1; $i <= $numberOfDice; $i++) {
        $allDiceSides[] = $_SESSION['request_data']['sides' . $i];
    }

    // if the number of sides of each dice has not been selected, set default 6
    // if number of dice is 0, the $allDiceSides will be []    
} elseif (is_numeric($numberOfDice)) {
    for ($i = 1; $i <= $numberOfDice; $i++) {
        $allDiceSides[] = '6';
    }
}

// VALUE TO USE TO FILL THE INPUT AFTER RETURNING
// if number of dice input was validated as valid, i have post
if ($_POST) {
    $requestedNumberOfDice = $_POST['dice'];
} else {

    // ... otherwise I take the value coming from the previous session
    // (at the render I have neither post nor session => 0)
    $requestedNumberOfDice = $request_data['dice'] ?? 0;
}

$allDice = [];

// if post includes more than only dice, e.i. also sides of dice have been selected
// create the defined dice (could be done with one class only)
if (count($_POST) > 1) {

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
    <!-- display errors if any -->
    <?php if ($errors) : ?>
        <span>
            <?= $errors[0] ?>
        </span>
    <?php endif; ?>
    <form action="" method="post">
        <label>Number of dice:
            <input type="text" name="dice" placeholder="Enter a number" value=<?= $requestedNumberOfDice ?? 0 ?>>
        </label>
        <button>Update</button>
    </form>

    <!-- this is displayed only after 'Update' is pressed -->
    <?php if ($numberOfDice > 0) : ?>
        <form action="" method="post">

            <label>Selected number of dice
                <input type="text" name="dice" value=<?= $numberOfDice ?> readonly>
            </label><br>
            <?php for ($i = 0; $i < $numberOfDice; $i++) : ?>
                <label>Number of sides
                    <select name="sides<?= $i + 1 ?>">
                        <!-- default option remains the one previously selected or 6 -->
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
    <!-- dice are rolled only after 'ROLL' is pressed -->
    <span>
        <?php foreach ($allDice as $dice) : ?>
            <?= $dice ?>
        <?php endforeach ?>
    </span>
</body>

</html>
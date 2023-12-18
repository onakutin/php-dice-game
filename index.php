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

include './phpComponents/validate.php';

// if the number of sides of each dice has been selected, put them into session
require_once './phpComponents/selectSides.php';

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

require_once './phpComponents/createDice.php';

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
        <?php include './htmlComponents/roll.php' ?>
    <?php endif; ?>
    <!-- dice are rolled only after 'ROLL' is pressed -->
    <span>
        <?php foreach ($allDice as $dice) : ?>
            <?= $dice ?>
        <?php endforeach ?>
    </span>
</body>

</html>
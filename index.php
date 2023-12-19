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
// create the defined dice (could be done with one class only)
if (count($_POST) > 1) {

    for ($i = 0; $i < $numberOfDice; $i++) {
        $diceName = 'Dice' . $allDiceSides[$i];
        $allDice[] = new $diceName;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Throw Dice</title>
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <main>
        <h1>GOOD LUCK!</h1>
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
        <span class="dice-roll">
            <?php foreach ($allDice as $dice) : ?>
                <button class="dice" style="background-color: <?= $dice->getDiceCollor() ?>">
                    <?= $dice->roll() ?>
                </button>
            <?php endforeach ?>
        </span>
    </main>
    <?php include './htmlComponents/statistics.php' ?>
</body>

</html>
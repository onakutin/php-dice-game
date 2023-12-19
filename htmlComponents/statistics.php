<?php

// get all rolls grouped by the dice
foreach ($sidesPosValues as $side) {
    $rollsByDice[$side] =
        DB::select("
    SELECT value
    FROM rolls
    WHERE nr_of_sides = $side");
}

// get count of each score for every dice and sort them desc
foreach ($sidesPosValues as $side) {
    for ($i = 1; $i <= $side; $i++) {
        $rollsByValue[$side][$i] = [];
        $rollsByValue[$side][$i] = count(DB::select("
        SELECT value
        FROM rolls
        WHERE nr_of_sides = $side AND value = $i"));
    }
    arsort($rollsByValue[$side]);
}

?>

<footer>
    <h4>
        Some statistics
    </h4>
    <p>
        Number of total rolls since ever: <?= Roll::getAllRolls() ?>
    </p>
    <h6>
        By dice:
    </h6>
    <div class="stats__by-dice">
        <?php foreach ($sidesPosValues as $dice) : ?>
            <h6>
                <?= $dice ?>
            </h6>
        <?php endforeach ?>
    </div>
    <div class="stats__by-dice">
        <?php foreach ($rollsByDice as $roll) : ?>
            <p>
                <?= count($roll) ?>
            </p>
        <?php endforeach ?>
    </div>
    <p>
        Most frequent scores (occurance):
    </p>
    <div class="stats__by-dice">
        <?php foreach ($rollsByValue as $value) : ?>
            <p>
                <?= key($value) . ' (' . reset($value) . ')' ?>
            </p>
        <?php endforeach ?>
    </div>

</footer>
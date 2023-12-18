<?php

$dicePosValues = ['4', '6', '8', '9', '10', '20'];

?>

<form class="dice-select" action="" method="post">

    <!-- the 'dice' value to be sent with the second post 'ROLL' -->
    <label>
        <input type="text" name="dice" value=<?= $numberOfDice ?> hidden>
    </label><br>

    <button class="roll-btn">ROLL</button>

    <h2>Number of sides</h2>
    <div class="dice-select__dice">
        <?php for ($i = 0; $i < $numberOfDice; $i++) : ?>
            <select class="side-select-menu" name="sides<?= $i + 1 ?>">
                <!-- default option remains the one previously selected or 6 -->

                <?php foreach ($dicePosValues as $value) : ?>
                    <option value="<?= $value ?>" <?php if ($allDiceSides[$i] === $value) : ?> <?= 'selected' ?> <?php endif; ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        <?php endfor; ?>
    </div>
</form>
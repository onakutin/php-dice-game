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
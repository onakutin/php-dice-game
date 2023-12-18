<?php

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

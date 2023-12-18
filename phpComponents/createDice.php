<?php

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

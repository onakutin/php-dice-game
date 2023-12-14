<?php
require_once 'Dice.php';

class Dice4 extends Dice
{
    public ?int $sides = 4;

    public function __construct()
    {
    }

    public function roll(): int
    {
        return rand(1, $this->sides);
    }
}

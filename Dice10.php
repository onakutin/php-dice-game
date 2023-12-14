<?php
require_once 'Dice.php';

class Dice10 extends Dice
{
    public ?int $sides = 10;

    public function __construct()
    {
    }

    public function roll(): int
    {
        return rand(1, $this->sides);
    }
}

<?php
require_once 'Dice.php';

class Dice6 extends Dice
{
    public ?int $sides = 6;

    public function __construct()
    {
    }

    public function roll(): int
    {
        return rand(1, $this->sides);
    }
}

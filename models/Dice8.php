<?php
require_once 'Dice.php';

class Dice8 extends Dice
{
    public ?int $sides = 8;

    public function __construct()
    {
    }

    public function roll(): int
    {
        return rand(1, $this->sides);
    }
}

<?php
require_once 'Dice.php';

class Dice9 extends Dice
{
    public ?int $sides = 9;

    public function __construct()
    {
    }

    public function roll(): int
    {
        return rand(1, $this->sides);
    }
}

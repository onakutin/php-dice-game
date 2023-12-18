<?php
require_once 'Dice.php';

class Dice20 extends Dice
{
    public ?int $sides = 20;

    public function __construct()
    {
    }

    public function roll(): int
    {
        return rand(1, $this->sides);
    }
}

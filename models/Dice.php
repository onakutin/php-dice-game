<?php
require_once 'Roll.php';
class Dice
{
    public ?int $sides = null;


    public function __construct()
    {
    }

    public function roll(): int
    {
        $newValue = rand(1, $this->sides);
        $roll = new Roll;
        $roll->value = $newValue;
        $roll->number_of_sides = $this->sides;
        $roll->insert();

        return $newValue;
    }

    public function getDiceCollor()
    {
        $diceCollors = ['#0000ff', '#a52a2a', '#ffffff', '#f0f8ff', '#e43629', '#e4d829', '#2fe429', '#295be4', '#6e6c6d', '#6eb3c4'];
        return $diceCollors[rand(0, count($diceCollors) - 1)];
    }
}

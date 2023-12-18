<?php

class Dice
{
    public ?int $sides = null;

    public function __construct()
    {
    }

    public function roll(): int
    {
        return rand(1, $this->sides);
    }

    public function __toString()
    {
        return "<div style='height: 30px; width: 30px; display: inline-block; text-align: center; border: 1px solid black; font-size: 24px; line-height: 30px;'>
    {$this->roll()}
    </div>";
    }
}

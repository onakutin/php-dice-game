<?php

class Roll
{
    public ?int $id = null;
    public ?int $value = null;
    public ?int $number_of_sides = null;

    public function insert()
    {
        DB::insert("INSERT INTO rolls (value,nr_of_sides) VALUES (?,?)", [$this->value, $this->number_of_sides]);

        $this->id = DB::getPdo()->lastInsertId();
    }

    public static function getAllRolls()
    {
        $totalRolls = DB::select("SELECT * FROM rolls");
        return count($totalRolls);
    }
}

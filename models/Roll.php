<?php

class Roll
{
    public ?int $id = null;
    public ?int $value = null;
    public ?int $number_of_sides = null;

    public function insert()
    {
        DB::insert("INSERT INTO 'rolls' ('id','value','number_of_sides')
            VALUES (?,?)", [$this->value, $this->number_of_sides]);

        $this->id = DB::getPdo()->lastInsertId();
    }
}

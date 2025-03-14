<?php

namespace Model;

class Hotels extends BaseModel
{
    public const TABLE = 'hotels';

    public $id;
    public $name;
    public $stars;
    public $city_id;
}

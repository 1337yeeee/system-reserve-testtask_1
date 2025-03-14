<?php

namespace Model;

class Cities extends BaseModel
{
    public const TABLE = 'cities';

    public $id;
    public $name;
    public $country_id;
}

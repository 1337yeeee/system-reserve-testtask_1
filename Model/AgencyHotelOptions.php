<?php

namespace Model;

class AgencyHotelOptions extends BaseModel
{
    public const TABLE = 'agency_hotel_options';

    public $id;
    public $hotel_id;
    public $agency_id;
    public $percent;
    public $is_black;
    public $is_recomend;
    public $is_white;
}

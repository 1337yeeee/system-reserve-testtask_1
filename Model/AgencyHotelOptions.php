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
    public ?Agencies $agency = null;

    /**
     * @param \Model\Agencies $agency
     * @return void
     */
    public function setAgency(Agencies $agency): void
    {
        $this->agency = $agency;
    }

    /**
     * @return Agencies|null
     */
    public function getAgency(): ?Agencies
    {
        return $this->agency;
    }
}

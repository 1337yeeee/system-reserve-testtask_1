<?php

namespace Model;

class Hotels extends BaseModel
{
    public const TABLE = 'hotels';

    public $id;
    public $name;
    public $stars;
    public $city_id;

    public ?Cities $city = null;

    /**
     * @var AgencyHotelOptions[]
     */
    public array $agencyOptions = [];

    /**
     * @var HotelAgreements[]
     */
    public array $agreements = [];

    public function setCity(Cities $city) {
        $this->city = $city;
    }

    /**
     * @param AgencyHotelOptions[] $agencyOptions
     * @return void
     */
    public function setAgencyOptions(array $agencyOptions): void
    {
        $this->agencyOptions = [];
        foreach ($agencyOptions as $option) {
            if ($option instanceof AgencyHotelOptions) {
                $this->agencyOptions[] = $option;
            }
        }
    }

    /**
     * @return AgencyHotelOptions[]
     */
    public function getAgencyOptions(): array
    {
        return $this->agencyOptions;
    }

    /**
     * @param HotelAgreements[] $agreements
     * @return void
     */
    public function setAgreements(array $agreements): void
    {
        $this->agreements = [];
        foreach ($agreements as $agreement) {
            if ($agreement instanceof HotelAgreements) {
                $this->agreements[] = $agreement;
            }
        }
    }

    /**
     * @return HotelAgreements[]
     */
    public function getAgreements(): array
    {
        return $this->agreements;
    }

    public static function fromHotel(Hotels $hotel)
    {
        $arguments = [];

        foreach (get_object_vars($hotel) as $var => $val) {
            $arguments[$var] = $val;
        }

        return new self($arguments);
    }
}

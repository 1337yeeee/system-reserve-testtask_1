<?php

namespace Model;

class FullHotel extends Hotels
{
    /**
     * @var AgencyHotelOptions[]
     */
    public array $agencyOptions = [];

    /**
     * @var HotelAgreements[]
     */
    public array $agreements = [];

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

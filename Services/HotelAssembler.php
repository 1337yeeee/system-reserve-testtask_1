<?php

namespace Services;

use Model\Hotels;
use Model\FullHotel;
use Repository\AgencyOptionsRepository;
use Repository\AgencyRepository;
use Repository\CityRepository;
use Repository\HotelAgreementsRepository;
use Repository\HotelsRepository;

class HotelAssembler
{
    private FullHotel $hotel;

    public function __construct(
        private HotelsRepository $hotelsRepository,
        private CityRepository $cityRepository,
        private HotelAgreementsRepository $hotelAgreementsRepository,
        Hotels $hotel
    ) {
        $this->hotel = FullHotel::fromHotel($hotel);
    }

    /**
     * @return FullHotel
     */
    public function assemble(): FullHotel
    {
        $this->assembleCity();
        $this->assembleAgreements();
        return $this->hotel;
    }

    /**
     * @return void
     */
    private function assembleCity(): void
    {
        if (isset($this->hotel->city)) return;
        $city = $this->cityRepository->find($this->hotel->city_id);
        $this->hotel->city = $city;
    }

    private function assembleAgreements(): void
    {
        if (isset($this->hotel->agreements)) return;
        $agreements = $this->hotelAgreementsRepository->findAllByHotelId($this->hotel->id);
        $this->hotel->setAgreements($agreements);
    }

}

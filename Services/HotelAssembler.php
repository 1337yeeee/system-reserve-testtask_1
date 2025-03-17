<?php

namespace Services;

use Model\Hotels;
use Model\FullHotel;
use Repository\AgencyOptionsRepository;
use Repository\AgencyRepository;
use Repository\CityRepository;
use Repository\HotelsRepository;

class HotelAssembler
{
    private FullHotel $hotel;

    public function __construct(
        private HotelsRepository $hotelsRepository,
        private AgencyRepository $agencyRepository,
        private AgencyOptionsRepository $agencyOptionsRepository,
        private CityRepository $cityRepository,
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
        $this->assembleAgenciesAndOptions();

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

    private function assembleAgenciesAndOptions(): void
    {
        $agencies = $this->getAgencies();
        $agencyOptions = $this->getAgencyOptions();
        foreach ($agencyOptions as $option) {
            $agency = $agencies[$option->agency_id] ?? null;
            if ($agency !== null) {
                $option->setAgency($agency);
            }
        }
        $this->hotel->setAgencyOptions($agencyOptions);
    }

    private function getAgencies(): array
    {
        $agencies_ = $this->agencyRepository->findAllByHotelId($this->hotel->id);
        $agencies = [];
        foreach ($agencies_ as $agency) {
            $agencies[$agency->id] = $agency;
        }
        return $agencies;
    }

    private function getAgencyOptions(): array
    {
        $agencies = $this->agencyOptionsRepository->findAllByHotelId($this->hotel->id);
        return $agencies;
    }

}

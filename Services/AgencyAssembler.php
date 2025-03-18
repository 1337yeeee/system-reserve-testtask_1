<?php

namespace Services;

use Model\Hotels;
use Model\Agencies;
use Model\AgencyHotelOptions;
use Repository\AgencyRepository;
use Repository\AgencyOptionsRepository;

class AgencyAssembler
{
    /** @var Agencies[] */
    private array $agencies;

    /** @var AgencyHotelOptions[] */
    private array $options;

    public function __construct(
        private AgencyRepository $agencyRepository,
        private AgencyOptionsRepository $agencyOptionsRepository,
        private Hotels $hotel
    ) {
        // pass
    }

    public function asseble(): array
    {
        $this->getAgencies();
        $this->getAgencyOptions();

        $options = [];

        foreach ($this->options as $option) {
            if (empty($options[$option->agency_id])) {
                $options[$option->agency_id] = [$option];
            } else {
                $options[$option->agency_id][] = $option;
            }
        }

        foreach ($this->agencies as $agency) {
            $_options = $options[$agency->id];
            if (is_array($_options)) {
                $agency->setOptions($_options);
            }
        }

        return $this->agencies;
    }

    public function setAgencies(array $agencies)
    {
        $this->agencies = $agencies;
    }

    private function getAgencies(): array
    {
        if (empty($agencies)) {
            $this->agencies = $this->agencyRepository->findAllByHotelId($this->hotel->id);
        }
        return $this->agencies;
    }

    private function getAgencyOptions(): array
    {
        if (empty($options)) {
            $this->options = $this->agencyOptionsRepository->findAllByHotelId($this->hotel->id);
        }
        return $this->options;
    }
}

<?php

namespace Services;

use Model\Agencies;
use Model\AgencyHotelOptions;

class AgencyAssembler
{
    /** @var Agencies[] */
    private array $agencies;

    /** @var AgencyHotelOptions[] */
    private array $options;

    public function __construct(array $agencies, array $options)
    {
        $this->options = $options;
        $this->agencies = $agencies;
    }

    public function asseble(): array
    {
        $options = [];

        foreach ($this->options as $option) {
            $options[$option->agency_id] = $option;
        }

        foreach ($this->agencies as $agency) {
            $_options = $options[$agency->id];
            if (is_array($_options)) {
                $agency->setOptions($_options);
            }
        }

        return $this->agencies;
    }
}

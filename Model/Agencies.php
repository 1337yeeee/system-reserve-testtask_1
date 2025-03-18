<?php

namespace Model;

class Agencies extends BaseModel
{
    public const TABLE = 'agencies';

    public $id;
    public $name;
    
    /** @var AgencyHotelOptions[] */
    private array $options = [];

    /**
     * @param AgencyHotelOptions[] $options
     * @return void
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return AgencyHotelOptions[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}

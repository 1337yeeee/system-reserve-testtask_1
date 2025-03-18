<?php

namespace Services\RuleOptionsResolvers;

use Model\Hotels;
use Model\AgencyRulesOptions;
use Model\AgencyHotelOptions;

interface RuleOptionResolver
{
    public const OPERANDS = [];

    public function __construct(Hotels $hotel, AgencyHotelOptions $agencyOption, AgencyRulesOptions $option);
    public function resolve(): bool;
    public function checkOperand(): bool;
}

<?php

namespace Services\RuleOptionsResolvers;

use Model\Hotels;
use Model\AgencyRulesOptions;

interface RuleOptionResolver
{
    public const OPERANDS = [];

    public function __construct(Hotels $hotel, AgencyRulesOptions $option);
    public function resolve(): bool;
    public function checkOperand(): bool;
}

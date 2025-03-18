<?php

namespace Services\RuleOptionsResolvers;

use InvalidArgumentException;
use Model\AgencyHotelOptions;
use Model\Hotels;
use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;

abstract class BaseRuleOptionResolver implements RuleOptionResolver
{
    public function __construct(
        protected Hotels $hotel,
        protected AgencyHotelOptions $agencyOption,
        protected AgencyRulesOptions $option
    ) {
        if ($this->hotel->id !== $this->agencyOption->hotel_id) {
            throw new InvalidArgumentException('AgencyHotelOptions.hotel_id is not equal to Hotels.id');
        }
    }

    /**
     * @param \Enums\ComparisonOperatorsEnum $comparisonOperator
     * @param mixed $valueTocompare
     * @return bool
     */
    public function compare(ComparisonOperatorsEnum $comparisonOperator, $valueTocompare) {
        return match ($comparisonOperator) {
            ComparisonOperatorsEnum::Equal => (string) $valueTocompare === (string) $this->option->value,
            ComparisonOperatorsEnum::Grater => $valueTocompare > $this->option->value,
            ComparisonOperatorsEnum::GraterOrEqual => $valueTocompare >= $this->option->value,
            ComparisonOperatorsEnum::Less => $valueTocompare < $this->option->value,
            ComparisonOperatorsEnum::LessOrEqual => $valueTocompare <= $this->option->value,
            ComparisonOperatorsEnum::NotEqual => (string) $valueTocompare !== (string) $this->option->value,
        };
    }

    /**
     * @return bool
     */
    public function checkOperand(): bool
    {
        return in_array($this->option->comparison_operator, static::OPERANDS);
    }

    public function compareAll(ComparisonOperatorsEnum $comparisonOperator, array $array, string $getterMethod): bool
    {
        foreach ($array as $element) {
            $compered = $this->compare($comparisonOperator, $element->{$getterMethod}());
            if ($compered === false) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param \Enums\ComparisonOperatorsEnum $comparisonOperator
     * @param array $array
     * @param string|array<string> $getterMethod
     * @return bool
     */
    public function compareAny(ComparisonOperatorsEnum $comparisonOperator, array $array, $getterMethod): bool
    {
        foreach ($array as $element) {
            if (is_array($getterMethod)) {
                foreach ($getterMethod as $method) {
                    if ($this->compare($comparisonOperator, $element->{$method}())) {
                        return true;
                    }
                }

            } else {
                if ($this->compare($comparisonOperator, $element->{$getterMethod}())) {
                    return true;
                }
            }
        }
        return false;
    }
}

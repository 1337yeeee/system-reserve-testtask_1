<?php

namespace Services\RuleOptionsResolvers;

use Enums\ComparisonOperatorsEnum;

abstract class BaseRuleOptionResolver implements RuleOptionResolver
{
    public function __construct(
        protected \Model\Hotels $hotel,
        protected \Model\AgencyRulesOptions $option
    ) {
        // pass
    }

    /**
     * @param \Enums\ComparisonOperatorsEnum $comparisonOperator
     * @param mixed $valueTocompare
     * @return bool
     */
    public function compare(ComparisonOperatorsEnum $comparisonOperator, $valueTocompare) {
        return match ($comparisonOperator) {
            ComparisonOperatorsEnum::Equal => $valueTocompare === $this->option->value,
            ComparisonOperatorsEnum::Grater => $valueTocompare > $this->option->value,
            ComparisonOperatorsEnum::GraterOrEqual => $valueTocompare >= $this->option->value,
            ComparisonOperatorsEnum::Less => $valueTocompare < $this->option->value,
            ComparisonOperatorsEnum::LessOrEqual => $valueTocompare <= $this->option->value,
            ComparisonOperatorsEnum::NotEqual => $valueTocompare !== $this->option->value,
        };
    }

    /**
     * @return bool
     */
    public function checkOperand(): bool
    {
        return in_array($this->option->comparison_operator, static::OPERANDS);
    }
}

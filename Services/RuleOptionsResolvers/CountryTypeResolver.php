<?php

namespace Services\RuleOptionsResolvers;

use Enums\ComparisonOperatorsEnum;

class CountryTypeResolver extends BaseRuleOptionResolver
{
    public const OPERANDS = [
        ComparisonOperatorsEnum::Equal,
        ComparisonOperatorsEnum::NotEqual,
    ];

    public function resolve(): bool
    {
        return $this->checkOperand()
            && $this->compare($this->option->comparison_operator, $this->hotel->city?->country_id);
    }
}

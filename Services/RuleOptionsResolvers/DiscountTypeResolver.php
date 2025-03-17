<?php

namespace Services\RuleOptionsResolvers;

use Enums\ComparisonOperatorsEnum;

class DiscountTypeResolver extends BaseRuleOptionResolver
{
    public const OPERANDS = [
        ComparisonOperatorsEnum::Equal,
        ComparisonOperatorsEnum::NotEqual,
        ComparisonOperatorsEnum::Grater,
        ComparisonOperatorsEnum::Less,
    ];

    public function resolve(): bool
    {
        return $this->checkOperand();
            // && $this->compare($this->option->comparison_operator, $this->hotel->discount);
    }
}

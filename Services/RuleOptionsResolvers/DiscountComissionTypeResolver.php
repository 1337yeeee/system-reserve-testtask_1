<?php

namespace Services\RuleOptionsResolvers;

use Enums\ComparisonOperatorsEnum;

class DiscountComissionTypeResolver extends BaseRuleOptionResolver
{
    public const OPERANDS = [
        ComparisonOperatorsEnum::Equal,
        ComparisonOperatorsEnum::NotEqual,
        ComparisonOperatorsEnum::Grater,
        ComparisonOperatorsEnum::Less,
    ];

    public function resolve(): bool
    {
        return $this->checkOperand()
            && (
                1
                // $this->compare($this->option->comparison_operator, $this->hotel->discount)
                // || $this->compare($this->option->comparison_operator, $this->hotel->comission)
            );
    }
}

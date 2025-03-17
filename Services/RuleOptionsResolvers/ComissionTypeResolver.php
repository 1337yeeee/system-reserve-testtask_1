<?php

namespace Services\RuleOptionsResolvers;

use Enums\ComparisonOperatorsEnum;

class ComissionTypeResolver extends BaseRuleOptionResolver
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
            && $this->compareAny($this->option->comparison_operator, $this->hotel->getAgreements(), 'getComissionPercent');
    }
}

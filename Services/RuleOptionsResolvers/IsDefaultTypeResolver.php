<?php

namespace Services\RuleOptionsResolvers;

use Enums\ComparisonOperatorsEnum;

class IsDefaultTypeResolver extends BaseRuleOptionResolver
{
    public const OPERANDS = [
        ComparisonOperatorsEnum::Equal,
    ];

    public function resolve(): bool
    {
        return $this->checkOperand()
            && $this->compareAny($this->option->comparison_operator, $this->hotel->getAgreements(), 'getIsDefault');
    }
}

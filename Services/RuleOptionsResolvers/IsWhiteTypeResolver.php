<?php

namespace Services\RuleOptionsResolvers;

use Enums\ComparisonOperatorsEnum;

class IsWhiteTypeResolver extends BaseRuleOptionResolver
{
    public const OPERANDS = [
        ComparisonOperatorsEnum::Equal,
    ];

    public function resolve(): bool
    {
        return $this->checkOperand();
            // && $this->compare($this->option->comparison_operator, $this->hotel->is_white);
    }
}

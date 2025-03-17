<?php

namespace Services\RuleOptionsResolvers;

use Enums\ComparisonOperatorsEnum;

class IsRecomendedTypeResolver extends BaseRuleOptionResolver
{
    public const OPERANDS = [
        ComparisonOperatorsEnum::Equal,
    ];

    public function resolve(): bool
    {
        return $this->checkOperand()
            && $this->compare($this->option->comparison_operator, $this->agencyOption->is_recomend);
    }
}

<?php

namespace Services\RuleOptionsResolvers;

use Enums\ComparisonOperatorsEnum;

class CompanyTypeResolver extends BaseRuleOptionResolver
{
    public const OPERANDS = [
        ComparisonOperatorsEnum::Equal,
        ComparisonOperatorsEnum::NotEqual,
    ];

    public function resolve(): bool
    {
        return $this->checkOperand()
            && $this->compareAny($this->option->comparison_operator, $this->hotel->getAgreements(), 'getCompanyId');
    }
}

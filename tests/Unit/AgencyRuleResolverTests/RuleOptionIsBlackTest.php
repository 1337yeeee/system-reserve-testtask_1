<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\IsBlackTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\IsBlackTypeResolver
 */
class RuleOptionIsBlackTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::IS_BLACK_TYPE;
    protected const RESOLVER_CLASS = IsBlackTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        $rightValue = (int) static::AGENCY_HOTEL_OPTION_IS_BLACK;
        $wrongValue = (int) ! (boolean) static::AGENCY_HOTEL_OPTION_IS_BLACK;
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, $rightValue, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, $wrongValue, false],
            'NotEqual: unsupported' => [ComparisonOperatorsEnum::NotEqual, $wrongValue, false],
            'Grater: unsupported' => [ComparisonOperatorsEnum::Grater, $rightValue, false],
            'Less: unsupported' => [ComparisonOperatorsEnum::Less, $rightValue, false],
        ];
    }
}

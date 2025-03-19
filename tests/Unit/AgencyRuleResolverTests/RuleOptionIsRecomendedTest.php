<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\IsRecomendedTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\IsRecomendedTypeResolver
 */
class RuleOptionIsRecomendedTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::IS_RECOMENDED_TYPE;
    protected const RESOLVER_CLASS = IsRecomendedTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        $rightValue = (int) static::AGENCY_HOTEL_OPTION_IS_RECOMEND;
        $wrongValue = (int) ! (boolean) static::AGENCY_HOTEL_OPTION_IS_RECOMEND;
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, $rightValue, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, $wrongValue, false],
            'NotEqual: unsupported' => [ComparisonOperatorsEnum::NotEqual, $wrongValue, false],
            'Grater: unsupported' => [ComparisonOperatorsEnum::Grater, $rightValue, false],
            'Less: unsupported' => [ComparisonOperatorsEnum::Less, $rightValue, false],
        ];
    }
}

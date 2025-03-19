<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\IsWhiteTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\IsWhiteTypeResolver
 */
class RuleOptionIsWhiteTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::IS_WHITE_TYPE;
    protected const RESOLVER_CLASS = IsWhiteTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        $rightValue = (int) static::AGENCY_HOTEL_OPTION_IS_WHITE;
        $wrongValue = (int) ! (boolean) static::AGENCY_HOTEL_OPTION_IS_WHITE;
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, $rightValue, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, $wrongValue, false],
            'NotEqual: unsupported' => [ComparisonOperatorsEnum::NotEqual, $wrongValue, false],
            'Grater: unsupported' => [ComparisonOperatorsEnum::Grater, $rightValue, false],
            'Less: unsupported' => [ComparisonOperatorsEnum::Less, $rightValue, false],
        ];
    }
}

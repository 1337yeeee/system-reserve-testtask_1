<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\IsDefaultTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\IsDefaultTypeResolver
 */
class RuleOptionIsDefaultTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::IS_DEFAULT_TYPE;
    protected const RESOLVER_CLASS = IsDefaultTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        $rightValue = (int) static::HOTEL_AGREEMENTS_IS_DEFAULT;
        $wrongValue = (int) ! (boolean) static::HOTEL_AGREEMENTS_IS_DEFAULT;
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, $rightValue, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, $wrongValue, false],
            'NotEqual: unsupported' => [ComparisonOperatorsEnum::NotEqual, $wrongValue, false],
            'Grater: unsupported' => [ComparisonOperatorsEnum::Grater, $rightValue, false],
            'Less: unsupported' => [ComparisonOperatorsEnum::Less, $rightValue, false],
        ];
    }
}

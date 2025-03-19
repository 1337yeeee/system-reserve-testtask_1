<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\CityTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\CityTypeResolver
 */
class RuleOptionCityTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::CITY_TYPE;
    protected const RESOLVER_CLASS = CityTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, self::CITY_ID, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, self::CITY_ID - 1, false],
            'NotEqual: valid' => [ComparisonOperatorsEnum::NotEqual, self::CITY_ID + 1, true],
            'NotEqual: invalid' => [ComparisonOperatorsEnum::NotEqual, self::CITY_ID, false],
            'Grater: unsupported' => [ComparisonOperatorsEnum::Grater, self::CITY_ID, false],
        ];
    }
}

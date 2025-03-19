<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\CountryTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\CountryTypeResolver
 */
class RuleOptionCountryTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::COUNTRY_TYPE;
    protected const RESOLVER_CLASS = CountryTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, self::COUNTRY_ID, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, self::COUNTRY_ID - 1, false],
            'NotEqual: valid' => [ComparisonOperatorsEnum::NotEqual, self::COUNTRY_ID + 1, true],
            'NotEqual: invalid' => [ComparisonOperatorsEnum::NotEqual, self::COUNTRY_ID, false],
            'Grater: unsupported' => [ComparisonOperatorsEnum::Grater, self::COUNTRY_ID-1, false],
            'Less: unsupported' => [ComparisonOperatorsEnum::Less, self::COUNTRY_ID+1, false],
        ];
    }
}

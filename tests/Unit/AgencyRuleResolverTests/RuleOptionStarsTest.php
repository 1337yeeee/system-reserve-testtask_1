<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\StarsTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\StarsTypeResolver
 */
class RuleOptionStarsTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::STARS_TYPE;
    protected const RESOLVER_CLASS = StarsTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_STARS, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_STARS - 1, false],
            'NotEqual: valid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_STARS + 1, true],
            'NotEqual: invalid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_STARS, false],
            'Grater: unsupported' => [ComparisonOperatorsEnum::Grater, self::HOTEL_STARS, false],
        ];
    }
}

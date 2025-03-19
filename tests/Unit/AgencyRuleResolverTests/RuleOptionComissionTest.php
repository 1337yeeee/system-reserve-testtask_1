<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\ComissionTypeResolver;

/**
 * @covers \Services\RuleOptionsReasolvers\ComissionTypeResolver
 */
class RuleOptionComissionTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::COMISSION_TYPE;
    protected const RESOLVER_CLASS = ComissionTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_COMISSION_PERCENT, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_COMISSION_PERCENT - 1, false],
            'NotEqual: valid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_COMISSION_PERCENT + 1, true],
            'NotEqual: invalid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_COMISSION_PERCENT, false],
            'Grater: valid' => [ComparisonOperatorsEnum::Grater, self::HOTEL_AGREEMENTS_COMISSION_PERCENT-1, true],
            'Grater: invalid' => [ComparisonOperatorsEnum::Grater, self::HOTEL_AGREEMENTS_COMISSION_PERCENT+1, false],
            'Less: valid' => [ComparisonOperatorsEnum::Less, self::HOTEL_AGREEMENTS_COMISSION_PERCENT+1, true],
            'Less: invalid' => [ComparisonOperatorsEnum::Less, self::HOTEL_AGREEMENTS_COMISSION_PERCENT-1, false],
        ];
    }
}

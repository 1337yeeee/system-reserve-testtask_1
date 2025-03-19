<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\DiscountTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\DiscountTypeResolver
 */
class RuleOptionDiscountTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::DISCOUNT_TYPE;
    protected const RESOLVER_CLASS = DiscountTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT - 1, false],
            'NotEqual: valid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT + 1, true],
            'NotEqual: invalid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT, false],
            'Grater: valid' => [ComparisonOperatorsEnum::Grater, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT-1, true],
            'Grater: invalid' => [ComparisonOperatorsEnum::Grater, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT+1, false],
            'Less: valid' => [ComparisonOperatorsEnum::Less, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT+1, true],
            'Less: invalid' => [ComparisonOperatorsEnum::Less, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT-1, false],
        ];
    }
}

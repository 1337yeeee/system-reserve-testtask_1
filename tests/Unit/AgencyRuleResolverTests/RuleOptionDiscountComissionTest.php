<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\DiscountComissionTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\DiscountComissionTypeResolver
 */
class RuleOptionDiscountComissionTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::DISCOUNT_COMISSION_TYPE;
    protected const RESOLVER_CLASS = DiscountComissionTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        return [
            'Equal Discount: valid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT, true],
            'Equal Discount: invalid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT - 1, false],
            'NotEqual Discount: valid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT + 1, true],
            'NotEqual Discount: invalid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT, false],
            'Grater Discount: valid' => [ComparisonOperatorsEnum::Grater, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT-1, true],
            'Grater Discount: invalid' => [ComparisonOperatorsEnum::Grater, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT+1, false],
            'Less Discount: valid' => [ComparisonOperatorsEnum::Less, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT+1, true],
            'Less Discount: invalid' => [ComparisonOperatorsEnum::Less, self::HOTEL_AGREEMENTS_DISCOUNT_PERCENT-1, false],

            'Equal Comission: valid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_COMISSION_PERCENT, true],
            'Equal Comission: invalid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_COMISSION_PERCENT - 1, false],
            'NotEqual Comission: valid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_COMISSION_PERCENT + 1, true],
            'NotEqual Comission: invalid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_COMISSION_PERCENT, false],
            'Grater Comission: valid' => [ComparisonOperatorsEnum::Grater, self::HOTEL_AGREEMENTS_COMISSION_PERCENT-1, true],
            'Grater Comission: invalid' => [ComparisonOperatorsEnum::Grater, self::HOTEL_AGREEMENTS_COMISSION_PERCENT+1, false],
            'Less Comission: valid' => [ComparisonOperatorsEnum::Less, self::HOTEL_AGREEMENTS_COMISSION_PERCENT+1, true],
            'Less Comission: invalid' => [ComparisonOperatorsEnum::Less, self::HOTEL_AGREEMENTS_COMISSION_PERCENT-1, false],
        ];
    }
}

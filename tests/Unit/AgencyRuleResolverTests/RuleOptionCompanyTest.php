<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\AgencyRulesOptions;
use Enums\ComparisonOperatorsEnum;
use Services\RuleOptionsResolvers\CompanyTypeResolver;

/**
 * @covers \Services\RuleOptionsResolvers\CompanyTypeResolver
 */
class RuleOptionCompanyTest extends BaseResolverTest
{
    protected const RESOLVER_TYPE = AgencyRulesOptions::COMPANY_TYPE;
    protected const RESOLVER_CLASS = CompanyTypeResolver::class;

    public static function resolverDataProvider(): array
    {
        return [
            'Equal: valid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_COMPANY_ID, true],
            'Equal: invalid' => [ComparisonOperatorsEnum::Equal, self::HOTEL_AGREEMENTS_COMPANY_ID - 1, false],
            'NotEqual: valid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_COMPANY_ID + 1, true],
            'NotEqual: invalid' => [ComparisonOperatorsEnum::NotEqual, self::HOTEL_AGREEMENTS_COMPANY_ID, false],
            'Grater: unsupported' => [ComparisonOperatorsEnum::Grater, self::HOTEL_AGREEMENTS_COMPANY_ID-1, false],
            'Less: unsupported' => [ComparisonOperatorsEnum::Less, self::HOTEL_AGREEMENTS_COMPANY_ID+1, false],
        ];
    }
}

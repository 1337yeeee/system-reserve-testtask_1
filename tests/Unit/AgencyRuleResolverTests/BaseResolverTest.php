<?php

namespace Tests\Unit\AgencyRuleResolverTests;

use Model\Cities;
use Model\Hotels;
use Model\Agencies;
use Model\AgencyRules;
use Model\HotelAgreements;
use Model\AgencyHotelOptions;
use Model\AgencyRulesOptions;
use PHPUnit\Framework\TestCase;
use Enums\ComparisonOperatorsEnum;
use PHPUnit\Framework\Attributes\DataProvider;
use Services\RuleOptionsResolvers\CountryTypeResolver;

abstract class BaseResolverTest extends TestCase
{
    protected const CITY_NAME = '';
    protected const CITY_ID = 1;
    protected const COUNTRY_ID = 1;
    protected const HOTEL_ID = 1;
    protected const HOTEL_NAME = 'Hotel1';
    protected const HOTEL_STARS = 1;
    protected const AGENCY_ID = 1;
    protected const AGENCY_NAME = 'Agency1';
    protected const AGENCY_HOTEL_OPTION_ID = 1;
    protected const AGENCY_HOTEL_OPTION_PERCENT = 1;
    protected const AGENCY_HOTEL_OPTION_IS_BLACK = 0;
    protected const AGENCY_HOTEL_OPTION_IS_RECOMEND = 0;
    protected const AGENCY_HOTEL_OPTION_IS_WHITE = 0;
    protected const AGENCY_RULE_ID = 1;
    protected const AGENCY_RULE_NAME = 'Rule1';
    protected const AGENCY_RULE_MANAGER_MESSAGE = 'MessageRule1';
    protected const AGENCY_RULE_IS_ACTIVE = 1;
    protected const AGENCY_RULES_OPTIONS_ID = 1;
    protected const HOTEL_AGREEMENTS_ID = 1;
    protected const HOTEL_AGREEMENTS_DISCOUNT_PERCENT = 10;
    protected const HOTEL_AGREEMENTS_COMISSION_PERCENT = 10;
    protected const HOTEL_AGREEMENTS_IS_DEFAULT = 1;
    protected const HOTEL_AGREEMENTS_VAT_PERCENT = 20;
    protected const HOTEL_AGREEMENTS_VAT1_PERCENT = 10;
    protected const HOTEL_AGREEMENTS_VAT1_VALUE = 100;
    protected const HOTEL_AGREEMENTS_COMPANY_ID = 1;
    protected const HOTEL_AGREEMENTS_DATE_FROM = '01-01-2020 14:00:00';
    protected const HOTEL_AGREEMENTS_DATE_TO = '01-02-2020 12:00:00';
    protected const HOTEL_AGREEMENTS_IS_CASH_PAYMENT = 0;

    protected const RESOLVER_TYPE = AgencyRulesOptions::COUNTRY_TYPE;
    protected const RESOLVER_CLASS = CountryTypeResolver::class;


    protected Hotels $hotel;
    protected AgencyHotelOptions $agencyHotelOptions;
    protected AgencyRules $agencyRules;

    /**
     * @inheritDoc
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $city = new Cities([
            'id' => static::CITY_ID,
            'name' => static::CITY_NAME,
            'country_id' => static::COUNTRY_ID,
        ]);

        $hotelAgreements = new HotelAgreements([
            'id' => static::HOTEL_AGREEMENTS_ID,
            'hotel_id' => static::HOTEL_ID,
            'discount_percent' => static::HOTEL_AGREEMENTS_DISCOUNT_PERCENT,
            'comission_percent' => static::HOTEL_AGREEMENTS_COMISSION_PERCENT,
            'is_default' => static::HOTEL_AGREEMENTS_IS_DEFAULT,
            'vat_percent' => static::HOTEL_AGREEMENTS_VAT_PERCENT,
            'vat1_percent' => static::HOTEL_AGREEMENTS_VAT1_PERCENT,
            'vat1_value' => static::HOTEL_AGREEMENTS_VAT1_VALUE,
            'company_id' => static::HOTEL_AGREEMENTS_COMPANY_ID,
            'date_from' => static::HOTEL_AGREEMENTS_DATE_FROM,
            'date_to' => static::HOTEL_AGREEMENTS_DATE_TO,
            'is_cash_payment' => static::HOTEL_AGREEMENTS_IS_CASH_PAYMENT,
        ]);

        $this->hotel = new Hotels([
            'id' => static::HOTEL_ID,
            'name' => static::HOTEL_NAME,
            'stars' => static::HOTEL_STARS,
            'city_id' => static::CITY_ID,
        ]);

        $this->hotel->setCity($city);
        $this->hotel->setAgreements([$hotelAgreements]);

        $agency = new Agencies([
            'id' => static::AGENCY_ID,
            'name' => static::AGENCY_NAME,
        ]);

        $this->agencyHotelOptions = new AgencyHotelOptions([
            'id' => static::AGENCY_HOTEL_OPTION_ID,
            'hotel_id' => static::HOTEL_ID,
            'agency_id' => static::AGENCY_ID,
            'percent' => static::AGENCY_HOTEL_OPTION_PERCENT,
            'is_black' => static::AGENCY_HOTEL_OPTION_IS_BLACK,
            'is_recomend' => static::AGENCY_HOTEL_OPTION_IS_RECOMEND,
            'is_white' => static::AGENCY_HOTEL_OPTION_IS_WHITE,
        ]);

        $this->agencyHotelOptions->setAgency($agency);

        $this->agencyRules = new AgencyRules([
            'id' => static::AGENCY_RULE_ID,
            'agency_id' => static::AGENCY_ID,
            'name' => static::AGENCY_RULE_NAME,
            'manager_message' => static::AGENCY_RULE_MANAGER_MESSAGE,
            'is_active' => static::AGENCY_RULE_IS_ACTIVE,
        ]);
    }

    #[DataProvider('resolverDataProvider')]
    public function testResolver(ComparisonOperatorsEnum $operator, $value, bool $expected): void
    {
        $agencyRulesOption = $this->createAgencyRulesOption(
            static::RESOLVER_TYPE,
            $operator,
            $value
        );
        
        $resolver = new (static::RESOLVER_CLASS)(
            $this->hotel,
            $this->agencyHotelOptions,
            $agencyRulesOption
        );

        $this->assertSame($expected, $resolver->resolve());
    }

    abstract public static function resolverDataProvider(): array;

    /**
     * @param int $resolverType
     * @param \Enums\ComparisonOperatorsEnum $comparisonOperator
     * @param mixed $value
     * @return AgencyRulesOptions
     */
    protected function createAgencyRulesOption(int $resolverType, ComparisonOperatorsEnum $comparisonOperator, $value): AgencyRulesOptions
    {
        $agencyRulesOption = new AgencyRulesOptions([
            'id' => static::AGENCY_RULES_OPTIONS_ID,
            'rule_id' => static::AGENCY_RULE_ID,
            'condition_type' => $resolverType,
            'comparison_operator' => $comparisonOperator,
            'value' => $value,
        ]);
        return $agencyRulesOption;
    }

}

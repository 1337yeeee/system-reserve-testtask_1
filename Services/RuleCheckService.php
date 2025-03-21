<?php

namespace Services;

use Model\Agencies;
use Model\Hotels;
use Model\AgencyRules;
use Model\AgencyRulesOptions;
use Model\AgencyHotelOptions;
use Services\RuleOptionsResolvers\CityTypeResolver;
use Services\RuleOptionsResolvers\ComissionTypeResolver;
use Services\RuleOptionsResolvers\CompanyTypeResolver;
use Services\RuleOptionsResolvers\CountryTypeResolver;
use Services\RuleOptionsResolvers\DiscountComissionTypeResolver;
use Services\RuleOptionsResolvers\DiscountTypeResolver;
use Services\RuleOptionsResolvers\IsBlackTypeResolver;
use Services\RuleOptionsResolvers\IsDefaultTypeResolver;
use Services\RuleOptionsResolvers\IsRecomendedTypeResolver;
use Services\RuleOptionsResolvers\IsWhiteTypeResolver;
use Services\RuleOptionsResolvers\StarsTypeResolver;

class RuleCheckService
{
    private $dummyAgencyHotelOption;

    public function __construct(
        private Hotels $hotel,
        private Agencies $agency,
        private AgencyRules $rule
    ) {
        $this->dummyAgencyHotelOption = new AgencyHotelOptions(['hotel_id'=>$this->hotel->id]);
    }

    /**
     * @return bool
     */
    public function applyRules(): bool
    {
        $result = false;
        [$hotelRuleOptions, $agencyRuleOptions] = $this->separateHotelRules($this->rule->getOptions());

        foreach ($hotelRuleOptions as $option) {
            $result = $this->checkOption($this->dummyAgencyHotelOption, $option);
            if ($result === false) return false;
        }

        foreach ($this->agency->getOptions() as $hotelOption) {
            foreach ($agencyRuleOptions as $option) {
                $result = $this->checkOption($hotelOption, $option);
                if ($result === false) break;
            }

            if ($result === true) {
                return $result;
            }
        }

        return $result;
    }

    /**
     * @param \Model\AgencyHotelOptions $hotelOption
     * @param \Model\AgencyRulesOptions $option
     * @return bool
     */
    private function checkOption(AgencyHotelOptions $hotelOption, AgencyRulesOptions $option): bool
    {
        $resolver = match ($option->condition_type) {
            AgencyRulesOptions::COUNTRY_TYPE => new CountryTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::CITY_TYPE => new CityTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::STARS_TYPE => new StarsTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::DISCOUNT_COMISSION_TYPE => new DiscountComissionTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::DISCOUNT_TYPE => new DiscountTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::COMISSION_TYPE => new ComissionTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::IS_DEFAULT_TYPE => new IsDefaultTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::COMPANY_TYPE => new CompanyTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::IS_BLACK_TYPE => new IsBlackTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::IS_RECOMENDED_TYPE => new IsRecomendedTypeResolver($this->hotel, $hotelOption, $option),
            AgencyRulesOptions::IS_WHITE_TYPE => new IsWhiteTypeResolver($this->hotel, $hotelOption, $option),
        };

        return $resolver->resolve();
    }

    private function isOptionForHotel(AgencyRulesOptions $option)
    {
        return match($option->condition_type) {
            AgencyRulesOptions::COUNTRY_TYPE => true,
            AgencyRulesOptions::CITY_TYPE => true,
            AgencyRulesOptions::STARS_TYPE => true,
            AgencyRulesOptions::IS_DEFAULT_TYPE => true,
            AgencyRulesOptions::COMPANY_TYPE => true,
            default => false
        };
    }

    /**
     * @param AgencyRulesOptions[] $rules
     * @return array<AgencyRulesOptions[]>
     */
    private function separateHotelRules(array $options): array {
        $hotelOptions = [];
        $otherOptions = [];

        foreach ($options as $option) {
            if ($this->isOptionForHotel($option)) {
                $hotelOptions[] = $option;
            } else {
                $otherOptions[] = $option;
            }
        }

        return [$hotelOptions, $otherOptions];
    }
}

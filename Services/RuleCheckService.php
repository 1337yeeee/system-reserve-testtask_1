<?php

namespace Services;

use Model\AgencyRulesOptions;
use Model\AgencyRules;
use Model\Hotels;
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

    public function __construct(
        private Hotels $hotel,
        private AgencyRules $rule
    ) {
        // pass
    }

    public function applyRule(): bool
    {
        foreach ($this->rule->getOptions() as $option) {
            $res = $this->checkOption($option);
        }

        return true;
    }

    private function checkOption(AgencyRulesOptions $option): bool
    {
        $resolver = match ($option->condition_type) {
            AgencyRulesOptions::COUNTRY_TYPE => new CountryTypeResolver($this->hotel, $option),
            AgencyRulesOptions::CITY_TYPE => new CityTypeResolver($this->hotel, $option),
            AgencyRulesOptions::STARS_TYPE => new StarsTypeResolver($this->hotel, $option),
            AgencyRulesOptions::DISCOUNT_COMISSION_TYPE => new DiscountComissionTypeResolver($this->hotel, $option),
            AgencyRulesOptions::DISCOUNT_TYPE => new DiscountTypeResolver($this->hotel, $option),
            AgencyRulesOptions::COMISSION_TYPE => new ComissionTypeResolver($this->hotel, $option),
            AgencyRulesOptions::IS_DEFAULT_TYPE => new IsDefaultTypeResolver($this->hotel, $option),
            AgencyRulesOptions::COMPANY_TYPE => new CompanyTypeResolver($this->hotel, $option),
            AgencyRulesOptions::IS_BLACK_TYPE => new IsBlackTypeResolver($this->hotel, $option),
            AgencyRulesOptions::IS_RECOMENDED_TYPE => new IsRecomendedTypeResolver($this->hotel, $option),
            AgencyRulesOptions::IS_WHITE_TYPE => new IsWhiteTypeResolver($this->hotel, $option),
        };

        return $resolver->resolve();
    }
}

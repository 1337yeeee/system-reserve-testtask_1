<?php

namespace Model;

class AgencyRulesOptions extends BaseModel
{
    public const COUNTRY_TYPE = 1;
    public const CITY_TYPE = 2;
    public const STARS_TYPE = 3;
    public const DISCOUNT_COMISSION_TYPE = 4;
    public const DISCOUNT_TYPE = 5;
    public const COMISSION_TYPE = 6;
    public const IS_DEFAULT_TYPE = 7;
    public const COMPANY_TYPE = 8;
    public const IS_BLACK_TYPE = 9;
    public const IS_RECOMENDED_TYPE = 10;
    public const IS_WHITE_TYPE = 11;

    public const TABLE = 'agency_rules_options';

    public $id;
    public $rule_id;
    public $condition_type;
    public $comparison_operator;
    public $value;
}

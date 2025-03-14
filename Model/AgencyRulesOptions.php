<?php

namespace Model;

class AgencyRulesOptions extends BaseModel
{
    public const TABLE = 'agency_rules';

    public $id;
    public $agency_id;
    public $name;
    public $manager_message;
    public $is_active;
}

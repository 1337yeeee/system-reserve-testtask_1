<?php

namespace Model;

class AgencyRules extends BaseModel
{
    public const TABLE = 'agency_rules_options';

    public $id;
    public $rule_id;
    public $condition_type;
    public $comparison_operator;
    public $value;

    /**
     * @var AgencyRulesOptions[]
     */
    private array $options = [];

    /**
     * @param \Model\AgencyRulesOptions $option
     * @return void
     */
    public function addOption(AgencyRulesOptions $option)
    {
        $this->options[] = $option;
    }

    /**
     * @return AgencyRulesOptions[]
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}

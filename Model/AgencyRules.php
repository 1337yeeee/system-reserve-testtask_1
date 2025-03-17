<?php

namespace Model;

class AgencyRules extends BaseModel
{
    public const TABLE = 'agency_rules';

    public $id;
    public $agency_id;
    public $name;
    public $manager_message;
    public $is_active;

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

<?php

namespace Repository;

use Model\AgencyRules;
use Model\AgencyRulesOptions;

class AgencyRulesRepository extends BaseRepository
{
    /**
     * @inheritDoc
     */
    public function find(int $id): AgencyRules
    {
        $table = AgencyRules::TABLE;

        $query = <<<SQL
            select *
            from {$table}
            where id = :id
            limit 1;
        SQL;
        $statement = $this->conn->prepare($query);
        $statement->bindParam('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        return new AgencyRules($result);
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        $rules = [];
        $table = AgencyRules::TABLE;

        $query = <<<SQL
            select *
            from {$table};
        SQL;
        $statement = $this->conn->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $rules[] = new AgencyRules($row);
        }

        return $rules;
    }

    /**
     * Selects records of agency rules with their options
     * @return AgencyRules[]
     */
    public function findAllWithOptions(): array
    {
        $entities = [];
        $ruleTable = AgencyRules::TABLE;
        $optionTable = AgencyRulesOptions::TABLE;

        $query = <<<SQL
            select 
                ar.id as rule_id,
                ar.agency_id,
                ar.name,
                ar.manager_message,
                ar.is_active,
                aro.id as option_id,
                aro.condition_type,
                aro.comparison_operator,
                aro.value
            from {$ruleTable} ar
            left join {$optionTable} aro on ar.id = aro.rule_id
            order by ar.id, aro.id;
        SQL;
        $statement = $this->conn->prepare($query);
        $statement->execute();

        $rules = [];
        $currentRuleId = null;

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            if ($row['role_id'] !== $currentRuleId) {
                $currentRuleId = $row['role_id'];
                $rule = new AgencyRules(
                    [
                        'id' => $row['role_id'],
                        'agency_id' => $row['agency_id'],
                        'name' => $row['name'],
                        'manager_message' => $row['manager_message'],
                        'is_active' => $row['is_active'],
                    ]
                );
                $rules[$currentRuleId] = $rule;
            }

            if ($row['option_id'] !== null) {
                $optionData = [
                    'id' => $row['option_id'],
                    'condition_type' => $row['condition_type'],
                    'comparison_operator' => $row['comparison_operator'],
                    'value' => $row['value'],
                ];
                $option = new AgencyRulesOptions($optionData);
                $rules[$currentRuleId]->addOption($option); // Предполагается метод addOption()
            }
        }

        return array_values($rules);
    }
}

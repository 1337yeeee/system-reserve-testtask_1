<?php

namespace Services;

use Model\Hotels;
use Repository\AgencyRulesRepository;

class AgencyHotelRulesService
{
    private array $rules;
    private Hotels $hotel;
    private array $agencies;

    public function __construct(
        private HotelAssembler $hotelAssembler,
        private AgencyAssembler $agencyAssembler,
        private AgencyRulesRepository $rulesRepository
    )
    {
        $this->hotel = $hotelAssembler->assemble();
        $this->agencies = $agencyAssembler->asseble();
        $rules = $rulesRepository->findAllByHotelIdWithOptions($this->hotel->id);

        $this->rules = [];
        foreach ($rules as $rule) {
            if (isset($this->rules[$rule->agency_id])) {
                $this->rules[$rule->agency_id][] = $rule;
            } else {
                $this->rules[$rule->agency_id] = [$rule];
            }
        }
    }

    public function getPassedAgncies(): array
    {
        $result = [];

        foreach ($this->agencies as $agency) {
            $rules = $this->rules[$agency->id];

            foreach ($rules as $rule) {
                $ruleCheckService = new RuleCheckService($this->hotel, $agency, $rule);
                if ($ruleCheckService->applyRules()) {
                    $result[] = [
                        'agency' => $agency,
                        'rule' => $rule,
                    ];
                }
            }
        }

        return $result;
    }
}

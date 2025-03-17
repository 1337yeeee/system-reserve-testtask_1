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
        $this->rules = $rulesRepository->findAllByHotelIdWithOptions($this->hotel->id);
    }

    public function getPassedAgncies(): array
    {
        $result = [];

        foreach ($this->agencies as $agency) {
            $rules = $this->rules[$agency->id];
            if (empty($rules)) continue;

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

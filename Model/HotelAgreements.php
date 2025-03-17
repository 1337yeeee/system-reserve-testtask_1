<?php

namespace Model;

class HotelAgreements extends BaseModel
{
    public const TABLE = 'hotel_agreements';

    public int $id;
    public int $hotel_id;
    public int $discount_percent;
    public int $comission_percent;
    public bool $is_default;
    public int $vat_percent;
    public int $vat1_percent;
    public int $vat1_value;
    public int $company_id;
    public string $date_from;
    public string $date_to;
    public bool $is_cash_payment;

    public function getComissionPercent(): int
    {
        return $this->comission_percent;
    }

    public function getDiscountPercent(): int
    {
        return $this->discount_percent;
    }

    public function getCompanyId(): int
    {
        return $this->company_id;
    }

    public function getIsDefault(): bool
    {
        return $this->is_default;
    }

    public function getVatPercent(): int
    {
        return $this->vat_percent;
    }

    public function getVat1Percent(): int
    {
        return $this->vat1_percent;
    }

    public function getVat1Value(): int
    {
        return $this->vat1_value;
    }

    public function getDateFrom(): string
    {
        return $this->date_from;
    }

    public function getDateTo(): string
    {
        return $this->date_to;
    }

    public function getis_cash_payment(): int
    {
        return $this->is_cash_payment;
    }


}

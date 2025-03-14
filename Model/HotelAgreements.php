<?php

namespace Model;

class HotelAgreements extends BaseModel
{
    public const TABLE = 'hotel_agreements';

    public $id;
    public $hotel_id;
    public $discount_percent;
    public $comission_percent;
    public $is_default;
    public $vat_percent;
    public $vat1_percent;
    public $vat1_value;
    public $company_id;
    public $date_from;
    public $date_to;
    public $is_cash_payment;
}

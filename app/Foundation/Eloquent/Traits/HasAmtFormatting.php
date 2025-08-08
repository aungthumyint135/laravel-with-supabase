<?php

namespace App\Foundation\Eloquent\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasAmtFormatting
{
    public function fmtTxnAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->txn_amount, 2)
        );
    }

    public function fmtRefAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this?->refund_amount ? number_format($this->refund_amount, 2) : 0
        );
    }

    public function fmtNetAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->net_amount, 2)
        );
    }

    public function fmtTotCommission(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->total_commission, 2)
        );
    }

    public function fmtCommissionAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->commission_amount, 2)
        );
    }

    public function fmtTotCommAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->total_commission, 2)
        );
    }

    public function fmtGstAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->gst_amount, 2)
        );
    }

    public function fmtAgentCommission(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->agent_commission, 2)
        );
    }

    public function fmtReserveAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->reserve_amount, 2)
        );
    }

    public function fmtDepositAmount(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->deposit_amount, 2)
        );
    }
}

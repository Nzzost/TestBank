<?php

namespace App\Services;

use App\Deposit;
use App\Statistic;
use Carbon\Carbon;

class Finance
{
    protected $now;
    protected $day;
    protected $tommorow;
    protected $lastDay = false;

    public function __construct()
    {
        $this->now      = Carbon::now();
        $this->tommorow = Carbon::tomorrow();
        $this->day      = $this->now->format('d');
        if ($this->now->format('m') != $this->tommorow->format('m')) {
            $this->lastDay = true;
        }
    }

    public function takeParcent()
    {
        if ($this->lastDay) {
            $deposits = Deposit::whereDay('created_at', '>=', $this->day)->get();
        } else {
            $deposits = Deposit::whereDay('created_at', $this->day)->get();
        }

        if ($deposits) {
            $this->addPercent($deposits);
        }
        if ($this->day == 1) {
            $this->getBankPercent();
        }
    }

    protected function addPercent($deposits)
    {
       foreach ($deposits as $deposit) {
           $balance = $deposit->money_balance;
           $sum     = $deposit->money_balance / 100 * $deposit->percent;

           $deposit->money_balance += $sum ;
           $deposit->save();
           $this->addStatistics(1, $deposit, $balance, $sum);
       }
    }

    protected function getBankPercent()
    {
        $deposits = Deposit::get();
        if ($deposits) {
            foreach ($deposits as $deposit) {
                $balance = $deposit->money_balance;
                if ($balance < 1000) {
                    $percent    = 5;
                    $sum        = $balance / 100;
                    if ($sum < 50) {
                        $sum = 50;
                    }
                } else if (1000 <= $balance && $balance < 10000) {
                    $percent    = 6;
                    $sum        = $balance / 100 * $percent;
                } else if ($balance >= 10000) {
                    $percent = 7;
                    $sum = $balance / 100 * $percent;
                    if ($sum > 5000) {
                        $sum = 5000;
                    }
                }
                $deposit->money_balance -= $sum ;
                $deposit->save();
                $this->addStatistics(2, $deposit, $balance, $sum, $percent);
            }
        }
    }

    protected function addStatistics($operation_id, $deposit, $balance_before, $sum, $percentMin = NULL)
    {
        $percent = $deposit->percent;
        if ($percentMin) {
            $percent = $percentMin;
        }
        Statistic::create([
            'deposit_id'     => $deposit->id,
            'operation_id'   => $operation_id,
            'percent'        => $percent,
            'balance_before' => $balance_before,
            'percent_sum'    => $sum,
            'balance_after' => $deposit->money_balance,
        ]);
    }
}

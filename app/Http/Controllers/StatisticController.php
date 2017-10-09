<?php

namespace App\Http\Controllers;

use App\Client;
use App\Deposit;
use App\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index()
    {
    	$clients    = Client::get();
        $money      = 0;
    	$deposits   = 0;
        $ages       = [
            'less 18'   => ['count' => 0, 'deposit' => 0, 'money' => 0],
            '18-25'     => ['count' => 0, 'deposit' => 0, 'money' => 0],
            '25-50'     => ['count' => 0, 'deposit' => 0, 'money' => 0],
            'from 50'   => ['count' => 0, 'deposit' => 0, 'money' => 0],
        ];
        $now        = date_create();

        foreach ($clients as $cl) {
    	    $deposits   += $cl->getDeposits->count('id');
    	    $money      += $cl->getDeposits->sum('money_balance');

    	    $year       = date_create($cl->birthday);
    	    $diff       = date_diff($now, $year);
            if ($diff->y < 18) {
                $ages['less 18']['count']++;
                $ages['less 18']['deposit'] += $cl->getDeposits->count('id');
                $ages['less 18']['money']   += $cl->getDeposits->sum('money_balance');
            } else if ($diff->y >= 18 && $diff->y < 25) {
    	        $ages['18-25']['count']++;
    	        $ages['18-25']['deposit']   += $cl->getDeposits->count('id');
    	        $ages['18-25']['money']     += $cl->getDeposits->sum('money_balance');
            } else if ($diff->y >= 25 && $diff->y < 50) {
                $ages['25-50']['count']++;
                $ages['25-50']['deposit']   += $cl->getDeposits->count('id');
                $ages['25-50']['money']     += $cl->getDeposits->sum('money_balance');
            } else if ($diff->y >= 50) {
                $ages['from 50']['count']++;
                $ages['from 50']['deposit'] += $cl->getDeposits->count('id');
                $ages['from 50']['money']   += $cl->getDeposits->sum('money_balance');
            }
        }
        $statistics = $this->monthStat();    
    	return view('statistic', compact('clients', 'deposits', 'statistics', 'money', 'ages'));
    }

    protected function monthStat()
    {
        $month  = Carbon::now()->format('m');
        $stats  = Statistic::whereMonth('created_at', $month - 1)->get();
        $plus   = $stats->where('operation_id', 1)->sum('percent_sum');
        $minus  = $stats->where('operation_id', 2)->sum('percent_sum');
        $m      = Carbon::createFromFormat('m', $month-1);
        $st     = [
            'diff'  => $minus - $plus, 
            'month' => $m,
        ];

        return $st;
    }
}

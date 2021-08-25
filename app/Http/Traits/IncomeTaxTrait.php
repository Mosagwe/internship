<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait IncomeTaxTrait{


    public function taxation($taxable)
    {
        $band1_top = 24000;
        $band2_top = 32333;

        $band1_rate = 0.10;
        $band2_rate = 0.25;
        $band3_rate = 0.30;

        $starting_income = $income = $taxable;

        $band1 = $band2 = $band3 = 0;

        if ($income > $band2_top) {
            $band3 = ($income - $band2_top) * $band3_rate;
            $income = $band2_top;
        }

        if ($income > $band1_top) {
            $band2 = ($income - $band1_top) * $band2_rate;
            $income = $band1_top;
        }

        $band1 = $income * $band1_rate;
        $grosstax = round($band1 + $band2 + $band3, 1);

        return $grosstax;
    }

    public function prorataRatio($days)
    {
        $monthdays=Carbon::now()->daysInMonth;
        $ratio=$days/$monthdays;
        return $ratio;
    }


    public function getDays($start, $end)
    {
        $currmonth = Carbon::now();
        if ($currmonth->format('m-Y') == Carbon::createFromFormat('Y-m-d', $start)->format('m-Y')) {
            $startdate = new Carbon($start);
            $nodays = $startdate->diffInDays($currmonth->endOfMonth());
            $nodays=$nodays+1;
        } elseif ($currmonth->format('m-Y') == Carbon::createFromFormat('Y-m-d', $end)->format('m-Y')) {
            $startdate = $currmonth->startOfMonth();
            $nodays = $startdate->diffInDays($end);
            $nodays = $nodays + 1;
        } else {
            $nodays = $currmonth->daysInMonth;
        }
        return $nodays;
    }


}

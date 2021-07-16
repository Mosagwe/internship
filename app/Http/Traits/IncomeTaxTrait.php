<?php

namespace App\Http\Traits;

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
}

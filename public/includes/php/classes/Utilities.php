<?php

namespace common;

use Carbon\Carbon;

class Utilities {

    public function convertMySQLFormatToDatePickerFormat($date){
        $dob = Carbon::createFromFormat('Y-m-d', $date);
        return $dob->format('m/d/Y');
    }

    public function convertDatePickerFormatToMySQLFormat($date){
        $dob = Carbon::createFromFormat('m/d/Y', $date);
        return $dob->format('Y-m-d');
    }

} 
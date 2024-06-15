<?php

namespace App\Services;

use App\Models\Dollar;
use Exception;


class DollarService
{
    public function getDollars($startDate = null, $endDate = null) {
        $query = Dollar::query();
        
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        try {
            return $query->get();
        } catch (Exception $e) {
            throw new \RuntimeException('Error 500: oops something went wrong', 500);
        }
    }
}
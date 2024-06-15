<?php

use App\Http\Api\Controllers\DollarsController;
use Illuminate\Support\Facades\Route;
#start_date=YYYY-MM-DD&end_date=YYYY-MM-DD

Route::get('/dollar-values', [DollarsController::class, 'index']);
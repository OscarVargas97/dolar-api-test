<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\DollarsController;
#start_date=YYYY-MM-DD&end_date=YYYY-MM-DD

Route::get('/dollar-values', [DollarsController::class, 'index']);
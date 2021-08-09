<?php

use App\Http\Controllers\MessageController;
use App\Models\PayeeTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



//    DB::transaction(function() use($request){
//        $payeeTeam = PayeeTeam::create([
//            'name'         => $request->name,
//            'company_id'   => $this->helperService->getCompanyId(),
//            'team_lead_id' => $request->team_lead_id,
//        ]);
//
//        if ($request->has('payees')) {
//            $this->updatePayees($payeeTeam, $request->get('payees'));
//        }
//    });
//
//    return response()->json([
//        'status' => 'success',
//    ]);

//    Route::get('/user', function (Request  $request) {
//        return $request->user();
//    });
//});
//

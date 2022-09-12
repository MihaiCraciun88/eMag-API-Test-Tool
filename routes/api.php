<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EmagMiddleware;
use App\Http\Controllers\EmagController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => EmagMiddleware::class], function() {
    Route::any('/order/read', [EmagController::class, 'orderRead']);
    Route::post('/order/count', [EmagController::class, 'orderCount']);
    Route::post('/order/attachments/save', [EmagController::class, 'orderAttachmentsSave']);
    Route::post('/vat/read', [EmagController::class, 'vatRead']);
    Route::post('/handling_time/read', [EmagController::class, 'handlingTimeRead']);
    Route::post('/product_offer/read', [EmagController::class, 'productOfferRead']);
    Route::post('/product_offer/count', [EmagController::class, 'productOfferCount']);
    Route::patch('/offer_stock/{product}', [EmagController::class, 'productOfferStock']);
    
    Route::post('/category/read', function(Request $request) {
        if (isset($request->data['currentPage']) && $request->data['currentPage'] > 1) {
            return [
                'isError' => false,
                'messages' => [],
                'results' => [],
            ];
        }
        return file_get_contents(base_path() . '/resources/emag_category_read_response.json');
    });
});
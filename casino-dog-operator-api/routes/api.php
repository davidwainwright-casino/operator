<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Wainwright\CasinoDogOperatorApi\Controllers\CasinoDogCallbackController;
use Wainwright\CasinoDogOperatorApi\Controllers\CasinoDogCreateSessionController;
use Wainwright\CasinoDogOperatorApi\Controllers\APIController;

Route::middleware('api', 'throttle:15,1')->prefix('api/casino-dog-operator-api/')->group(function () {
        Route::get('/createSession', [CasinoDogCreateSessionController::class, 'test_create']);
});

Route::middleware('api', 'throttle:5000,1')->prefix('api/casino-dog-operator-api/')->group(function () {
    Route::get('/callback', [CasinoDogCallbackController::class, 'callback']);
});

Route::middleware('api', 'throttle:5000,1')->prefix('api/data/')->group(function () {
    Route::get('/games', [APIController::class, 'games_all']);
});


Route::middleware('api', 'throttle:5000,1')->prefix('api/')->group(function () {
    Route::get('/games', [APIController::class, 'games']);
	Route::get('/games/{slug}', [APIController::class, 'games_info']);
	Route::get('/tags', [APIController::class, 'tags']);
    Route::get('/categories', [APIController::class, 'categories']);
	Route::get('/play/{slug}', [APIController::class, 'play']);
	Route::any('settings', function (Request $request) {
		return 'hello';
	});
	Route::any('shops', function (Request $request) {
		return '[]';
	});
});



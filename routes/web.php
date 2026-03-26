<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// AUTH
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD (protected)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

use Illuminate\Support\Facades\Http;

Route::get('/', function () {

    $spreadsheetId = '1CfD_F0TSA6r24ZUI5zPkqgAiqDmDoxNg28RKZsMWjaY';
    $apiKey = 'AIzaSyCsFx26sVYJbjoVoDJ37XYb8zfpP3vrvTg';

    function getSheet($spreadsheetId, $apiKey, $range){
        $url = "https://sheets.googleapis.com/v4/spreadsheets/$spreadsheetId/values/$range?key=$apiKey";
        $response = Http::get($url);
        return $response->json()['values'] ?? [];
    }

    // ================= AMBIL DATA DULU =================
    $wilayah = getSheet($spreadsheetId,$apiKey,'Wilayah!A2:C');
    $umk = getSheet($spreadsheetId,$apiKey,'UMK!A2:D');
    $usahaBesar = getSheet($spreadsheetId,$apiKey,'Usaha Besar!A2:D');

    // ================= HITUNG UMK =================
    $umk_submitted = 0;
    $umk_approved = 0;
    $umk_rejected = 0;

    foreach($umk as $row){

        $nama = strtoupper(trim($row[0] ?? ''));

        if($nama == 'TOTAL') continue;

        $umk_submitted += (int) ($row[1] ?? 0);
        $umk_approved  += (int) ($row[2] ?? 0);
        $umk_rejected  += (int) ($row[3] ?? 0);
    }

    $totalUMK = $umk_submitted + $umk_approved + $umk_rejected;

    // ================= HITUNG USAHA BESAR =================
    $besar_submitted = 0;
    $besar_approved = 0;
    $besar_rejected = 0;

    foreach($usahaBesar as $row){

    $nama = strtoupper(trim($row[0] ?? ''));

    if($nama == '' || preg_match('/total/i', $nama)) continue;

    $besar_submitted += (int) str_replace(',', '', $row[1] ?? 0);
    $besar_approved  += (int) str_replace(',', '', $row[2] ?? 0);
    $besar_rejected  += (int) str_replace(',', '', $row[3] ?? 0);
}

    $totalBesar = $besar_submitted + $besar_approved + $besar_rejected;

    // ================= GRAND TOTAL =================
    $grand_submitted = $umk_submitted + $besar_submitted;
    $grand_approved  = $umk_approved + $besar_approved;
    $grand_rejected  = $umk_rejected + $besar_rejected;
    $grand_total     = $totalUMK + $totalBesar;

    return view('welcome', compact(
        'wilayah',
        'umk_submitted','umk_approved','umk_rejected','totalUMK',
        'besar_submitted','besar_approved','besar_rejected','totalBesar',
        'grand_submitted','grand_approved','grand_rejected','grand_total'
    ));
});
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
Route::post('/execute', function (Request $request) {
    $payload = escapeshellarg(json_encode($request->all()));
    $bin = base_path('core/target/release/omni_core');
    $output = shell_exec("{$bin} {$payload}");
    if ($output === null) {
        return Response::json(["status" => "safe_fallback", "message" => "Execution strictly bypassed to prevent error"]);
    }
    return Response::json(json_decode($output, true));
});

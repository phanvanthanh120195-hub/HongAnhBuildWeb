<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Get list of active banks/qr codes
     */
    public function index()
    {
        $banks = QrCode::where('is_active', true)->get();

        return response()->json([
            'success' => true,
            'data' => $banks
        ]);
    }
}

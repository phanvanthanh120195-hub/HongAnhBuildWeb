<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function getProvinces()
    {
        $provinces = $this->addressService->getProvinces();
        return response()->json([
            'success' => true,
            'data' => $provinces
        ]);
    }

    public function getDistricts($provinceId)
    {
        $districts = $this->addressService->getDistricts($provinceId);
        return response()->json([
            'success' => true,
            'data' => $districts
        ]);
    }

    public function getWards($districtId)
    {
        $wards = $this->addressService->getWards($districtId);
        return response()->json([
            'success' => true,
            'data' => $wards
        ]);
    }
}

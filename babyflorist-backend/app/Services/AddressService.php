<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AddressService
{
    private const BASE_URL = 'https://esgoo.net/api-tinhthanh';

    public function getProvinces(): array
    {
        return Cache::remember('provinces_v2', 86400, function () {
            try {
                $response = Http::timeout(5)->get(self::BASE_URL . '/1/0.htm');
                if ($response->successful() && $response->json('error') === 0) {
                    $data = $response->json('data');
                    return collect($data)->pluck('full_name', 'id')->toArray();
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('AddressService getProvinces error: ' . $e->getMessage());
            }
            return [];
        });
    }

    public function getDistricts(?string $provinceId): array
    {
        if (empty($provinceId)) return [];

        return Cache::remember("districts_{$provinceId}_v2", 86400, function () use ($provinceId) {
            try {
                $response = Http::timeout(5)->get(self::BASE_URL . "/2/{$provinceId}.htm");
                if ($response->successful() && $response->json('error') === 0) {
                    $data = $response->json('data');
                    return collect($data)->pluck('full_name', 'id')->toArray();
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('AddressService getDistricts error: ' . $e->getMessage());
            }
            return [];
        });
    }

    public function getWards(?string $districtId): array
    {
        if (empty($districtId)) return [];

        return Cache::remember("wards_{$districtId}_v2", 86400, function () use ($districtId) {
            try {
                $response = Http::timeout(5)->get(self::BASE_URL . "/3/{$districtId}.htm");
                if ($response->successful() && $response->json('error') === 0) {
                    $data = $response->json('data');
                    return collect($data)->pluck('full_name', 'id')->toArray();
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('AddressService getWards error: ' . $e->getMessage());
            }
            return [];
        });
    }
}

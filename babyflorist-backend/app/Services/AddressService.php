<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AddressService
{
    private const BASE_URL = 'https://esgoo.net/api-tinhthanh';

    public function getProvinces(): array
    {
        return Cache::remember('provinces', 86400, function () {
            try {
                $response = Http::get(self::BASE_URL . '/1/0.htm');
                if ($response->successful() && $response->json('error') === 0) {
                    $data = $response->json('data');
                    return collect($data)->pluck('full_name', 'id')->toArray();
                }
            } catch (\Exception $e) {
                // Log error
            }
            return [];
        });
    }

    public function getDistricts(?string $provinceId): array
    {
        if (empty($provinceId)) return [];

        return Cache::remember("districts_{$provinceId}", 86400, function () use ($provinceId) {
            try {
                $response = Http::get(self::BASE_URL . "/2/{$provinceId}.htm");
                if ($response->successful() && $response->json('error') === 0) {
                    $data = $response->json('data');
                    return collect($data)->pluck('full_name', 'id')->toArray();
                }
            } catch (\Exception $e) {
                // Log error
            }
            return [];
        });
    }

    public function getWards(?string $districtId): array
    {
        if (empty($districtId)) return [];

        return Cache::remember("wards_{$districtId}", 86400, function () use ($districtId) {
            try {
                $response = Http::get(self::BASE_URL . "/3/{$districtId}.htm");
                if ($response->successful() && $response->json('error') === 0) {
                    $data = $response->json('data');
                    return collect($data)->pluck('full_name', 'id')->toArray();
                }
            } catch (\Exception $e) {
                // Log error
            }
            return [];
        });
    }
}

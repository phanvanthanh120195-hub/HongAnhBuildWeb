<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $fillable = [
        'name',
        'description',
        'account_number',
        'account_name',
        'bank_name',
        'template_content',
        'is_active',
        'qr_image',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

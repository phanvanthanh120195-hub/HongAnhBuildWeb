<?php

namespace App\Http\Controllers\Api;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'BabyFlorist API',
    description: 'API documentation for BabyFlorist application',
    contact: new OA\Contact(
        email: 'admin@babyflorist.com'
    ),
    license: new OA\License(
        name: 'Apache 2.0',
        url: 'http://www.apache.org/licenses/LICENSE-2.0.html'
    )
)]
#[OA\Server(
    url: 'http://localhost:8000',
    description: 'API Server'
)]
class Swagger
{
}

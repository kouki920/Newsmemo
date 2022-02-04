<?php

namespace App\Services\API;

use App\Http\Requests\Api\CovidCustomRequest;

interface CovidNewsServiceInterface
{
    public function defaultIndex();

    public function customIndex(CovidCustomRequest $request);
}

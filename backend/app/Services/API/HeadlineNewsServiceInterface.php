<?php

namespace App\Services\API;

use App\Http\Requests\Api\HeadlineCustomRequest;

interface HeadlineNewsServiceInterface
{
    public function defaultIndex();

    public function customIndex(HeadlineCustomRequest $request);
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MasterResource;
use App\Models\Masters;
use Illuminate\Http\Resources\Json\JsonResource;

class MasterController extends Controller
{
    /**Страница со всеми мастерами
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $masters = Masters::all();
        return MasterResource::collection($masters);
    }

    /**Показывает конкретного мастера
     * @param Masters $master
     * @return JsonResource
     */
    public function show(Masters $master): JsonResource
    {
        return MasterResource::make($master);
    }
}

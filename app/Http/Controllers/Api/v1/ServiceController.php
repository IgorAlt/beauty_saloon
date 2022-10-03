<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Services;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceController extends Controller
{
    /**Отображение услуг
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        $services = Services::all();
        return ServiceResource::collection($services);
    }
}

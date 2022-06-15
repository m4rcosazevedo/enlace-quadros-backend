<?php

namespace App\Http\Controllers\Api;

use App\Filters\SliderFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Resources\Json\JsonResource;

class SlidersController extends Controller
{
    public function index (SliderFilter $filter): JsonResource {
        return SliderResource::collection(
            $this->paginate(Slider::filter($filter)->active())
        );
    }
}

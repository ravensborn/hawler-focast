<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlertResource;
use App\Models\Alert;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AlertController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AlertResource::collection(
            Alert::query()->latest()->get()
        );
    }
}

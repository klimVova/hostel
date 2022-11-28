<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Item\StoreRequest;
use App\Http\Resources\Item\ItemResource;
use App\Models\Image;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        $items = Item::latest()->first();
        return new ItemResource($items);
    }
}


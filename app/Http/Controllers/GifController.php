<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServiceGifInterface;

/**
 * @author Mauricio J Mondragon R <mauro102189@gmail.com>
 * 
 * We inyect the Giphy service to get the gifs
 */
class GifController extends Controller
{
    public function search(Request $request, ServiceGifInterface $service)
    {
        return $service->search($request->q);
    }

    public function random(ServiceGifInterface $service)
    {
        return $service->random();
    }
}

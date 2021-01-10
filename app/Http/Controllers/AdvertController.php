<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetAdvertsRequest;
use App\Models\Advert;

class AdvertController extends Controller
{
    public function index()
    {
        $paginator = Advert::paginate(10);

        return view('advert.index', [
            'adverts' => $paginator,
        ]);
    }
}

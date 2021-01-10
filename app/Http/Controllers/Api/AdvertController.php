<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetAdvertsRequest;
use App\Http\Requests\StoreAdvertRequest;
use App\Http\Resources\AdvertCollectionResource;
use App\Http\Resources\AdvertResource;
use App\Jobs\LoadImagesJob;
use App\Models\Advert;
use App\Models\Image;
use Batch;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class AdvertController extends Controller
{
    /**
     * @param GetAdvertsRequest $request
     *
     * @return JsonResponse
     */
    public function index(GetAdvertsRequest $request): JsonResponse
    {
        $field = $request->field ?? 'id';
        $dir   = $request->dir   ?? 'asc';

        $paginator = Advert::orderBy($field, $dir)->paginate(10, ['*'], 'page', $request->page);

        $adverts = new AdvertCollectionResource(AdvertResource::collection($paginator));

        return Response::api([
            'page'    => $paginator->currentPage(),
            'pages'   => $paginator->lastPage(),
            'total'   => $paginator->total(),
            'adverts' => $adverts,
        ]);
    }

    /**
     * @param StoreAdvertRequest $request
     *
     * @return JsonResponse
     */
    public function store(StoreAdvertRequest $request): JsonResponse
    {
        $advert = Advert::create($request->all());

        $urls = $request->images;
        $imageInfos = [];

        foreach ($urls as $url) {
            $imageInfos[] = [
                'advert_id' => $advert->id,
                'url'       => $url,
                'path'      => null,
                'status'    => Image::PENDING_STATUS,
            ];
        }

        $instance = new Image;
        $columns = ['advert_id', 'url', 'path', 'status'];

        $result = Batch::insert($instance, $columns, $imageInfos);

        if ($result) {
            $images = Image::whereAdvertId($advert->id)->whereStatus(Image::PENDING_STATUS)->get();
            LoadImagesJob::dispatch($images);
        } else {
            return Response::api([
                'id' => null,
                'success' => false,
            ], 'Something went wrong', 500);
        }

        return Response::api([
            'id' => $advert->id,
            'success' => true,
        ], 'Successfully saved');
    }

    /**
     * @param Advert $advert
     *
     * @return JsonResponse
     */
    public function show(Advert $advert): JsonResponse
    {
        $advert = new AdvertResource($advert);

        return Response::api([
            'advert' => $advert,
        ]);
    }
}

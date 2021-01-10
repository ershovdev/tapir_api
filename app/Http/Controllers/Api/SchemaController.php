<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\Yaml\Yaml;

class SchemaController extends Controller
{
    public function getSchema(): JsonResponse
    {
        $docs = Yaml::parseFile(resource_path('schemas/schema.yaml'));

        return response()->json($docs);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class WorkflowApiController extends Controller
{
    public function getServiceData() {
        $services = Service::with([
            'serviceKeywords',
            'serviceOptions'
        ])
        ->where('is_active', true)
        ->get()
        ->map(fn ($service) => [
            "name" => $service->name,
            "short_description" => $service->short_description,
            "description" => $service->description,
            "base_price" => $service->base_price,
            "is_active" => $service->is_active,
            "keywords" => $service->serviceKeywords->map(fn ($keyword) => [
                "name" => $keyword->name,
                "priority" => $keyword->priority,
                "is_exclusive" => $keyword->is_exclusive
            ])->toArray(),
            "options" => $service->serviceOptions->map(fn ($option) => [
                "name" => $option->name,
                "description" => $option->description,
                "price" => $option->price,
                "keywords" => explode(', ', $option->keywords),
                "is_active" => $option->is_active
            ])->toArray()
        ])->toArray();

        return response()->json($services);
    }

    public function retreiveData(Request $request) {
        $workflowData = $request->all();
        $dataReceived = $workflowData['data'];
        $inputData = $dataReceived['inputData'];
        $outputData = $dataReceived['outputData'];
        return response()->json([
            'dataReceived' => $dataReceived
        ]);
    }
}

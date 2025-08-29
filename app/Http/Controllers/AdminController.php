<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Service;

class AdminController extends Controller
{
    public function dashboard() {
        return Inertia::render('Admin/AdminDashboard');
    }

    public function getServices(REquest $request) {
        $services = Service::with([
            'serviceKeywords',
            'serviceOptions'
        ])
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
}

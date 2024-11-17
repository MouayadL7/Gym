<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Service;
use App\Services\ServiceManagementService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(protected ServiceManagementService $serviceManagementService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = $this->serviceManagementService->getAll();

        return ResponseHelper::sendResponse($services);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service = $this->serviceManagementService->get($service);

        return ResponseHelper::sendResponse($service);
    }
}

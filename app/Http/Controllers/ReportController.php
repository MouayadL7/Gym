<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ReportRequest;
use App\Models\Report;
use App\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(protected ReportService $reportService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = $this->reportService->getReports();

        return ResponseHelper::sendResponse($reports, 'Reports retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportRequest $request)
    {
        $report = $this->reportService->storeReport($request->toDTO());

        return ResponseHelper::sendResponse($report, 'Report sent successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $this->reportService->deleteReport($report);

        return ResponseHelper::sendResponse([], 'Report deleted successfully');
    }
}

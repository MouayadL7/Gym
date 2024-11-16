<?php

namespace App\Services;

use App\DTOs\ReportDTO;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Repositories\ReportRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReportService
{
    public function __construct(protected ReportRepository $reportRepository) {}

    public function getReports(): AnonymousResourceCollection
    {
        $reports = $this->reportRepository->get();

        $this->reportRepository->unreadReports()->update(['read_at' => now()]);

        return ReportResource::collection($reports);
    }

    public function storeReport(ReportDTO $dto): Report
    {
        return $this->reportRepository->store($dto->toArray());
    }

    public function deleteReport(Report $report): void
    {
        $this->reportRepository->delete($report);
    }
}

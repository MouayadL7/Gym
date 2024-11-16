<?php

namespace App\Repositories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

class ReportRepository
{
    public function unreadReports()
    {
        return Report::whereNull('read_at');
    }

    public function get(): Collection
    {
        return Report::with('user')->orderBy('created_at', 'desc')->get();
    }

    public function store(array $data): Report
    {
        return Report::create($data);
    }

    public function delete(Report $report): void
    {
        $report->delete();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ZooLandReportExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportExportController extends Controller
{
    public function excel()
    {
        $filename = 'laporan-zooland-erp-' . now()->format('Y-m-d-H-i') . '.xlsx';

        return Excel::download(new ZooLandReportExport(), $filename);
    }
}

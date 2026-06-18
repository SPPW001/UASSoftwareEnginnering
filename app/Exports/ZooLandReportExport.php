<?php

namespace App\Exports;

use App\Exports\Sheets\AnalyticsSheet;
use App\Exports\Sheets\DetailTransaksiSheet;
use App\Exports\Sheets\EventPromoSheet;
use App\Exports\Sheets\MembershipSheet;
use App\Exports\Sheets\MerchandiseSheet;
use App\Exports\Sheets\PartnershipSheet;
use App\Exports\Sheets\PembayaranSheet;
use App\Exports\Sheets\RingkasanSheet;
use App\Exports\Sheets\TiketSheet;
use App\Exports\Sheets\TransaksiSheet;
use App\Exports\Sheets\UpsellPackageSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ZooLandReportExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new RingkasanSheet(),
            new TransaksiSheet(),
            new DetailTransaksiSheet(),
            new TiketSheet(),
            new MerchandiseSheet(),
            new MembershipSheet(),
            new PembayaranSheet(),
            new EventPromoSheet(),
            new UpsellPackageSheet(),
            new PartnershipSheet(),
            new AnalyticsSheet(),
        ];
    }
}

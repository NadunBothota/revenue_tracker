<?php

namespace App\Imports;

use App\Models\RevenueRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RevenueRowsImport implements ToCollection, WithHeadingRow
{
    public function __construct(private int $sheetId) {}
    public function collection(Collection $rows)
    {
        foreach ($rows as $r) {
            $net = (float) ($r['net_revenue'] ?? 0);

            RevenueRow::create([
                'revenue_sheet_id' => $this->sheetId,
                'type' => $r['type'] ?? null,
                'song_id' => (string)($r['song_id'] ?? ''),
                'content_title' => $r['content_title'] ?? null,
                'artist_name' => $r['artist_name'] ?? null,
                'net_revenue' => $net, 
            ]);
        }
    }
}

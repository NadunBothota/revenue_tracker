<?php

namespace App\Services;

use App\Models\Content;
use App\Models\RevenueCalculation;
use App\Models\RevenueSheet;
use App\Models\RoyaltyCalculation;
use Illuminate\Support\Facades\DB;

class RevenueCalculationService
{
    public function calculateForSheet(RevenueSheet $sheet): array
    {
        $unmatched = [];

        return DB::transaction(function () use ($sheet, &$unmatched) {

            // Delete previous calculations (recalculate cleanly)
            RevenueCalculation::where('revenue_sheet_id', $sheet->id)->delete();

            $rows = $sheet->rows()->get();

            foreach ($rows as $row) {

                $songId = trim((string)$row->song_id);

                if ($songId === '') {
                    $unmatched[] = [
                        'reason' => 'Missing song_id',
                        'row_id' => $row->id
                    ];
                    continue;
                }

                $content = Content::with(['agreement','owners'])
                    ->where('song_id', $songId)
                    ->first();

                if (!$content || !$content->agreement) {
                    $unmatched[] = [
                        'reason' => 'No agreement found for song_id ' . $songId,
                        'row_id' => $row->id
                    ];
                    continue;
                }

                if ($content->owners->count() === 0) {
                    $unmatched[] = [
                        'reason' => 'No owners defined for song_id ' . $songId,
                        'row_id' => $row->id
                    ];
                    continue;
                }

                $netRevenue = (float) $row->net_revenue;
                $agreementPct = (float) $content->agreement->artist_revenue_percentage;

                $totalArtistAmount = round($netRevenue * ($agreementPct / 100), 2);
                $companyAmount = round($netRevenue - $totalArtistAmount, 2);

                // Validate split total
                $splitTotal = round(
                    $content->owners->sum(fn($o) => (float)$o->pivot->split_percentage),
                    2
                );

                if (abs($splitTotal - 100) > 0.01) {
                    $unmatched[] = [
                        'reason' => 'Owner split total not 100% for song_id ' . $songId,
                        'row_id' => $row->id
                    ];
                    continue;
                }

                foreach ($content->owners as $owner) {

                    $splitPct = (float) $owner->pivot->split_percentage;
                    $ownerAmount = round($totalArtistAmount * ($splitPct / 100), 2);

                    RevenueCalculation::create([
                        'revenue_sheet_id' => $sheet->id,
                        'content_id' => $content->id,
                        'owner_id' => $owner->id,
                        'gross_net_revenue' => $netRevenue,
                        'agreement_percentage' => $agreementPct,
                        'owner_split_percentage' => $splitPct,
                        'owner_amount' => $ownerAmount,
                        'company_amount' => $companyAmount,
                    ]);
                }
            }

            $sheet->update(['status' => 'calculated']);

            return [
                'unmatched' => $unmatched,
                'calculated_count' => RevenueCalculation::where('revenue_sheet_id', $sheet->id)->count()
            ];
        });
    }
}

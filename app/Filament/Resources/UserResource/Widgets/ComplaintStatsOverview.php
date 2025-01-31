<?php
namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;

class ComplaintStatsOverview extends ChartWidget
{
    protected static bool $isLazy = false;
    protected static ?string $heading = 'Analisa Aduan'; 
    protected static ?string $description = 'Aduan yang dikirimkan oleh user setiap bulan';

    protected function getData(): array
    {
        $complaintsPerMonth = Complaint::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

        $labels = [];
        $data = [];

        foreach ($complaintsPerMonth as $complaint) {
            $labels[] = $this->getMonthName($complaint->month); 
            $data[] = $complaint->count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Aduan',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; 
    }

    private function getMonthName(int $month): string
    {
        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun',
            7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        return $months[$month] ?? '';
    }
    public function getColumnSpan(): int|string|array
    {
        return 'full'; 
    }

}

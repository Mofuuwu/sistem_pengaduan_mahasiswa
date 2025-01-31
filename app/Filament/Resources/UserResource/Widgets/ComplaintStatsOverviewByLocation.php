<?php
namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Complaint;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class ComplaintStatsOverviewByLocation extends ChartWidget
{
    protected static bool $isLazy = false;
    protected static ?string $heading = 'Analisa Aduan Berdasarkan Lokasi'; 
    protected static ?string $description = 'Jumlah aduan yang dikirimkan berdasarkan lokasi setiap bulan';

    protected function getData(): array
    {
        // Ambil semua lokasi agar tetap ada di chart meskipun tidak ada aduan
        $locations = Location::pluck('name');

        // Ambil data jumlah aduan per lokasi per bulan
        $complaintsPerMonth = Complaint::select(
            DB::raw('MONTH(complaints.created_at) as month'),
            DB::raw('YEAR(complaints.created_at) as year'),
            'locations.name as location_name',
            DB::raw('COUNT(*) as count')
        )
        ->join('locations', 'complaints.location_id', '=', 'locations.id')
        ->groupBy('year', 'month', 'locations.name')
        ->orderBy('year')
        ->orderBy('month')
        ->orderBy('locations.name')
        ->get();

        // Menyiapkan array untuk chart
        $months = [];  // Label bulan
        $datasets = []; // Data aduan per lokasi

        // Menyusun data awal lokasi agar tidak ada lokasi yang hilang
        foreach ($locations as $location) {
            $datasets[$location] = [];
        }

        // Format data untuk chart
        foreach ($complaintsPerMonth as $complaint) {
            $monthLabel = date('M Y', strtotime($complaint->year . '-' . $complaint->month . '-01'));

            if (!in_array($monthLabel, $months)) {
                $months[] = $monthLabel;
            }

            // Set nilai jumlah aduan per lokasi di setiap bulan
            $datasets[$complaint->location_name][$monthLabel] = $complaint->count;
        }

        // Pastikan setiap lokasi memiliki data untuk semua bulan
        foreach ($datasets as $location => &$data) {
            foreach ($months as $month) {
                $data[$month] = $data[$month] ?? 0;
            }
        }

        // Konversi ke format dataset yang dimengerti oleh chart
        $finalDatasets = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#E7E9ED']; // Warna lokasi

        $index = 0;
        foreach ($datasets as $location => $data) {
            $finalDatasets[] = [
                'label' => $location,
                'data' => array_values($data),
                'borderColor' => $colors[$index % count($colors)], // Warna garis
                'backgroundColor' => 'transparent', // Hilangkan warna latar belakang
                'fill' => false, // Jangan isi area bawah garis
                'tension' => 0.3, // Membuat garis lebih halus
            ];
            $index++;
        }

        return [
            'datasets' => $finalDatasets,
            'labels' => $months,
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false, // Memastikan chart menyesuaikan ukuran
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Mengubah jenis chart menjadi line chart
    }

}

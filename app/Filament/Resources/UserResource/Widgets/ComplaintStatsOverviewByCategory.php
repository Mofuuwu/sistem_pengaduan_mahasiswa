<?php
namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Complaint;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ComplaintStatsOverviewByCategory extends ChartWidget
{
    protected static bool $isLazy = false;
    protected static ?string $heading = 'Analisa Aduan Berdasarkan Kategori'; 
    protected static ?string $description = 'Jumlah aduan yang dikirimkan berdasarkan kategori setiap bulan';

    protected function getData(): array
    {
        
        // Ambil semua kategori agar tetap ada di chart meskipun tidak ada aduan
        $categories = Category::pluck('name');

        // Ambil data jumlah aduan per kategori per bulan
        $complaintsPerMonth = Complaint::select(
            DB::raw('MONTH(complaints.created_at) as month'),
            DB::raw('YEAR(complaints.created_at) as year'),
            'categories.name as category_name',
            DB::raw('COUNT(*) as count')
        )
        ->join('categories', 'complaints.category_id', '=', 'categories.id')
        ->groupBy('year', 'month', 'categories.name')
        ->orderBy('year')
        ->orderBy('month')
        ->orderBy('categories.name')
        ->get();

        // Menyiapkan array untuk chart
        $months = [];  // Label bulan
        $datasets = []; // Data aduan per kategori

        // Menyusun data awal kategori agar tidak ada kategori yang hilang
        foreach ($categories as $category) {
            $datasets[$category] = [];
        }

        // Format data untuk chart
        foreach ($complaintsPerMonth as $complaint) {
            $monthLabel = date('M Y', strtotime($complaint->year . '-' . $complaint->month . '-01'));

            if (!in_array($monthLabel, $months)) {
                $months[] = $monthLabel;
            }

            // Set nilai jumlah aduan per kategori di setiap bulan
            $datasets[$complaint->category_name][$monthLabel] = $complaint->count;
        }

        // Pastikan setiap kategori memiliki data untuk semua bulan
        foreach ($datasets as $category => &$data) {
            foreach ($months as $month) {
                $data[$month] = $data[$month] ?? 0;
            }
        }

        // Konversi ke format dataset yang dimengerti oleh chart
        $finalDatasets = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#E7E9ED']; // Warna kategori

        $index = 0;
        foreach ($datasets as $category => $data) {
            $finalDatasets[] = [
                'label' => $category,
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
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Mengubah jenis chart menjadi line chart
    }
}

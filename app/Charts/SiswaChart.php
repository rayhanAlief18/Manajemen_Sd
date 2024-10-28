<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SiswaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $JumlahMurid1 = DB::table('siswas')->where('kelas_id', 1)->count();
        $JumlahMurid2= DB::table('siswas')->where('kelas_id', 4)->count();
        $JumlahMurid3 = DB::table('siswas')->where('kelas_id', 5)->count();
        $JumlahMurid4 = DB::table('siswas')->where('kelas_id', 6)->count();
        $JumlahMurid5= DB::table('siswas')->where('kelas_id', 7)->count();
        $JumlahMurid6 = DB::table('siswas')->where('kelas_id', 8)->count();
        return $this->chart->lineChart()
            ->setTitle('Jumlah Siswa.')
            ->setSubtitle('Grafik jumlah siswa per kelas')
            ->addData('Physical sales', [$JumlahMurid1,$JumlahMurid2,$JumlahMurid3,$JumlahMurid4,$JumlahMurid5,$JumlahMurid6],90)
            // ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis(['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6',]);
    }
}

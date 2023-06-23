<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalitycsWebsite
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $dateNow = Carbon::now()->format('m');
        $january = DB::table('views_post')->whereMonth('created_at', Carbon::JANUARY)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $feb = DB::table('views_post')->whereMonth('created_at', Carbon::FEBRUARY)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $march = DB::table('views_post')->whereMonth('created_at', Carbon::MARCH)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $appr = DB::table('views_post')->whereMonth('created_at', Carbon::APRIL)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $may = DB::table('views_post')->whereMonth('created_at', Carbon::MAY)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $jun = DB::table('views_post')->whereMonth('created_at', Carbon::JUNE)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $jul = DB::table('views_post')->whereMonth('created_at', Carbon::JULY)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $aug = DB::table('views_post')->whereMonth('created_at', Carbon::AUGUST)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $sept = DB::table('views_post')->whereMonth('created_at', Carbon::SEPTEMBER)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $oct = DB::table('views_post')->whereMonth('created_at', Carbon::OCTOBER)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $nov = DB::table('views_post')->whereMonth('created_at', Carbon::NOVEMBER)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        $dec = DB::table('views_post')->whereMonth('created_at', Carbon::DECEMBER)->whereYear('created_at', Carbon::now()->format('Y'))->count();
        // dd($dateNow);
        if (intval($dateNow) <= 6) {
            return $this->chart->barChart()
                ->setTitle('Pengunjung vs Pengguna.')
                ->setSubtitle('Data Tahun ' . Carbon::now()->format('Y'))
                ->addData('Pengunjung', [$january, $feb, $march, $appr, $may, $jun])
                ->addData('Pengguna', [
                    DB::table('visitors')->whereMonth('created_at', Carbon::JANUARY)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::FEBRUARY)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::MARCH)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::APRIL)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::MAY)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::JUNE)->whereYear('created_at', Carbon::now()->format('Y'))->count()
                ])
                ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
        } else {
            return $this->chart->barChart()
                ->setTitle('Pengunjung vs Pengguna.')
                ->setSubtitle('Data Tahun ' . Carbon::now()->format('Y'))
                ->addData('Pengunjung', [$jul, $aug, $sept, $oct, $nov, $dec])
                ->addData('Pengguna', [
                    DB::table('visitors')->whereMonth('created_at', Carbon::JULY)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::AUGUST)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::SEPTEMBER)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::OCTOBER)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::NOVEMBER)->whereYear('created_at', Carbon::now()->format('Y'))->count(),
                    DB::table('visitors')->whereMonth('created_at', Carbon::DECEMBER)->whereYear('created_at', Carbon::now()->format('Y'))->count()
                ])
                ->setXAxis(['July', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
        }
    }
}

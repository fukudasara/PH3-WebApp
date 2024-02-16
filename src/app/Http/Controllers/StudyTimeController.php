<?php

namespace App\Http\Controllers;

use App\Models\Contents;
use App\Models\Languages;
use App\Models\StudyTime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudyTimeController extends Controller
{
    /**
     * 学習時間の一覧画面を表示する
     */
    public function index()
    {
        $languages = Languages::all();
        $contents = Contents::all();

        $now = Carbon::now();
        $now_format = $now->format('Y-m-d');

        $startOfDay = $now->startOfDay();
        $endOfDay = $now->endOfDay();

        $todays = DB::table('study_times')
            ->whereDate('created_at', '=', $now->format('Y-m-d'))
            ->sum('time');


        $month_format = $now->format('Y-m H:i');
        $weeks = $now->weekOfMonth;

        $months = DB::table('study_times')
            ->whereRaw('MONTH(created_at) = MONTH(?) AND YEAR(created_at) = YEAR(?)', [$now, $now])
            ->sum('time');

        $totals = DB::table('study_times')
            ->sum('time');


        $from = date('Y-m-01'); // 今月の初日
        $to = date('Y-m-t'); // 今月の末日
        $dailyData = DB::table('study_times')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(time) as total_time'))
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => Carbon::parse($item->date)->format('d'),
                    'total_time' => $item->total_time
                ];
            });
            // dd($endOfMonth);


        return view('index', compact('languages', 'contents', 'todays', 'months', 'totals'));
    }

    /**
     * 棒グラフ用のデータを取得・整形して返す
     */
    public function getBarChartData()
    {
        // 今月の1日の0時0分0秒
        $startOfMonth = now()->startOfMonth();
        // 今月の最終日の23時59分59秒
        $endOfMonth = now()->endOfMonth();
        $studyTimes = StudyTime::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('DATE_FORMAT(created_at, "%d") AS date')
            ->selectRaw('SUM(time) AS timeOfDay')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        $data = collect();
        for ($day = 1; $day <= $endOfMonth->day; $day++) {
            $studyTime = $studyTimes->firstWhere('date', $day);
            if ($studyTime) {
                $data->push([
                    'date' => $day,
                    'time' => (int)$studyTime->timeOfDay,
                ]);
            } else {
                $data->push([
                    'date' => $day,
                    'time' => 0,
                ]);
            }
        }
        return response()->json($data);
    }

    /**
     * 言語の円グラフ用のデータを取得・整形して返す
     */
    public function getLanguagesPieChartData()
    {
        $languages = Languages::all();
        $data = collect();
        foreach ($languages as $language) {
            // ここで時間を計算する
            // 今月の1日の0時0分0秒
            $startOfMonth = now()->startOfMonth();
            // 今月の最終日の23時59分59秒
            $endOfMonth = now()->endOfMonth();
            $amount = StudyTime::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('language_id', $language->id)
                ->sum('time');
            $data->push([
                'name' => $language->name,
                'hour' => $amount,
                'color' => $language->color,
            ]);
        }
        return response()->json($data);
    }

    /**
     * コンテンツの円グラフ用のデータを取得・整形して返す
     */
    public function getContentsPieChartData()
    {   
        $contents = Contents::all();
        $data = collect();
        foreach($contents as $content){
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();
            $timeOfStudying = StudyTime::whereBetween('created_at',[$startOfMonth, $endOfMonth] )
                ->where('content_id', $content->id)
                ->sum('time');
                $data->push([
                    'name' => $content->name,
                    'hour' => $timeOfStudying,
                    'color' => $content->color,
                ]);
            }
            return response()->json($data);
        }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $records = new StudyTime;

        // $records->create([
        //     'time' => $request->time,
        //     'record_at' => $request->date,
        //     'content_id' => $request->content,
        //     'language_id' => $request->language,
        // ]);

        // チェックボックスで選択された学習コンテンツのIDの配列を取得
        $contentIds = $request->input('contents', []);
    
        // 選択された学習コンテンツごとに学習記録を作成
        foreach ($contentIds as $contentId) {
            $records = new StudyTime();
            $records->create([
                'time' => $request->input('time'),
                // 'created_at' => $request->input('date'),
                'content_id' => $contentId,
                'language_id' => $request->input('language'),
            ]);
        }

        return redirect()->route('study_time.index');
        dd($records);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

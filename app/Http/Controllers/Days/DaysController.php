<?php

namespace App\Http\Controllers\Days;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Days;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Http\Requests\StoreFutureDayRequest;

class DaysController extends Controller{

    public function index(){
        $Days = Days::OrderBy('days', 'asc')->get();
        return view('days.index', compact('Days'));
    }

    public function createShanba(){
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addYear();
        $saturdays = collect();
        while ($startDate <= $endDate) {
            if ($startDate->isSaturday()) {
                $saturdays->push($startDate->format('Y-m-d'));
            }
            $startDate->addDay();
        }
        foreach ($saturdays as $saturday) {
            Days::updateOrCreate(
                ['days' => $saturday],
                ['description' => 'Shanba Dam olish kuni']
            );
        }
        return back()->with('success', '1 yil davomida barcha shanba kunlari yangilandi!');
    }
    public function createYakshanba(){
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addYear();
        $sundays = collect();
        while ($startDate <= $endDate) {
            if ($startDate->isSunday()) {
                $sundays->push($startDate->format('Y-m-d'));
            }
            $startDate->addDay();
        }
        foreach ($sundays as $sunday) {
            Days::updateOrCreate(
                ['days' => $sunday],
                ['description' => 'Yakshanba Dam olish kuni']
            );
        }
        return back()->with('success', '1 yil davomida barcha yakshanba kunlari yangilandi!');
    }
    public function crateDamKuni(StoreFutureDayRequest $request){
        Days::create([
            'days' => $request->days,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Dam olish kuni muvaffaqiyatli saqlandi!');
    }
    public function deleteArchive(){
        Days::whereDate('days', '<', Carbon::today())->delete();
        return redirect()->back()->with('success', 'Arxivdagi dam olish kunlari muvaffaqiyatli o‘chirildi.');
    }

    public function destroy(Request $request){
        $day = Days::find($request->id);
        if ($day) {
            $day->delete();
            return redirect()->back()->with('success', 'Dam olish kuni o‘chirildi.');
        }
        return redirect()->back()->with('error', 'Topilmadi yoki allaqachon o‘chirilgan.');
    }



}

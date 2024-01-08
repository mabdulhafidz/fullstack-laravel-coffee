<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\Resersvation;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function stepOne(Request $request) 
    {
        $resersvation = $request->session()->get('resersvation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('resersvation.step-one', compact('resersvation', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'tel_number' => ['required'],
            'guest_number' => ['required'],
        ]);

        if (empty($request->session()->get('resersvation'))) {
            $resersvation = new Resersvation();
            $resersvation->fill($validated);
            $request->session()->put('resersvation', $resersvation);
        } else {
            $resersvation = $request->session()->get('resersvation');
            $resersvation->fill($validated);
            $request->session()->put('resersvation', $resersvation);
        }

        return to_route('resersvation.step.two');
    }

    public function stepTwo(Request $request    )
    {
        $resersvation = $request->session()->get('resersvation');
        $res_table_ids = Resersvation::orderBy('res_date')->get()->filter(function ($value) use ($resersvation) {
            return $value->res_date->format('Y-m-d') == $resersvation->res_date->format('Y-m-d');
        })->pluck('table_id');
        $tables = Table::where('status', TableStatus::Avalaiable)
            ->where('guest_number', '>=', $resersvation->guest_number)
            ->whereNotIn('id', $res_table_ids)->get();
        return view('resersvation.step-two', compact('resersvation', 'tables'));
    }

    public function storeStepTwo(Request $request)
    {
        $validated = $request->validate([
            'table_id' => ['required'],
        ]);
        $resersvation = $request->session()->get('resersvation');
        $resersvation->fill($validated);
        $resersvation->save();
        $request->session()->forget('resersvation');

        return to_route('thankyou');
    }
}


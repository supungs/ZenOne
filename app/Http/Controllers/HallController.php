<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Hall;
use App\Models\HallBooking;

class HallController extends Controller
{
    public function schedule(Request $request) {
        $from = $request->input('from', date('Y-m-d'));
        $to = $request->input('to', date('Y-m-d'));
        $hallId = $request->input('hallId');

        return Inertia::render('HallSchedule', [
            'bookings' => HallBooking::whereDate('date', '>=', $from)
                ->whereDate('date', '<=', $to)
                ->when($hallId, function ($query, $hallId) {
                    $query->where('hall_id', $hallId);
                })
                ->with('module')
                ->get(),
            'halls' => fn () => Hall::all()
        ]);
    }
}

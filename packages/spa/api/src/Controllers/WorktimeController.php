<?php

namespace Spa\Api\Controllers;

use App\Http\Controllers\Controller;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Exception;
use Carbon\Carbon;

class WorktimeController extends Controller
{
    public function postHours()
    {
        try {
            $hourStart = request()->hourStart;
            $hourEnd = request()->hourEnd;
            if (is_null($hourStart) || is_null($hourEnd)) {
                throw new Exception("Por favor, digite horas válidas.");
            }
            $this->checkHoursIsValid($hourStart, $hourEnd);

            $response = $this->calculatePeriod($hourStart, $hourEnd);

            return response()->json($response);
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function checkHoursIsValid(string $start, string $end)
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);
        if ($start->greaterThan($end)) {
            throw new Exception("Por favor, a data e hora final devem ser maior que a data e hora de inicio.");
        }
        if ($end->diffInHours($start) > 24) {
            throw new Exception("Por favor, o período deve ser inferior a 24 horas.");
        }
    }

    private function calculatePeriod(string $start, string $end)
    {
        $start = Carbon::parse($start);
        $end = Carbon::parse($end)->subMinute();

        $period = $start->toPeriod($end, 1, 'minutes')->toArray();
        $dailyMinutes = 0;
        $nightlyMinutes = 0;
        foreach ($period as $date) {
            $startTime = $date->copy()->setTimeFromTimeString('05:00:00');
            $endTime = $date->copy()->setTimeFromTimeString('22:00:00');
            if ($date->greaterThanOrEqualTo($startTime) && $date->lessThan($endTime)) {
                $dailyMinutes++;
            } else {
                $nightlyMinutes++;
            }
        }
        $dailyPeriod = CarbonInterval::minutes($dailyMinutes)->cascade()->toArray();
        $nightlyPeriod = CarbonInterval::minutes($nightlyMinutes)->cascade()->toArray();

        return [
            "daily" => [
                "hours" => $dailyPeriod['hours'],
                "minutes" => $dailyPeriod['minutes']
            ],
            "nightly" => [
                "hours" => $nightlyPeriod['hours'],
                "minutes" => $nightlyPeriod['minutes']
            ]
        ];
    }
}
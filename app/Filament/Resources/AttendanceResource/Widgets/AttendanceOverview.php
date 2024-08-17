<?php

namespace App\Filament\Resources\AttendanceResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB; // Import the DB facade

class AttendanceOverview extends BaseWidget
{
    protected function getCards(): array
    {
        // Retrieve the total number of employees
        $totalEmployees = DB::table('employees')->count();

        // Retrieve the number of employees who have checked in today
        $checkedInToday = DB::table('attendances')
            ->whereDate('select_date', today())
            ->distinct('employee_id')
            ->count('employee_id');

        // Retrieve the total number of attendance records
        $totalAttendances = DB::table('attendances')->count();

        // Retrieve the absenteeism rate
        $absenteeismRate = DB::table('employees')
            ->leftJoin('attendances', 'employees.id', '=', 'attendances.employee_id')
            ->whereNull('attendances.id')
            ->count() / $totalEmployees * 100; // Assuming absenteeism rate as percentage

        return [
            Card::make('Total Employees', $totalEmployees),
            Card::make('Checked In Today', $checkedInToday),
            Card::make('Total Attendances', $totalAttendances),
            Card::make('Absenteeism Rate (%)', number_format($absenteeismRate, 2)),
        ];
    }
}

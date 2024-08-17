<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function salaryStructure()
    {
        return $this->belongsTo(SalaryStructure::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Boot method to automatically calculate the total payable amount.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($payroll) {
            $salaryStructure = $payroll->salaryStructure;

            if ($salaryStructure) {
                // Assume 'base_salary' is a column in the 'salary_structures' table
                $totalPayable = $salaryStructure->total_salary - ($payroll->deduction ?? 0);
                $payroll->total_payable = $totalPayable;
            }
        });
    }
}

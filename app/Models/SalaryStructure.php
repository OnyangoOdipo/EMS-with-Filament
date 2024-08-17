<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary_class',
        'basic_salary',
        'mobile_allowance',
        'medical_expenses',
        'houseRent_allowance',
        'total_salary', // Include in fillable to allow mass assignment
    ];

    protected static function booted()
    {
        static::saving(function ($salaryStructure) {
            $salaryStructure->total_salary = $salaryStructure->basic_salary
                + $salaryStructure->mobile_allowance
                + $salaryStructure->medical_expenses
                + $salaryStructure->houseRent_allowance;
        });
    }

    // Accessor for display purposes, but not needed if you're storing total_salary
    public function getTotalSalaryAttribute()
    {
        return $this->attributes['total_salary'] ?? $this->basic_salary
             + $this->mobile_allowance
             + $this->medical_expenses
             + $this->houseRent_allowance;
    }
}

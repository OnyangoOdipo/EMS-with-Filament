<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PayrollResource\Pages;
use App\Models\Payroll;
use App\Models\SalaryStructure; // Add this
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class PayrollResource extends Resource
{
    protected static ?string $model = Payroll::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required(),
                Forms\Components\Select::make('salary_structure_id')
                    ->relationship('salaryStructure', 'salary_class')
                    ->required(),
                Forms\Components\TextInput::make('deduction')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('reason'),
                Forms\Components\TextInput::make('year'),
                Forms\Components\TextInput::make('month')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->label('Date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.name')
                    ->label('Employee')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('month')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total_payable')
                    ->label('Total Payable')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('date')
                    ->label('Date')
                    ->date('Y-m-d'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayrolls::route('/'),
            'create' => Pages\CreatePayroll::route('/create'),
            'edit' => Pages\EditPayroll::route('/{record}/edit'),
        ];
    }    
}

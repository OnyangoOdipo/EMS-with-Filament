<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DesignationResource\Pages;
use App\Models\Designation;
use App\Models\Department;
use App\Models\SalaryStructure;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class DesignationResource extends Resource
{
    protected static ?string $model = Designation::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('designation_name')
                    ->required()
                    ->maxLength(30)
                    ->label('Designation Name'),

                Select::make('salary_structure_id')
                    ->label('Salary Structure')
                    ->options(SalaryStructure::all()->pluck('salary_class', 'id'))
                    ->required(),

                Select::make('department_id')
                    ->label('Department')
                    ->options(Department::all()->pluck('department_name', 'id'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('designation_name')
                    ->sortable()
                    ->searchable()
                    ->label('Designation Name'),

                TextColumn::make('salaryStructure.salary_class')
                    ->sortable()
                    ->searchable()
                    ->label('Salary Structure'),

                TextColumn::make('department.department_name')
                    ->sortable()
                    ->searchable()
                    ->label('Department'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created At'),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->label('Updated At'),
            ])
            ->filters([
                // Add any table filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            // Define any relation managers if needed
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDesignations::route('/'),
            'create' => Pages\CreateDesignation::route('/create'),
            'edit' => Pages\EditDesignation::route('/{record}/edit'),
        ];
    }
}

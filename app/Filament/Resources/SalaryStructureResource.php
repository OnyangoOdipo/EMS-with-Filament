<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SalaryStructureResource\Pages;
use App\Models\SalaryStructure;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class SalaryStructureResource extends Resource
{
    protected static ?string $model = SalaryStructure::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('salary_class')
                    ->required()
                    ->maxLength(50)
                    ->label('Salary Class'),
                TextInput::make('basic_salary')
                    ->required()
                    ->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask->money('USD', true))
                    ->label('Basic Salary'),
                TextInput::make('mobile_allowance')
                    ->required()
                    ->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask->money('USD', true))
                    ->label('Mobile Allowance'),
                TextInput::make('medical_expenses')
                    ->required()
                    ->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask->money('USD', true))
                    ->label('Medical Expenses'),
                TextInput::make('houseRent_allowance')
                    ->required()
                    ->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask->money('USD', true))
                    ->label('House Rent Allowance'),
                // Removed 'total_salary' from the form
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('salary_class')
                    ->sortable()
                    ->searchable()
                    ->label('Salary Class'),
                TextColumn::make('basic_salary')
                    ->sortable()
                    ->label('Basic Salary'),
                TextColumn::make('mobile_allowance')
                    ->sortable()
                    ->label('Mobile Allowance'),
                TextColumn::make('medical_expenses')
                    ->sortable()
                    ->label('Medical Expenses'),
                TextColumn::make('houseRent_allowance')
                    ->sortable()
                    ->label('House Rent Allowance'),
                TextColumn::make('total_salary')
                    ->sortable()
                    ->label('Total Salary')
                    ->formatStateUsing(fn ($record) => $record->total_salary), // Use accessor here
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
            'index' => Pages\ListSalaryStructures::route('/'),
            'create' => Pages\CreateSalaryStructure::route('/create'),
            'edit' => Pages\EditSalaryStructure::route('/{record}/edit'),
        ];
    }
}

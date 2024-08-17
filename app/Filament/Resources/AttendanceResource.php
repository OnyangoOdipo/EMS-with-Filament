<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\Widgets\AttendanceOverview;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Carbon\Carbon;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('employee_id')
                    ->required()
                    ->label('Employee ID'),
                TextInput::make('department_id')
                    ->required()
                    ->label('Department ID'),
                TextInput::make('designation_id')
                    ->required()
                    ->label('Designation ID'),
                TextInput::make('select_date')
                    ->required()
                    ->label('Date'),
                TextInput::make('month')
                    ->required()
                    ->label('Month'),
                TextInput::make('check_in')
                    ->label('Check In'),
                TextInput::make('late')
                    ->label('Late'),
                TextInput::make('check_out')
                    ->label('Check Out'),
                TextInput::make('overtime')
                    ->label('Overtime'),
                TextInput::make('duration_minutes')
                    ->label('Duration (minutes)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee_id')
                    ->sortable()
                    ->searchable()
                    ->label('Employee ID'),
                TextColumn::make('department_id')
                    ->sortable()
                    ->searchable()
                    ->label('Department ID'),
                TextColumn::make('designation_id')
                    ->sortable()
                    ->searchable()
                    ->label('Designation ID'),
                TextColumn::make('select_date')
                    ->sortable()
                    ->label('Date')
                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('Y-m-d') : null),
                TextColumn::make('check_in')
                    ->label('Check In')
                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('H:i:s') : null),
                TextColumn::make('late')
                    ->label('Late'),
                TextColumn::make('check_out')
                    ->label('Check Out')
                    ->formatStateUsing(fn ($state) => $state ? Carbon::parse($state)->format('H:i:s') : null),
                TextColumn::make('overtime')
                    ->label('Overtime'),
                TextColumn::make('duration_minutes')
                    ->label('Duration (minutes)'),
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

    public static function getWidgets(): array
    {
        return [
            AttendanceOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}

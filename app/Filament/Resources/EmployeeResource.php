<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use App\Models\SalaryStructure;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker; // Import DatePicker
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->reactive() // Make it reactive to trigger updates
                    ->afterStateUpdated(function (callable $set, $state) {
                        if ($user = User::find($state)) {
                            $set('name', $user->name);
                            $set('email', $user->email);
                            $set('phone', $user->phone);
                            $set('location', $user->location); // Assuming there's a location in the users table
                        }
                    })
                    ->required(),

                TextInput::make('name')
                    ->required()
                    ->maxLength(20)
                    ->label('Employee Name'),

                Select::make('department_id')
                    ->label('Department')
                    ->options(Department::all()->pluck('department_name', 'id'))
                    ->required(),

                Select::make('designation_id')
                    ->label('Designation')
                    ->options(Designation::all()->pluck('designation_name', 'id'))
                    ->required(),

                Select::make('salary_structure_id')
                    ->label('Salary Structure')
                    ->options(SalaryStructure::all()->pluck('salary_class', 'id'))
                    ->required(),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(30)
                    ->label('Email'),

                TextInput::make('phone')
                    ->maxLength(15)
                    ->label('Phone'),

                TextInput::make('location')
                    ->maxLength(30)
                    ->label('Location'),

                FileUpload::make('employee_image')
                    ->image()
                    ->disk('public')
                    ->label('Employee Image'),

                TextInput::make('joining_mode')
                    ->maxLength(30)
                    ->label('Joining Mode'),

                DatePicker::make('date_of_birth') // Changed to DatePicker
                    ->label('Date of Birth'),

                DatePicker::make('hire_date') // Changed to DatePicker
                    ->required()
                    ->label('Hire Date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Employee Name'),

                TextColumn::make('department.department_name')
                    ->sortable()
                    ->searchable()
                    ->label('Department'),

                TextColumn::make('designation.designation_name')
                    ->sortable()
                    ->searchable()
                    ->label('Designation'),

                TextColumn::make('salaryStructure.salary_class')
                    ->sortable()
                    ->searchable()
                    ->label('Salary Structure'),

                TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->label('Email'),

                TextColumn::make('phone')
                    ->sortable()
                    ->searchable()
                    ->label('Phone'),

                TextColumn::make('location')
                    ->sortable()
                    ->searchable()
                    ->label('Location'),

                TextColumn::make('date_of_birth')
                    ->date()
                    ->label('Date of Birth'),

                TextColumn::make('hire_date')
                    ->date()
                    ->label('Hire Date'),

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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}

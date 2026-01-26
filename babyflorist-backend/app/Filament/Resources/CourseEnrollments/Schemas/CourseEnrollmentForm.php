<?php

namespace App\Filament\Resources\CourseEnrollments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CourseEnrollmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('course_id')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('purchased_at'),
                TextInput::make('progress')
                    ->required()
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('last_accessed_at'),
            ]);
    }
}

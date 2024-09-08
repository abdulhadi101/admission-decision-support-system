<?php

namespace App\Filament\Resources\CourseRequirementResource\Pages;

use App\Filament\Resources\CourseRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourseRequirements extends ListRecords
{
    protected static string $resource = CourseRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

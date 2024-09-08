<?php

namespace App\Filament\Resources\CourseRequirementResource\Pages;

use App\Filament\Resources\CourseRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCourseRequirement extends EditRecord
{
    protected static string $resource = CourseRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

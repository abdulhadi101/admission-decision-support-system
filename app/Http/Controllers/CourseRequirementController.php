<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRequirement;
use Illuminate\Http\Request;

class CourseRequirementController extends Controller
{
    public function index(Course $course)
    {
        $requirements = $course->requirements;
        return view('course.requirements', compact('course', 'requirements'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'minimum_grade' => 'required|in:A1,B2,B3,C4,C5,C6,D7,E8,F9',
            'weight' => 'required|numeric|min:0|max:2',
        ]);

        $course->requirements()->create($validated);

        return redirect()->route('course.requirements', $course)->with('success', 'Requirement added successfully');
    }

    public function update(Request $request, CourseRequirement $requirement)
    {
        $validated = $request->validate([
            'subject' => 'required|string',
            'minimum_grade' => 'required|in:A1,B2,B3,C4,C5,C6,D7,E8,F9',
            'weight' => 'required|numeric|min:0|max:2',
        ]);

        $requirement->update($validated);

        return redirect()->route('course.requirements', $requirement->course)->with('success', 'Requirement updated successfully');
    }

    public function destroy(CourseRequirement $requirement)
    {
        $course = $requirement->course;
        $requirement->delete();

        return redirect()->route('course.requirements', $course)->with('success', 'Requirement deleted successfully');
    }
}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Applicant Profile</h2>
    <form method="POST" action="{{ route('applicant.profile.update') }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="jamb_score">JAMB Score</label>
            <input type="number" class="form-control" id="jamb_score" name="jamb_score" value="{{ $applicant->jamb_score }}" required>
        </div>
        
        <div class="form-group">
            <label for="course_id">Preferred Course</label>
            <select class="form-control" id="course_id" name="course_id" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $applicant->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <h3>O-Level Results</h3>
        <div id="o-level-results">
            @foreach($oLevelResults as $index => $result)
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="o_level_results[{{ $index }}][subject]" value="{{ $result->subject }}" required placeholder="Subject">
                    </div>
                    <div class="form-group col-md-4">
                        <select class="form-control" name="o_level_results[{{ $index }}][grade]" required>
                            @foreach(['A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9'] as $grade)
                                <option value="{{ $grade }}" {{ $result->grade == $grade ? 'selected' : '' }}>{{ $grade }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <select class="form-control" name="o_level_results[{{ $index }}][exam_board]" required>
                            <option value="WAEC" {{ $result->exam_board == 'WAEC' ? 'selected' : '' }}>WAEC</option>
                            <option value="NECO" {{ $result->exam_board == 'NECO' ? 'selected' : '' }}>NECO</option>
                        </select>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-result" class="btn btn-secondary mb-3">Add Subject</button>
        
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>

    @if($recommendations->isNotEmpty())
        <h3 class="mt-5">Recommended Courses</h3>
        <ul class="list-group">
            @foreach($recommendations as $recommendation)
                <li class="list-group-item">
                    {{ $recommendation['course']->name }} 
                    (Fit Score: {{ number_format($recommendation['score'] * 100, 2) }}%)
                </li>
            @endforeach
        </ul>
    @endif
</div>

<script>
document.getElementById('add-result').addEventListener('click', function() {
    const resultsDiv = document.getElementById('o-level-results');
    const index = resultsDiv.children.length;
    if (index < 8) {
        const newResultHTML = `
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="o_level_results[${index}][subject]" required placeholder="Subject">
                </div>
                <div class="form-group col-md-4">
                    <select class="form-control" name="o_level_results[${index}][grade]" required>
                        <option value="">Select Grade</option>
                        <option value="A1">A1</option>
                        <option value="B2">B2</option>
                        <option value="B3">B3</option>
                        <option value="C4">C4</option>
                        <option value="C5">C5</option>
                        <option value="C6">C6</option>
                        <option value="D7">D7</option>
                        <option value="E8">E8</option>
                        <option value="F9">F9</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <select class="form-control" name="o_level_results[${index}][exam_board]" required>
                        <option value="">Select Exam Board</option>
                        <option value="WAEC">WAEC</option>
                        <option value="NECO">NECO</option>
                    </select>
                </div>
            </div>
        `;
        resultsDiv.insertAdjacentHTML('beforeend', newResultHTML);
    } else {
        alert('Maximum of 8 O-level results allowed.');
    }
});
</script>
@endsection
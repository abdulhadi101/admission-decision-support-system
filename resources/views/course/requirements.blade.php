@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Course Requirements for {{ $course->name }}</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Minimum Grade</th>
                <th>Weight</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requirements as $requirement)
            <tr>
                <td>{{ $requirement->subject }}</td>
                <td>{{ $requirement->minimum_grade }}</td>
                <td>{{ $requirement->weight }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-primary edit-requirement" data-id="{{ $requirement->id }}">Edit</a>
                    <form action="{{ route('course.requirements.destroy', $requirement) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Add New Requirement</h3>
    <form action="{{ route('course.requirements.store', $course) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="minimum_grade">Minimum Grade</label>
            <select class="form-control" id="minimum_grade" name="minimum_grade" required>
                @foreach(['A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9'] as $grade)
                    <option value="{{ $grade }}">{{ $grade }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" step="0.1" min="0" max="2" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Requirement</button>
    </form>
</div>

<div class="modal fade" id="editRequirementModal" tabindex="-1" role="dialog" aria-labelledby="editRequirementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRequirementModalLabel">Edit Requirement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editRequirementForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_subject">Subject</label>
                        <input type="text" class="form-control" id="edit_subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_minimum_grade">Minimum Grade</label>
                        <select class="form-control" id="edit_minimum_grade" name="minimum_grade" required>
                            @foreach(['A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9'] as $grade)
                                <option value="{{ $grade }}">{{ $grade }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_weight">Weight</label>
                        <input type="number" class="form-control" id="edit_weight" name="weight" step="0.1" min="0" max="2" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.edit-requirement').click(function(e) {
        e.preventDefault();
        var requirementId = $(this).data('id');
        var row = $(this).closest('tr');
        var subject = row.find('td:eq(0)').text();
        var minimumGrade = row.find('td:eq(1)').text();
        var weight = row.find('td:eq(2)').text();

        $('#edit_subject').val(subject);
        $('#edit_minimum_grade').val(minimumGrade);
        $('#edit_weight').val(weight);

        $('#editRequirementForm').attr('action', '/course-requirements/' + requirementId);
        $('#editRequirementModal').modal('show');
    });
});
</script>
@endsection

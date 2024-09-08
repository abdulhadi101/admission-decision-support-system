<div>
    <form wire:submit.prevent="submitApplication" class="space-y-4">
        <div>
            <label for="jamb_score" class="block text-sm font-medium text-gray-700">JAMB Score</label>
            <input type="number" id="jamb_score" wire:model="jambScore" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>
        <div>
            <label for="course" class="block text-sm font-medium text-gray-700">Preferred Course</label>
            <select id="course" wire:model="selectedCourse" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="">Select a course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <h3 class="text-lg font-medium text-gray-700 mb-2">O-Level Results</h3>
            @foreach($subjects as $index => $subject)
                <div class="flex space-x-2 mb-2">
                    <select wire:model="subjects.{{ $index }}" required class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Select Subject</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="English">English</option>
                        <option value="Physics">Physics</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="Biology">Biology</option>
                    </select>
                    <select wire:model="grades.{{ $index }}" required class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
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
                    <select wire:model="examBoards.{{ $index }}" required class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Select Exam Board</option>
                        <option value="WAEC">WAEC</option>
                        <option value="NECO">NECO</option>
                        <option value="NABTEB">NABTEB</option>
                    </select>
                    @if($index > 0)
                        <button type="button" wire:click="removeSubject({{ $index }})" class="px-2 py-1 text-red-600 hover:text-red-800">
                            Remove
                        </button>
                    @endif
                </div>
            @endforeach
            <button type="button" wire:click="addSubject" class="mt-2 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Add Subject
            </button>
        </div>
        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Submit Application
            </button>
        </div>
    </form>
    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif

    @if (!empty($recommendations))
        <div class="mt-8">
            <h3 class="text-2xl font-semibold mb-4">Course Recommendations</h3>
            @foreach($recommendations as $recommendation)
                <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                    <h4 class="text-xl font-medium">{{ $recommendation['course']->name }}</h4>
                    <p class="mt-2">Fit Score: {{ number_format($recommendation['score'] * 100, 2) }}%</p>
                    @if($recommendation['meetsRequirements'])
                        <p class="text-green-600">You meet all requirements for this course!</p>
                    @else
                        <p class="text-red-600">You don't meet all requirements for this course.</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
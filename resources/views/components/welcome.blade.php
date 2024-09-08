<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <x-application-logo class="block h-12 w-auto" />

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Admission Decision Support System</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-3xl font-bold">University Admission Decision Support System</h1>
    </header>
    <main class="container mx-auto mt-8 p-4">
        <section class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Enter Your Details</h2>
            <form action="#" method="POST" class="space-y-4">
                <div>
                    <label for="jamb_score" class="block text-sm font-medium text-gray-700">JAMB Score</label>
                    <input type="number" id="jamb_score" name="jamb_score" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="course" class="block text-sm font-medium text-gray-700">Preferred Course</label>
                    <select id="course" name="course" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Select a course</option>
                        <!-- Placeholder for course options -->
                        <option value="1">Computer Science</option>
                        <option value="2">Engineering</option>
                        <option value="3">Medicine</option>
                    </select>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">O-Level Results</h3>
                    <div class="space-y-2">
                        <!-- Repeat this block for each subject -->
                        <div class="flex space-x-2">
                            <select name="subjects[]" required class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Select Subject</option>
                                <option value="Mathematics">Mathematics</option>
                                <option value="English">English</option>
                                <option value="Physics">Physics</option>
                                <!-- Add more subjects as needed -->
                            </select>
                            <select name="grades[]" required class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Select Grade</option>
                                <option value="A1">A1</option>
                                <option value="B2">B2</option>
                                <option value="B3">B3</option>
                                <option value="C4">C4</option>
                                <option value="C5">C5</option>
                                <option value="C6">C6</option>
                            </select>
                            <select name="exam_boards[]" required class="w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Select Exam Board</option>
                                <option value="WAEC">WAEC</option>
                                <option value="NECO">NECO</option>
                                <option value="NABTEB">NABTEB</option>
                            </select>
                        </div>
                        <!-- End of subject block -->
                    </div>
                    <button type="button" id="add-subject" class="mt-2 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Add Subject
                    </button>
                </div>
                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit Application
                    </button>
                </div>
            </form>
        </section>
    </main>
    <footer class="bg-gray-200 text-center p-4 mt-8">
        <p>&copy; 2024 University Admission Decision Support System. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('add-subject').addEventListener('click', function() {
            const subjectBlock = document.querySelector('.space-y-2');
            const newSubject = subjectBlock.children[0].cloneNode(true);
            // Reset the selected values
            newSubject.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
            subjectBlock.appendChild(newSubject);
        });
    </script>
</body>
</html>
</div>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Admission Decision Support System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>

<body>
    <div class="max-w-3xl mx-auto py-8" x-data="{ applicantType: null }">
        <div class="bg-blue-100 p-4 rounded-md">
            <h2 class="text-blue-800 font-bold text-xl">Welcome to the University Admission Decision Support System</h2>
            <p class="text-blue-600">This tool can help you navigate the admission process for Nigerian universities.
            </p>
        </div>

        <div class="mt-6" x-show="applicantType === null">
            <h3 class="text-gray-800 font-bold text-lg">Get Started</h3>
            <p class="text-gray-600 mb-4">Please register or login as an applicant :</p>
            <div class="flex justify-center space-x-4">
                <a href="/login" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Login
                </a>
                <a href="/register" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Register
                </a>
            </div>
        </div>

        <div class="mt-6" x-show="applicantType !== null">
            <h3 class="text-gray-800 font-bold text-lg">About the System</h3>
            <p class="text-gray-600">
                This decision support system is designed to guide you through the
                university admission process in Nigeria. It provides personalized
                recommendations based on your academic profile, preferences, and
                the admission requirements of different universities.
            </p>
        </div>
    </div>
</body>

</html>

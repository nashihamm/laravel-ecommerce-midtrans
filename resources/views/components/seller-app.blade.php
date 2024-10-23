<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@heroicons/react/outline"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex-1 flex">
        <!-- Sidebar -->
        <x-admin.sidebar />

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-white shadow-lg rounded-lg m-6">
            {{ $slot }}
        </main>
    </div>

</body>
</html>

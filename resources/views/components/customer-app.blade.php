<!-- resources/views/components/customer_app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Customer Dashboard' }}</title>
    @vite('resources/css/app.css') 
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">

        <x-client.navbar cart="$cart" />
        
        <!-- Main Content -->
        <main class="flex-1">
            {{ $slot }}
        </main>
        <x-footer />

    </div>
</body>
</html>

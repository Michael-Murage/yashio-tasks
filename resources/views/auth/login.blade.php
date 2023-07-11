<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased">
        <div class="flex justify-center" style="height: 100vh">
            <div class='w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg my-auto my-auto'>
                <form method="POST" id="registration-form" action="{{ route('register-user') }}" class=''>
                    @csrf

                    <div class="mt-4">
                        <label for="email" class='block font-medium text-sm text-gray-700'>Email</label>
                        <input type="email" name='email' class='border-gray-300 focus:border-indigo-500 rounded-md shadow-sm block mt-1 w-full'>
                    </div>

                    <div class="mt-4">
                        <label for="password" class='block font-medium text-sm text-gray-700'>Password</label>
                        <input type="password" name='password' class='border-gray-300 focus:border-indigo-500 rounded-md shadow-sm block mt-1 w-full'>
                    </div>

                    <div class="">
                        <input 
                            type="submit" 
                            value="Login" 
                            class='ml-auto my-3 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 bg-blue-500 hover:bg-blue-300'
                        >
                    </div>

                </form>
            </div>
        </div>
    </body>
<html>
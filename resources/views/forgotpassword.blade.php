<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Search Engine</title>
    <!--- Website LOGO --->
    <link rel="icon" href="logos/logo.png" type="x-icon">
    <!--Tailwind css-->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>
</head>
<body class="bg-gradient-to-r from-teal-200 to-lime-200">
    </br>
    <a href="{{ url( '/login') }}" class="ml-2 mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
    < Back
    </a>
    <div class="loginCard p-4 mx-auto max-w-lg bg-blue-200 rounded-lg border border-gray-200 shadow-md">
        @if(session()->has('message'))
        <div class=" p-4 mb-4 text-sm text-gray-700 bg-green-100 rounded-lg" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('error_message'))
        <div class=" p-4 mb-4 text-sm text-gray-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                {{ session()->get('error_message') }}
            </div>
        @endif
        <form method="post" action="{{ url('/main/forgot_password') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Enter Email</label>
            <input type="email" id="resetEmail" name="email" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" required="">
           </div>
        <div class="form-group mt-4">
               <button type="submit" name="Reset Password" value="Reset Password" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Reset Password</button>
            </div>
        </form>
    </div>
</body>
</html>

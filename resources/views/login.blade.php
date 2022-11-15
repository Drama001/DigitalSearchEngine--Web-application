<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>
<body class="bg-gradient-to-r from-teal-200 to-lime-200">
<div class="text-center text-2xl mt-10 ">Login To Continue</div>
    <div class="p-6 mx-auto max-w-lg bg-blue-200 rounded-lg border border-gray-200 shadow-md">
    <form method="post" action="{{ url('/verification') }}">
       {{ csrf_field() }} 
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" placeholder="name@mail.com" required="">
        </div>
        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your password</label>
            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" required="">
            <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400 flex justify-end"><a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Forgot Password?</a></p>
        </div>
        <div class="flex items-start">
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>
</body>
</html>
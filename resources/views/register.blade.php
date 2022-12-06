<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width", initial-scale="1.0">
    <title>Digital Search Engine</title>
    <!--- Website LOGO --->
    <link rel = "icon" href = "logos/logo.png" type = "x-icon">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <style>
        .registerCard{
            margin-top: 100px;
            margin-bottom: 160px;
        }
        </style>
</head>
<body class="bg-gradient-to-r from-teal-200 to-lime-200 ">
    </br>
<a href="{{ url( '/') }}" class="ml-2 mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
  < Back
</a>
<div class="registerCard p-4 mx-auto max-w-xl bg-blue-200 rounded-lg border border-gray-200 shadow-md">
    <form>
    <div class="grid md:grid-cols-2 md:gap-6">
      <div class="mb-6">
        <label for="firstName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name</label>
        <input type="text" name="firstName" id="firstName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" required="">
    </div>
    <div class="mb-6">
        <label for="lastName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name</label>
        <input type="text" name="lastName" id="lastName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" required="">
    </div>
      </div>
    <div class="mb-6">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" placeholder="name@mail.com" required="">
    </div>
           <div class="mb-6">
               <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
               <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" required="">
           </div>
           <div class="mb-6">
               <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Password</label>
               <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" required="">
           </div>     
      <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      <p class="text-sm font-light text-gray-500 dark:text-gray-400 py-2 ">
        Already have an account? <a href="{{ url( '/login') }}" class="font-medium text-primary-600 hover:underline">Login here</a>
      </p>
    </form>
</div>
</body>
<footer>
    @include('footer')
</footer>
</html>
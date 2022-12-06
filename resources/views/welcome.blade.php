<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Search Engine</title>
    <!--- Website LOGO --->
    <link rel = "icon" href = "logos/logo.png" type = "x-icon">
    <!---Tailwind CSS --->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>
<body class="bg-gradient-to-r from-teal-200 to-lime-200">
  <div class="w-screen h-screen flex justify-center items-center flex-col">
  <h1 class="text-3xl font-bold ">DIGITAL SEARCH ENGINE</h1>
  <div>
  <button type="button" class="p-2.5 ml-2 px-4 text-sm font-medium text-white bg-gray-700 rounded-md border border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300"><a href="{{url('/login') }}">Login</a></button>
  <button type="button" class="p-2.5 ml-2 text-sm font-medium text-white bg-gray-700 rounded-md border border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300"><a href="{{url('/register') }}">Register</a></button>
</div>
  <div class="searchBox container mx-auto w-1/2 mt-8">  
            <form class="flex items-center" action="{{ url('/viewSearch') }}" method="GET">   
                <label for="simple-search" class="sr-only"></label>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" id="simple-search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type Here.." required="">
                </div>
                <button type="submit" name="sh" class="p-2.5 ml-2 text-sm font-medium text-white bg-gray-700 rounded-md border border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300">
                    <p>Search</p>
                </button>
            </form>
    </div>  
</div>
</body>

<footer>
    @include('footer')
</footer>

</html>

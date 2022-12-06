<!DOCTYPE html>
<html lang="en">
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
    <style>
        body{
            background-color: rgb(7 89 133);
        }
        .uploadDocument{
            margin-top: 70px;
        }
        footer{
            margin-top: 50px;
        }
        </style>
</head>
<body>
    </br>
    <a href="{{ url( '/home') }}" class="ml-2 mt-2 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
    < Back
    </a>
    <div class="uploadDocument p-6 mx-auto max-w-xl bg-gray-700 rounded-lg border border-gray-700 shadow-md">
    <form method="POST" action="{{ url('/indexdata') }}">
        {{ csrf_field() }}
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-white">Title</label>
    <input type="text" name="title" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-white">Author</label>
    <input type="text" name="author" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-white">University</label>
    <input type="text" name="university" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-white">Program</label>
    <input type="text" name="program" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-white">Degree</label>
    <input type="text" name="degree" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-white">Year</label>
    <input type="text" name="year" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="large-input" class="block mb-2 text-sm font-medium text-white">Abstract</label>
    <input type="text" name="abstract" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-white">Upload PDF</label>
    <input type="file" name="file" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    </br>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

</form>
    </div>    
</body>

<footer>
    @include('footer')
</footer>

</html>
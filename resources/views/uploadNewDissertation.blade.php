<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>
<body>
    <div class="p-6 mx-auto max-w-lg bg-blue-200 rounded-lg border border-gray-200 shadow-md">
            UPLOAD ETD
    <form method="POST" action="{{ url('/indexdata') }}">
        {{ csrf_field() }}
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
    <input type="text" name="title" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 ">Author</label>
    <input type="text" name="author" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 ">University</label>
    <input type="text" name="university" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 ">Program</label>
    <input type="text" name="program" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 ">Degree</label>
    <input type="text" name="degree" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Year</label>
    <input type="text" name="year" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Abstract</label>
    <input type="text" name="abstract" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <div>
    <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Upload PDF</label>
    <input type="file" name="pdf" id="small-input" class="block p-2 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-xs focus:ring-blue-500 focus:border-blue-500">
    </div>
    <button type="submit" name="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-gray-900 rounded-md border border-gray-500 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 ">
    <p>submit</p></button>
    </form>
    </div>    
    </body>

</html>
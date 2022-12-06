<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Search Engine</title>
    <!--- Website LOGO --->
    <link rel = "icon" href = "logos/logo.png" type = "x-icon">
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <!-- google recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        .loginCard{
            margin-top: 100px;
            margin-bottom: 220px;
        }
        </style>
</head>

<body class="bg-gradient-to-r from-teal-200 to-lime-200">
    </br>
<a href="{{ url( '/') }}" class="ml-2 mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
    < Back
</a>
    <div class="loginCard p-4 mx-auto max-w-lg bg-blue-200 rounded-lg border border-gray-200 shadow-md">
<!--To display error messages-->
    @if ($message = Session::get('error'))
    <div class=" p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
    <strong>{{ $message }}</strong>
    </div>
   @endif

   @if ($message = Session::get('message'))
   <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
    <strong>{{ $message }}</strong>
    </div>
   @endif

   @if (count($errors) > 0)
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif

   <!---Login Form --->
    <form method="post" action="{{ url('/verification') }}">
       {{ csrf_field() }} 
           <div class="mb-6">
               <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
               <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" placeholder="name@mail.com" required="">
           </div>
           <div class="mb-6">
               <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
               <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" required="">
               <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400 flex justify-end"><a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Forgot Password?</a></p>
           </div>
           <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
           <br/>
           <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
           <p class="text-sm font-light text-gray-500 dark:text-gray-400 py-2 ">
        Don't have an account? <a href="{{ url( '/register') }}" class="font-medium text-primary-600 hover:underline">create here</a>
      </p>
        </form>
    </div>
</body>
<footer>
    @include('footer')
</footer>
</html>
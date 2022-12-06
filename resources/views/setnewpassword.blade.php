<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Digital Search Engine</title>
        <!--- Website LOGO --->
        <link rel="icon" type="x-icon" href="{{ asset('logos/logo.png') }}">
        <!--Tailwind css-->
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
        <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    </head>


 <body class="bg-gradient-to-r from-teal-200 to-lime-200">
    </br>
    <a href="\login" class="ml-2 mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
    < Login
    </a>
    <div class="loginCard p-4 mx-auto max-w-lg bg-blue-200 rounded-lg border border-gray-200 shadow-md">
    <br/>

    @if(session()->has('message'))
    <div class=" p-4 mb-4 text-sm text-gray-700 bg-green-100 rounded-lg" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    @if($message ?? '')
    <div class=" p-4 mb-4 text-sm text-gray-700 bg-green-100 rounded-lg" role="alert">
        {{ $message ?? '' }}
        </div>
    @endif
    @if ($message = Session::get('error'))
    <div class=" p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    @endif

   <form method="post" action="{{ url('/main/set_password') }}">
       {{ csrf_field() }} 
       <input type="hidden" name="id" value="{{$user->id}}" />
           <div class="mb-6 form-group">
               <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">New Password</label>
               <input type="password" id="password" name="new_password" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" required="">
           </div>
           <div class="mb-6 form-group">
               <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Password</label>
               <input type="password" name="confirm_password" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-blue-50" required="">
           </div>
           <div class="form-group">
               <button type="submit" name="Reset Password" value="Reset Password" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Reset Password</button>
            </div>
        </form>
  </div>
</div>
 </body>
</html>
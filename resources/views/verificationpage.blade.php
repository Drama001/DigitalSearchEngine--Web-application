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
        footer{
            margin-top: 500px;
        }
        </style>
</head>
<body class="bg-gradient-to-r from-teal-200 to-lime-200">

<div class="container box">
   <!--@if(isset(Auth::user()->verification_code))
    <script>window.location="/index";</script>
   @endif-->

   @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if ($message = Session::get('message'))
    <div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

   @if (count($errors) > 0)
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif
<div class="text-center text-2xl mt-10"> Enter the verfication code sent to your email</div>
   <div class="p-6 mx-auto max-w-lg bg-blue-200 rounded-lg border border-gray-200 shadow-md">

        <form method="get" action="{{ url('/verifyuser') }}">
        {{ csrf_field() }}
        <div class="mb-6">
            <label for="otp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enter Verfication code</label>
            <input type="text"  name="verification_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="*****" required>
        </div>
        <button type="submit" name="login" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
        </form>

    </div>

   <!-- <form method="get" action="{{ url('/verifyuser') }}">
   {{ csrf_field() }}
    <div class="form-group">
     <label>Enter Verification Code Here! </label>
     <input type="text" name="verification_code" class="form-control" />
    </div>
    <div class="form-group">
     <input type="submit" name="login" class="btn btn-primary" value="Login" />
    </div>
   </form> -->
</div>
 </body>

 <footer>
    @include('footer')
</footer>
</html>
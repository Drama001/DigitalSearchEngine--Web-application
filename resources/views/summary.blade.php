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
        .capitalize{
            text-transform:capitalize;
        }
        body{
            background-color: rgb(7 89 133);
        }
        footer{
            margin-top: 250px;
        }
        </style>
</head>
<body>
    <div class="navBar" >
        <nav class="px-2 bg-white border-gray-200">
        <div class="container flex flex-wrap justify-between items-center mx-auto ">
            <a href="#" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Summary</span>
            </a>
            <button data-collapse-toggle="mobile-menu" type="button" class="inline-flex justify-center items-center ml-3 text-gray-400 rounded-lg md:hidden hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-500" aria-controls="mobile-menu-2" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
            <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                <a href="{{ url( '/home') }}" class="block py-2 pr-4 pl-3 text-base text-gray rounded md:bg-transparent md:p-0 " aria-current="page">Dashboard</a>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg> <svg class="ml-1 w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdownNavbar" class="hidden z-10 w-44 font-normal bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 545px, 0px);">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My Profile</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                        </li>
                        </ul>
                        <div class="py-1">
                        <a href="/logout" class="block py-2 px-4 text-sm text-red-600 hover:bg-gray-100 ">Sign out</a>
                        </div>
                    </div>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    </div>
    </br>
    <!-- <a href="{{ url( '/search') }}" class="ml-2 mt-2 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
        < Back
    </a> -->
    </body>


<?php
    use Elastic\Elasticsearch;
    use Elastic\Elasticsearch\ClientBuilder;

    require '/Users/divyasreeramagiri/webProject_001/vendor/autoload.php';
    $client = Elastic\Elasticsearch\ClientBuilder::create()->build();
    $params = [
        'index' => 'web518',
        'body'  => [
            'query' => [
                "multi_match" => [
                    "query" =>$id, 
                    "fields"=>[ "etd_file_id" ] 
                ],
                ],
            ]
        ];

    $response = $client->search($params);
    $searchHits = $response['hits']['total']['value'];
    $searchResult = $response['hits']['hits'];

    foreach( $searchResult as $source){
        $etd_file_id = (isset($source['_source']['etd_file_id'])? $source['_source']['etd_file_id'] : "");
        $year= (isset($source['_source']['year'])? $source['_source']['year'] : "");
        $author= (isset($source['_source']['author'])? $source['_source']['author'] : "");
        $university = (isset($source['_source']['university']) ? $source['_source']['university'] : "");
        $degree = (isset($source['_source']['degree']) ? $source['_source']['degree'] : "");
        $program = (isset($source['_source']['program']) ? $source['_source']['program'] : ""); 
        $abstract = (isset($source['_source']['abstract']) ? $source['_source']['abstract'] : ""); 
        $title = (isset($source['_source']['title']) ? $source['_source']['title'] : ""); 
        $advisor = (isset($source['_source']['advisor']) ? $source['_source']['advisor'] : ""); 
        $pdf = (isset($source['_source']['pdf']) ? $source['_source']['pdf'] : ""); 
        $wiki_terms = (isset($source['_source']['wiki_terms']) ? $source['_source']['wiki_terms'] : "");

        echo '
        <div class="mx-2 text-white">
            <div class="p-3 capitalize text-lg font-bold border-b-2 border-gray-900">'.$title.'</div>
            <div><span class="font-bold pr-3 capitalize">Author:</span>'.$author.'</div>
                <div class="capitalize"><span class="font-bold pr-3">University:</span>'.$university.'</div>
                <div class="capitalize"><span class="font-bold pr-3">Degree:</span>'.$degree.'</div>
                <div class="capitalize"><span class="font-bold pr-3">Program:</span>'.$program.'</div>
                <div class="capitalize"><span class="font-bold pr-3">Year:</span>'.$year.'</div>
                <div class="capitalize"><span class="font-bold pr-3">Advisor:</span> '.$advisor.'</div>
                <div ><span class="font-bold pr-3">Abstract:</span>'.$abstract.'</div>
                <a href="/viewPDF/'.$pdf.'" class="font-bold underline flex"> VIEW DOCUMENT <svg class="w-6 h-6 underline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </a>
        </div>
        ';

    }
?>

<footer>
    @include('footer')
</footer>
</html>
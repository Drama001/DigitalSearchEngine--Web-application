<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>
<body class="bg-green-200">
<div class="navBar">
        <nav class="px-2 bg-white border-gray-200">
        <div class="container flex flex-wrap justify-between items-center mx-auto ">
            <a href="{{url('/welcome')}}" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Digital Search Engine</span>
            </a>
            <button data-collapse-toggle="mobile-menu" type="button" class="inline-flex justify-center items-center ml-3 text-gray-400 rounded-lg md:hidden hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-500" aria-controls="mobile-menu-2" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
            <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                <a href="{{ url( '/login') }}" class="block py-2 pr-4 pl-3 text-base text-gray rounded md:bg-transparent md:p-0 " aria-current="page">Login</a>
                </li>
                <li>
                <a href="{{ url( '/register') }}" class="block py-2 pr-4 pl-3 text-base text-gray rounded md:bg-transparent md:p-0 " aria-current="page">Register</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    </div>
    <div class="searchBox container mx-auto mt-8">  
            <form class="flex items-center" action="{{ url('/search') }}" method="GET">   
                <label for="simple-search" class="sr-only"></label>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" id="simple-search" name="search" value=<?php echo $searchString ?> class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type Here.." required="">
                </div>
                <button type="submit" name="sh" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <p>Search</p>
                    
                </button>
            </form>
    </div>
</body>

<?php
    //PAGINATION
    $no_of_records_per_page = 10;

    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }

    echo
    '<div class="px-2">
    <p class="font-bold">Current Page: '.$pageno.'</p>
    </div>';

    $offset = ($pageno-1) * $no_of_records_per_page; 

    function highlightWords($searchText, $word){
        $highlighted_string = preg_replace('#'. preg_quote($word) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $searchText);
        return $highlighted_string;
    }

    require '/Users/divyasreeramagiri/webProject_001/vendor/autoload.php';
    $client = Elastic\Elasticsearch\ClientBuilder::create()->build();
    $searchWord = strip_tags(htmlspecialchars_decode($searchString)); 
  $params = [
    'index' => 'web518',
    'body' => [
        'query' => [
            'multi_match' => [
                'query' => $searchWord,
                'fields' => [
                    'abstract',
                    'wiki_terms',
                    'title',
                    'advisor',
                    '$year',
                    'degree',
                    'program',
                    'university',
                    'author'
                ],
            ],
        ],
        'size'=>500,
    ],
];

  $response = $client->search($params);
  $searchHits = $response['hits']['total']['value'];
  $searchResult = $response['hits']['hits'];
  
  if ($searchHits == 0){
    echo'<div style="text-align:center;" class="alert alert-danger success-block">';
     echo '<p class="head">No Results Found..!</p>';
    
  }
  else{
    //$score = $response['hits']['hits'][0]['_score'];
    //$pagenum = $_REQUEST['pageNo'];
    
    echo
    '<div class="px-2">
    <p class="font-bold"><i>'.$searchHits.'</i> results found for <i>'.$searchWord.'</i></p>
    </div>';
    
    
    for($i = $offset;$i < $pageno * $no_of_records_per_page && $i < $searchHits;$i++){        
        $source = $searchResult[$i];
        $title= (isset($source['_source']['title'])? highlightWords($source['_source']['title'], $searchWord) : "");
       $advisor= (isset($source['_source']['advisor'])? highlightWords($source['_source']['advisor'], $searchWord) : "");
       $author = (isset($source['_source']['author']) ? highlightWords($source['_source']['author'], $searchWord) : "");
       $year= (isset($source['_source']['year']) ? highlightWords($source['_source']['year'], $searchWord) : "");
       $degree = (isset($source['_source']['degree']) ? highlightWords($source['_source']['degree'], $searchWord) : ""); 
       $program = (isset($source['_source']['program']) ? highlightWords($source['_source']['program'], $searchWord) : ""); 
       $university = (isset($source['_source']['university']) ? highlightWords($source['_source']['university'], $searchWord) : ""); 
       $wiki_terms = (isset($source['_source']['wiki_terms']) ? highlightWords($source['_source']['wiki_terms'], $searchWord) : ""); 
       $abstract = (isset($source['_source']['abstract']) ? highlightWords($source['_source']['abstract'], $searchWord) : "");
       
       $trimmed_abstract =  mb_strimwidth($abstract, 0, 500, "...");
    
    echo'
    <div class=" py-2 px-5">
    <a href="#" class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
        <p class="mb-2 text-md tracking-tight text-gray-900"><span class="font-bold px-2">Title:</span>'.$title.'</p>
        <p class="mb-2 text-md tracking-tight text-gray-900"><span class="font-bold px-2">Author(s):</span>'.$author.'</p>
        <p class="mb-2 text-md tracking-tight text-gray-900"><span class="font-bold px-2">University:</span>'.$university.'</p>
        <p class="mb-2 text-md tracking-tight text-gray-900"><span class="font-bold px-2">Year:</span>'.$year.'</p>
        <p class="font-normal text-gray-700 px-2"><span class="font-bold ">Abstract:</span>'.$trimmed_abstract.'</p>
    </a> 
    </div>
    ';
    }

    /*
    foreach($searchResult as $source){
       //$id = (isset($source['_id'])? $source['_id'] : "");
       $title= (isset($source['_source']['title'])? highlightWords($source['_source']['title'], $searchWord) : "");
       $advisor= (isset($source['_source']['advisor'])? highlightWords($source['_source']['advisor'], $searchWord) : "");
       $author = (isset($source['_source']['author']) ? highlightWords($source['_source']['author'], $searchWord) : "");
       $year= (isset($source['_source']['year']) ? highlightWords($source['_source']['year'], $searchWord) : "");
       $degree = (isset($source['_source']['degree']) ? highlightWords($source['_source']['degree'], $searchWord) : ""); 
       $program = (isset($source['_source']['program']) ? highlightWords($source['_source']['program'], $searchWord) : ""); 
       $university = (isset($source['_source']['university']) ? highlightWords($source['_source']['university'], $searchWord) : ""); 
       $wiki_terms = (isset($source['_source']['wiki_terms']) ? highlightWords($source['_source']['wiki_terms'], $searchWord) : ""); 
       $abstract = (isset($source['_source']['abstract']) ? highlightWords($source['_source']['abstract'], $searchWord) : "");
       
       $trimmed_abstract =  mb_strimwidth($abstract, 0, 500, "...");
    
    echo'
    <div class=" py-2 px-5">
    <a href="#" class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100">
        <p class="mb-2 text-md tracking-tight text-gray-900"><span class="font-bold px-2">Title:</span>'.$title.'</p>
        <p class="mb-2 text-md tracking-tight text-gray-900"><span class="font-bold px-2">Author(s):</span>'.$author.'</p>
        <p class="mb-2 text-md tracking-tight text-gray-900"><span class="font-bold px-2">University:</span>'.$university.'</p>
        <p class="mb-2 text-md tracking-tight text-gray-900"><span class="font-bold px-2">Year:</span>'.$year.'</p>
        <p class="font-normal text-gray-700 px-2"><span class="font-bold ">Abstract:</span>'.$trimmed_abstract.'</p>
    </a> 
    </div>
    ';
      
  }*/
//   PAGINATION
//   $total_pages = ceil($searchHits / $no_of_records_per_page);
//     echo $total_pages;

  echo'
    <nav aria-label="Page navigation example flex justify-center">
    <ul class="inline-flex -space-x-px">
    <li>
        <a href="#" class="py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
    </li>
    <li>
        <a href="?search='.$searchWord.'&pageno=1" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
    </li>
    <li>
        <a href="?search='.$searchWord.'&pageno=2" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
    </li>
    <li>
        <a href="?search='.$searchWord.'&pageno=3" aria-current="page" class="py-2 px-3 text-blue-600 bg-blue-50 border border-gray-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
    </li>
    <li>
        <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
    </li>
    <li>
        <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
    </li>
    <li>
        <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
    </li>
    </ul>
    </nav>
  ';
    
}

?>




</html>



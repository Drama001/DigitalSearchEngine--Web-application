<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Elastic\Elasticsearch;
use Illuminate\Support\Str;

require '/Users/divyasreeramagiri/webProject_001/vendor/autoload.php';


class MainController extends Controller
{
    function login(){
        return view('/login');
    }

    function register(){
        return view('/register');
    }
 
    function searchEngine(Request $request){
        $searchWord = $request->input('search');
        $searchWord = strip_tags(htmlspecialchars_decode($searchWord));
        if($searchWord == '' || Str::length($searchWord) == 0) {
            return redirect()->route('home');
        }
        $params = [
            'index' => 'web518',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $searchWord,
                        'fields' => [
                            '$etd_file_id',
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
                'size'=>500
            ],
        ];
        return view('search',["searchString"=>$searchWord])->withquery($params);
    }

    function viewSearchEngine(Request $request){
        $searchWord = $request->input('search');
        $searchWord = strip_tags(htmlspecialchars_decode($searchWord));
        if($searchWord == '' || Str::length($searchWord) == 0) {
            return redirect()->route('welcome');
        }
        $params = [
            'index' => 'web518',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $searchWord,
                        'fields' => [
                            '$etd_file_id',
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
                'size'=>500
            ],
        ];

        return view('viewSearch',["searchString"=>$searchWord])->withquery($params);
    }

    function openDissertation($id){
        $params = [
            'index' => 'web518',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $id,
                        'fields' => [
                            '$etd_file_id',
                        ],
                    ],
                ],
            ],
        ];
        return view('summary', ["id"=>$id])->withquery($params);
    }

    function openPDF($pdf){
        $filename = "/Users/divyasreeramagiri/Downloads/PDF/$pdf";
  
        // Header content type
        header("Content-type: application/pdf");
        
        header("Content-Length: " . filesize($filename));
        
        // Send the file to the browser.
        readfile($filename);
    }
}

?>

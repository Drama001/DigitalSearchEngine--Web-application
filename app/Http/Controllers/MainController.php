<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;
use Auth;
use Mail;
use Elastic\Elasticsearch;
use Elastic\Elasticsearch\ClientBuilder;
use Psr\Http\Message\UploadedFileInterface;


use Illuminate\Support\Facades\Http;


require '/Users/divyasreeramagiri/webProject_001/vendor/autoload.php';


class MainController extends Controller
{
    function login(){
        return view('/login');
    }

    function logout(){
        $user = Auth::user();
        // $user->is_verified = 0;
        // $user->save();
        Auth::logout();
        return redirect('/');
    }

    function verification(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password'=> 'required|alphaNum|min:6',
            'g-recaptcha-response' => ['required', function ($attribute, $value) {
                $response = Http::get("https://www.google.com/recaptcha/api/siteverify",[
                    $secretKey = env('GOOGLE_RECAPTCHA_SECRET'),
                    $response = $value,
                    $userIP = $_SERVER['REMOTE_ADDR'],
                ]);
                return $response->json()["success"];
            } ]
           ]);
        //    $input = $request->all();
        //    dd($input);
           
           $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
           );
           
            if(Auth::attempt($user_data))
            {
            
            if (DB::table('users')->where('email', $request->email)->exists()) {
                $userdata = Auth::user();
                $userdata = DB::table('users')->where('email', $request->email)->first();
            }
            if($userdata != null) {
                $userdata = Auth::user();
                $result= MailController::VerificationEmail($userdata->name,$userdata->email,$userdata->verification_code);
                $userdata->verification_code = $result;
                $userdata->save();
                return view('verificationpage');
                // return redirect()->back()->with('message','Please Check your email for the verification code!');        
            }
        }
           else
           {
            return back()->with('error', 'Wrong Login Details');
           }
      
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
    
    function verificationpage()
    {
        return view('verificationpage');
    }

    function verifyuser(Request $request)
    {
        $token = $_GET['verification_code'];
        $user = Auth::user();
        if($token == $user->verification_code)
        {        
            $user->is_verified = 1;
            $user->save();
            return view('index');
        }
        else{
            return redirect()->back()->with('error','The two factor code you have entered does not match');
        }
    }

    //---Upload PDF ----//

      function indexdata(Request $request){
        $client = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
    //     $fileName = $request->input('file');

    //      //Retrieve pdf filename and upload file to folder PDF
    //     $userFolder = "/Users/divyasreeramagiri/Downloads/PDF";
    //     $userFolder = $userFolder . basename( $_FILES['file']['name']) ;
    //     if(move_uploaded_file($_FILES['file']['tmp_name'], $userFolder))
    //     {
    //     echo "The file ". basename( $_FILES['file']['name']). " is uploaded";
    //     }
    //     else {
    //     echo "Problem uploading file";
    //     }
    //    $fileName = $_FILES['.$file.']['name'];
        
            $title = $request->input("title");
            $author = $request->input('author');
            $university = $request->input('university');
            $program = $request->input('program');
            $degree = $request->input('degree');
            $year = $request->input('year');
            $abstract = $request->input('abstract');
    
            $searchParams = [
                'index' => 'web518',
                'type' => '_doc',
                'body'  => [
                    'etd_file_id' => rand(501,1000),
                    'title' => $title,
                    'author' => $author,
                    'university' => $university,
                    'program' => $program,
                    'degree' => $degree,
                    'year'=>$year,
                    'abstract'=>$abstract,
                    //'pdf'=>$fileName
                ]
            ];
            $response = $client->index($searchParams);
            echo '<p style="color:white; text-align:center; font-size: 20px; background-color:green; padding: 5px 0px 5px 0px">Indexing Successful!</p>';
            return view('index');
          }



    //----TO generate TOKEN ----//      
    public function getTokenapi()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            if ($user->getRememberToken() == null) {
                $token = Str::random(32);
                $user->setRememberToken($token);
            }
            return response()->json(['success' => $user->getRememberToken()], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    //----- API SEARCH -----//
    public function getApi()
    {
        $terms = request('query');
        $limit = request('n');
        $key = request('key');
        $client = ClientBuilder::create()->build();

        $resultids = (array)DB::select('select remember_token from users');
        $resultstr = json_encode($resultids);
        if (str_contains($resultstr, $key)) {

            $params = [
                'index' => 'web518',
                'body' => [
                    'query' => [
                        'multi_match' => [
                            'query' => $terms,
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
                    'size'=>$limit,
                ],
            ];

            $results = $client->search($params);
            $searchHits = $results['hits']['total']['value'];
            $searchResult = $results['hits']['hits'];
    
            $rank = 1;

                for($i=0; $i<=$rank; $i++)
                {       
                if($rank<=$limit)
                {
                    $title[$rank]['title'] = $results['hits']['hits'][$rank-1]['_source']['title'];
                    $author[$rank]['author'] = $results['hits']['hits'][$rank-1]['_source']['author'];
                    $etd[$rank]['etd_file_id'] = $results['hits']['hits'][$rank-1]['_source']['etd_file_id'];
                    $year[$rank]['year'] = $results['hits']['hits'][$rank-1]['_source']['year'];
                    $university[$rank]['university'] = $results['hits']['hits'][$rank-1]['_source']['university'];                        
                    $degree[$rank]['degree'] = $results['hits']['hits'][$rank-1]['_source']['degree'];
                    //$abstract[$rank]['abstract'] = $results['hits']['hits'][$rank-1]['_source']['abstract'];
                    //$adviso[$rank]['advisor'] = $results['hits']['hits'][$rank-1]['_source']['advisor'];
                    $program[$rank]['program'] = $results['hits']['hits'][$rank-1]['_source']['program'];
                    $rank+=1;
                }
                }
                return response()->json(['response'=>$title,$author,$university,$degree,$program], 200);
            }else {
                return response()->json(['error' => 'UnAuthorised Access'], 401);
            }
    }
        
}

?>

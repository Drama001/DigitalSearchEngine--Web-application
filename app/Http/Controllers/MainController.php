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
use Elastic\Elasticsearch\ClientBuilder;
use Psr\Http\Message\UploadedFileInterface;


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
        return redirect('welcome');
    }

    function verification(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password'=> 'required|alphaNum|min:6'
           ]);
      
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

      function indexData(Request $request){
        $client = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
        $fileName = $request->input('file');

         //Retrieve pdf filename and upload file to folder PDF
        $userFolder = "/Users/divyasreeramagiri/Downloads/PDF";
        $userFolder = $userFolder . basename( $_FILES['file']['name']) ;
        if(move_uploaded_file($_FILES['file']['tmp_name'], $userFolder))
        {
        echo "The file ". basename( $_FILES['file']['name']). " is uploaded";
        }
        else {
        echo "Problem uploading file";
        }
       $fileName = $_FILES['.$file.']['name'];
        
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
            echo "<h3>Indexing Successful</h3>";
            echo "<br>";
          
          }
    }

    

?>

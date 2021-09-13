<?php
   
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Entry;
use App\User;
use Auth;

  
class BasicInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        return view('admin.basicInformation');
    } 

    public function getInfo(){
        $reg_users = Auth::user()->count('id');
        $unique_domains_num = Entry::distinct()->count('url');
        $unique_provider_num = Entry::distinct()->count('provider');
        $get_method = Entry::where('request_method', 'GET')->count();
        $post_method = Entry::where('request_method', 'POST')->count();
        $options_method =  Entry::where('request_method', 'OPTIONS')->count();
        $head_method =  Entry::where('request_method', 'HEAD')->count();
        $put_method =  Entry::where('request_method', 'PUT')->count();
        $outputs['mydt'] = array(
            $reg_users,
            $unique_domains_num,
            $unique_provider_num,
            $get_method,
            $post_method,
            $options_method,
            $head_method,
            $put_method
        );
        echo json_encode($outputs);
        // get records from database
        //$userId = "1";//Auth::user()->id;
        
        //$query = \DB::table('entries');
        //$st = $query -> where('id', 1)->get();
        
    
       
        exit;
      }
}

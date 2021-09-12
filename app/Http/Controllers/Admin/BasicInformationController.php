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
        $unique_domains_num = Entry::where('url')->distinct()->count('url');
        $unique_provider_num = Entry::where('provider')->distinct()->count('provider');
        $outputs['mydt'] = array(
            $reg_users,
            $unique_domains_num,
            $unique_provider_num
        );
        echo json_encode($outputs);
        // get records from database
        //$userId = "1";//Auth::user()->id;
        
        //$query = \DB::table('entries');
        //$st = $query -> where('id', 1)->get();
        
    
       
        exit;
      }
}

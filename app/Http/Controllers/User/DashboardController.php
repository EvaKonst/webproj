<?php
namespace App\Http\Controllers\User;
//namespace App\Http\Json;

use Auth;
use App\Http\Controllers\Controller;
use App\Entry;
use Illuminate\Http\Request;

class DashboardController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }
  public function create() {
    return view('user.dashboard');
  }
  public function store(Request $request)
    {
    //    $request->validate([
    //    ]);
    //    Entry::index($request->all());
    //    return json_encode(array(
    //        "statusCode"=>200
    //    ));
    \DB::table('entries')->insert([

      'id' => Auth::user()->first()->entries() -> first() -> id,
      'user_id' => Auth::user()->first()->entries() ->first() -> user_id,
      'wait' => $request->wait, //This wait coming from ajax request
      'request_method' => $request->request_method,
      'url' => $request->url,
      'response_status' => $request->response_status,
      'response_status_Text' => $request->response_status_Text,
      'response_age' => $request->response_age,
      'request_age' => $request->request_age,
      'Request_content_type' => $request->Request_content_type,
      'Request_cache_control' => $request->Request_cache_control,
      'Request_pragma' => $request->Request_pragma,
      'Request_expires' => $request->Request_expires,
      'Request_last_modified' => $request->Request_last_modified,
      'Request_host' => $request->Request_host,
      'startedDateTime' => $request->startedDateTime,
      'Response_content_type' => $request->Response_content_type,
      'Response_cache_control' => $request->Response_cache_control,
      'Response_pragma' => $request->Response_pragma,
      'Response_expires' => $request->Response_expires,
      'Response_last_modified' => $request->Response_last_modified,
      'Response_host' => $request->Response_host,
  ]);

    }
}
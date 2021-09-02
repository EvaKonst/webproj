<?php
namespace App\Http\Controllers\User;
//namespace App\Http\Json;

use App\Http\Controllers\Controller;
use App\Json;
use Illuminate\Http\Request;

class DashboardController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }
  public function index() {
    return view('user.dashboard');
  }
  public function store(Request $request)
    {
        $request->validate([
        ]);
        Json::index($request->all());
        return json_encode(array(
            "statusCode"=>200
        ));
    }
}
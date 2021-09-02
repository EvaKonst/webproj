<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Json;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
public function index()
    {
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



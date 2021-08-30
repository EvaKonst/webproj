<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HarsController extends Controller
{
    public function create()
    {
        return view('hars.create');
    }

    public function store()
    {
        $data = request()-> validate([
            'har' => 'required',
        ]);

        auth()->user()->hars()->create($data);


        dd(request()->all());
    }
}

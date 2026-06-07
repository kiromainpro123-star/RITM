<?php

namespace App\Http\Controllers;
use App\Models\qwertmdl;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function func(){
        $app = qwertmdl::all();
        return view('index', compact('app'));
    }
    
}

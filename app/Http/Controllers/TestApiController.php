<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class TestApiController extends Controller
{
    //
    public function test(Request $request)
    {
    	$katakunci = $request->get('katakunci');
    	//eror
    	$data = Student::
    	where('nama', 'like', '%'. $katakunci. '%')
    	->paginate(5);

    	return $data;
    }
}

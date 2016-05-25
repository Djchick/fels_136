<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class UserController extends Controller
{
    public function index() {
        $this->viewData['user'] = Auth::user();
        return view('home', $this->viewData);
    }

    public function create() {
        
    }

    public function store() {

    }

    public function show($id) {
        //
    }

    public function edit($id) {
        
    }

    public function update($id) {
        //  
    }

    public function destroy($id) {
        //
    }
}
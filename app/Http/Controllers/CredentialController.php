<?php

namespace App\Http\Controllers;

use App\Models\Credentials;
use Illuminate\Http\Request;

class CredentialController extends Controller
{
    public function index() {
        return view('pages.credentials');
    }

    public function addCredentials(Request $request) {
        
        $credentials = new Credentials;
        $credentials->title = $request->title;
        $credentials->content = $request->content;
        $credentials->save();
        return redirect("/");
        
    }
}

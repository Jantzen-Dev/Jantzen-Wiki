<?php

namespace App\Http\Controllers;

use App\Models\Credentials;
use Illuminate\Http\Request;

class CredentialController extends Controller
{
    public function index() {
        $credentials = Credentials::orderBy('created_at', 'desc')->get();
        return view('pages.credentials', ['credentials' => $credentials]);
    }

    public function storeCredential(Request $request) {

        $credentials = new Credentials();
        $credentials->title = $request->title;
        $credentials->content = $request->contents;
        $credentials->save();

        return response()->json(['success' => true, 'redirect_url' => route('cred')]);
    }
}

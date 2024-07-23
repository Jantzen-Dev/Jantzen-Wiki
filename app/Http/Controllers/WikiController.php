<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wiki;
use App\Models\Category;
use App\Models\Credentials;
use Illuminate\Http\Request;

class WikiController extends Controller
{
    public function index() {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $totCategories = Category::all()->count();
        $totWiki = Wiki::all()->count();
        $totCred = Credentials::all()->count();
        $totUser = User::all()->count();
        return view('pages.index', ['categories' => $categories,
                                    'totCategories' => $totCategories,
                                    'totWiki' => $totWiki,
                                    'totCred' => $totCred,
                                    'totUser' => $totUser
                                    ]);
    }

    public function addCategory(Request $request) {
        
        $category = new Category;
        $category->name = $request->category_name;
        $category->save();
        return redirect("/");
        
    }

    public function wiki($id) {
        $wikis = Wiki::with('category')->where('category_id', $id)->orderBy('created_at', 'desc')->get();
        $wikiId = $id;
        return view('pages.category', ['wikis' => $wikis, 'wikiId' => $wikiId]);
    }

    public function addWiki($id) {
        $wikiId = $id;
        return view('pages.wiki-add', ['wikiId' => $wikiId]);
    }

    public function storeWiki(Request $request) {

        $wiki = new Wiki();
        $wiki->title = $request->title;
        $wiki->category_id = $request->category_id;
        $wiki->contents = $request->contents;
        $wiki->save();

        return response()->json(['success' => true, 'redirect_url' => route('wiki', $wiki->category_id)]);
    }

    public function wikiPage($id) {
        $wiki = Wiki::findOrFail($id);
        return view('pages.wiki-single', ['wiki' => $wiki]);
    }
}

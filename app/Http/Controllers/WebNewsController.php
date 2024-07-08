<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class WebNewsController extends Controller
{
    public function index()
    {
        $Vnews = News::all();
        return view('news')->with('Vnews', $Vnews);
    }
   

    public function create() 
    {
       return view('news.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'judul_news' => 'required|string|max:255',
            'image_news' => 'required|string|max:255',
            'link_news' => 'required|string|max:255',
        ]);

        News::create($request->all());

        return redirect()->route('news.index')->with('success', 'Video added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_news' => 'required|string|max:255',
            'image_news' => 'required|string|max:255',
            'link_news' => 'required|string|max:255',
        ]);

        $new = News::findOrFail($id);
        $new->update($request->all());

        return redirect()->route('news.index')->with('success', 'News updated successfully.');
      
        
    
    }
   
   
        public function destroy($id)
        {
            $new = News::where('kd_news', $id)->first();
    
            if (!$new) {
                return redirect()->route('news.index')->with('error', 'News not found.');
            }
    
            $new->delete();
    
            return redirect()->route('news.index')->with('success', 'News deleted successfully.');
        }
}

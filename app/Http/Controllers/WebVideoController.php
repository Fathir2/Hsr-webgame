<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videos;

class WebVideoController extends Controller
{
    public function index()
    {
        $Vvideos = Videos::all();
        return view('videos')->with('Vvideos', $Vvideos);
    }
   

    public function create() 
    {
       return view('videos.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'judul_videos' => 'required|string|max:255',
            'image_videos' => 'required|string|max:255',
            'link_videos' => 'required|string|max:255',
        ]);

        Videos::create($request->all());

        return redirect()->route('videos.index')->with('success', 'Video added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_videos' => 'required|string|max:255',
            'image_videos' => 'required|string|max:255',
            'link_videos' => 'required|string|max:255',
        ]);

        $video = Videos::findOrFail($id);
        $video->update($request->all());

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
      
        
    
    }
   
   
        public function destroy($id)
        {
            $video = Videos::where('kd_videos', $id)->first();
    
            if (!$video) {
                return redirect()->route('videos.index')->with('error', 'Videos not found.');
            }
    
            $video->delete();
    
            return redirect()->route('videos.index')->with('success', 'Videos deleted successfully.');
        }
    
    }



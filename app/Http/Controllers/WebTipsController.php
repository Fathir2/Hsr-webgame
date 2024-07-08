<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\Request;

class WebTipsController extends Controller
{
    public function index()
    {
        $Vtips = Tips::all();
        return view('tips')->with('Vtips', $Vtips);
    }
   

    public function create() 
    {
       return view('tips.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'judul_tips' => 'required|string|max:255',
            'image_tips' => 'required|string|max:255',
            'link_tips' => 'required|string|max:255',
        ]);

        Tips::create($request->all());

        return redirect()->route('tips.index')->with('success', 'Video added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_tips' => 'required|string|max:255',
            'image_tips' => 'required|string|max:255',
            'link_tips' => 'required|string|max:255',
        ]);

        $tip = Tips::findOrFail($id);
        $tip->update($request->all());

        return redirect()->route('tips.index')->with('success', 'Tips updated successfully.');
      
        
    
    }
   
   
        public function destroy($id)
        {
            $tip = Tips::where('kd_tips', $id)->first();
    
            if (!$tip) {
                return redirect()->route('tips.index')->with('error', 'Tips not found.');
            }
    
            $tip->delete();
    
            return redirect()->route('tips.index')->with('success', 's deleted successfully.');
        }
    
    }




<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stopword;

class StopWordController extends Controller
{    
    public function index()
    {
        $stop = Stopword::all();
        return view('stopword')->with('stop', $stop);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'stop' => ['required', 'filled', 'alpha', 'unique:slangword,mean'],
        ]);

        $stop = new Stopword;

        $stop->word = $request->input('stop');

        $stop->save();

        return redirect('stopword')->with('success', 'Data Saved');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'stop' => ['required', 'filled', 'alpha'],
        ]);

        $stop = Stopword::where('word',$id)->first();

        $stop->word = $request->input('stop');

        $stop->save();

        return redirect('stopword')->with('success', 'Data Update');
    }

    public function destroy($id)
    {
        $stop = Stopword::where('word',$id)->first();
        $stop->delete();

        return redirect('stopword')->with('success', 'Data Deleted');
    }
}

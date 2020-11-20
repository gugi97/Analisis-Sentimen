<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slangword;

class SlangWordController extends Controller
{
    public function index()
    {
        $slang = Slangword::all();
        return view('slangword')->with('slang', $slang);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'slang' => ['required', 'filled','unique:slangword,slang'],
            'mean' => ['required', 'filled', 'alpha', 'unique:slangword,mean'],
        ]);

        $slang = new Slangword;

        $slang->slang = $request->input('slang');
        $slang->mean = $request->input('mean');

        $slang->save();

        return redirect('slangword')->with('success', 'Data Saved');
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
            'slang' => ['required', 'filled'],
            'mean' => ['required', 'filled', 'alpha'],
        ]);

        $slang = Slangword::where('slang',$id)->first();

        $slang->slang = $request->input('slang');
        $slang->mean = $request->input('mean');

        $slang->save();

        return redirect('slangword')->with('success', 'Data Update');
    }

    public function destroy($id)
    {
        $slang = Slangword::where('slang',$id)->first();
        $slang->delete();

        return redirect('slangword')->with('success', 'Data Deleted');
    }
}

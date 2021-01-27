<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NegatifWord;
use App\Models\PositifWord;

class KamusController extends Controller
{
    public function index()
    {
        $negatif = NegatifWord::all();
        $positif = PositifWord::all();
        return view('kamus', [
            'negatif' => $negatif,
            'positif' => $positif,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'positif' => ['filled', 'unique:positif_word,word'],
            'negatif' => ['filled', 'unique:negatif_word,word'],
        ]);

        $positif = new PositifWord;
        $negatif = new NegatifWord;

        $positif->word = $request->input('positif');
        $negatif->word = $request->input('negatif');

        if($positif->word != NULL){
            $positif->save();
        }
        if($negatif->word != NULL){
            $negatif->save();
        }

        return redirect('kamus')->with('success', 'Data Saved');
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
            'positif' => ['filled'],
            'negatif' => ['filled'],
        ]);

        $positif = PositifWord::where('word',$id)->first();
        $negatif = NegatifWord::where('word',$id)->first();

        $i = 0;
        if($positif != NULL)
        {
            $positif->word = $request->input('positif');
            if($positif->word != NULL){
                $positif->save();
                $i = 1;
            }
        }
        if($negatif != NULL)
        {
            $negatif->word = $request->input('negatif');
            if($negatif->word != NULL){
                $negatif->save();
                $i = 1;
            }
        }

        if($i > 0){
            return redirect('kamus')->with('success', 'Data Update');
        }
        return redirect('kamus')->with('warning', 'Update Failed');
    }

    public function delete($id){
        $negatif = NegatifWord::where('word',$id)->first();
        $negatif->delete();
        return redirect('kamus')->with('success', 'Data Deleted');
    }

    public function destroy($id)
    {
        $positif = PositifWord::where('word',$id)->first();
        $positif->delete();
        
        return redirect('kamus')->with('success', 'Data Deleted');
    }
}

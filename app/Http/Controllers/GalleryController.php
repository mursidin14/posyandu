<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function index(){
        $gallery = Gallery::all();
        return view('galeri.index',compact('gallery'));
    }

    public function edit($id){
        $gallery = Gallery::find($id);
        return view('galeri.edit',compact('gallery'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'name'=>'required|string',
            'image_broadcast'=>'required',
        ]);
        $galery = Gallery::where('id',$id)->first();
        Storage::disk('public')->delete($galery->image);
        $name = $request->name;
        $image = $request->image_broadcast;

        $imageExtension = $request->image_broadcast->getClientOriginalExtension();
        $imageName = 'img_'.time().'.'.$imageExtension;
        $path = $request->image_broadcast->storeAs('images',$imageName,'public');

        Gallery::where('id',$id)
        ->update([
            'name'=>$request->name,
            'user_id'=>$request->user_id,
            'image'=>$path, 
        ]);
        return redirect('/gallery')->with('status','Data Galeri berhasil diupdate!');
    }

    public function store(Request $request){
    
        $request->validate([
            'name'=>'required|string',
            'image_broadcast'=>'required',
        ]);
        $name = $request->name;
        $image = $request->image_broadcast;
        
        $imageExtension = $request->image_broadcast->getClientOriginalExtension();
        $imageName = 'img_'.time().'.'.$imageExtension;
        $path = $request->image_broadcast->storeAs('images',$imageName,'public');

        $data = new Gallery();
        $data->name = $name;
        $data->image = $path;
        $data->user_id = $request->user_id;
        $data->save();
        return redirect('/gallery')->with('status','Data Galeri berhasil ditambahkan!');
    }
    
    public function destroy($id){
        $galery = Gallery::where('id',$id)->first();
        Storage::disk('public')->delete($galery->image);

        Gallery::where('id',$id)->delete();

        return redirect('/gallery')->with('status','Data Galeri berhasil dihapus! ');
    }
}

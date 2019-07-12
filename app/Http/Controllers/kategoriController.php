<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategori;

class kategoriController extends Controller
{
    public function daftar(Request $req)
    {
    	$data = kategori::where('nama_kategori','like',"%{$req->keyword}%")
    		->paginate(10);
    	return view('admin.pages.kategori.daftar',['data'=>$data]);
    }

    public function add()
    {
    	return view('admin.pages.kategori.add');

    }

    public function save(Request $req)
    {

    	\Validator::make($req->all(),[
    		'kategori'=>'required|between:3,100|unique:kategori,nama_kategori',
			])->validate();
    	

    	$result = new kategori;
    	$result->nama_kategori = $req->kategori;

    	if( $result->save() ){
    		return redirect()->route('admin.kategori')
    			->with('result','success');

    	} else {
    		return back()->with('result','fail')->withInput();
    	}
    }
public function edit($id)
{
	$data = kategori::where('id',$id)->first();
	return view('admin.pages.kategori.edit',['rc'=>$data]);
}
public function update(Request $req)
{

	\Validator::make($req->all(),[
    		'kategori'=>'required|between:3,100|unique:kategori,nama_kategori,'.$req->id,
			])->validate();

	$result = kategori::where('id',$req->id)
		->update([
			'nama_kategori'=>$req->kategori,
			]);
		if( $result ){
			return redirect()->route('admin.kategori')->with('result','update');
		} else {

			return back()->with('result','fail');
		}
    }

    public function delete(Request $req)
    {
        $result = kategori::find($req->id);

        if ( $result->delete() ){
            return back()->with('result','delete');
        } else {
            return back()->with('result','fail-delete');
        }
    }
}

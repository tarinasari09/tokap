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
}

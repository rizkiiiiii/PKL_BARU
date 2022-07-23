<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //memanggil data wali bersama dengan data siswa
        //yang dibuat dari method 'siswa' di model 'WALI'
        $wali = Wali::with('siswa')->get();
        return view ('wali.index',['wali'=>$wali]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('wali.index',compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'id_siswa' => 'required|unique:walis',
            'foto'=> 'required|image|max:2048',
        ]);
        $wali = new Wali();
        $wali->nama = $request -> nama;
        if($request->hasFile('foto')){
            $image = $request -> file('foto');
            $name= rand(1000,9999).$image->getClienOriginalName();
            $image->move('images/wali/',$name);
            $wali->foto = $name;

        }
        $wali->id_siswa = $request->id_siswa;
        $wali ->save();
        return redirect()->route('wali.index')
        ->with ('succes','Data Berhasi Di Buat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wali = Wali::findOrFail($id);
        return view('wali.show',compact('wali'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wali=Wali::findOrFail($id);
        $siswa = Siswa::all();
        return view ('wali.edit',compact('wali','siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'=>'required',
            'id_siswa'=>'required',
            'foto'=>'required|image|max:2048',
        ]);

        $wali = Wali::findOrFail($id);
        $wali -> nama = $request->nama;
        if($request->hasFile('foto')){
            $wali->deleteImage();
            $image=$request-file('foto');
            $name = rand(1000,9999) . $image->getClientOriginalName();
            $image->foto = $name;
        }
        $wali->id_siswa = $request->id_siswa;
        $wali->save();
        return redirect()->route('wali.index')
        ->with ('success','Data Berhasi Dibuat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wali = Wali::findOrFail($id);
        $wali->deleteImage();
        $article->delete();
        return redirect()->route('wali.index')
        ->with ('success','Data Berhasil Dibuat');
    }
}

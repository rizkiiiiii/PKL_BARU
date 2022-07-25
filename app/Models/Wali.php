<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;
    public $fillable = ['nama','foto','id_siswa'];
    public $timestamps = true;

    //Membuay Relasi one to one di model
    public function siswa()
    {
        // Data dari model 'Wali' bisa dimiliki
        // Oleh model 'Siswa' melalui 'id_siswa'
        return $this->belongsTo(Siswa::class,'id_siswa');

    }

    // method menampilkan image(foto)
    public function image()
    {
        if($this->foto && file_exists(public_path('images/wali/'.$this->foto))){
            return asset('images/wali/'.$this->foto);
        }else{
            return asset('images/no_image.jpg');
        }

    }
    public function deleteImage()
    {
        if($this->foto && file_exists(public_path('image/wali/'.$this->foto))){
            return unlink(public_path('images/wali/'.$this->foto));
        }

    }
}

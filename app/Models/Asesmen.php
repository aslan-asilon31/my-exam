<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesmen extends Model
{
    use HasFactory;

    protected $table = 'asesmens';

    protected $fillable = [
        'id',
        'judul',
        'deskripsi',
        'durasi',
        'tgl_mulai',
        'tgl_selesai',
        'dibuat_oleh',
        'diupdate_oleh',
        'tgl_dibuat',
    ];

    public $timestamps = false;
    public $incrementing = false; 
    protected $keyType = 'string'; 

    // Relasi dengan tabel pertanyaans
    public function pertanyaans()
    {
        return $this->hasMany(Pertanyaan::class, 'asesmen_id', 'id');
    }
}

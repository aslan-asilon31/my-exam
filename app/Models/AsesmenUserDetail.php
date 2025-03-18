<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmenUserDetail extends Model
{
    use HasFactory;

    protected $table = 'asesmen_user_detail';
    public $timestamps = false;
    protected $fillable = [
        'asesmen_user_id',
        'pertanyaan_id',
    ];

    public function asesmenUser()
    {
        return $this->belongsTo(AsesmenUser::class, 'asesmen_user_id');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }
}

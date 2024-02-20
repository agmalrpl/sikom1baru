<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    // protected $table = "users";
    public $table = "peminjaman";
    protected $guarded = ['id'];
    protected $fillable = [
        'id','user_id','buku_id','TaggalPeminjaman','TaggalPengembalian', 'StatusPeminjaman'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function buku(){
        return $this->belongsTo(Buku::class);
    }
}
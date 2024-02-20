<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriBuku_Relasi extends Model
{
    use HasFactory;
    protected $table = "kategoriBuku_Relasi";
    protected $guarded = ['id'];

    public function buku()
    {
      return $this->belongsTo(Buku::class);
    }
    public function kategori()
    {
      return $this->belongsTo(kategoriBuku::class);
    }
} 

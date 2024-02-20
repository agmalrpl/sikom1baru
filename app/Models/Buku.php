<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{  use HasFactory;
    protected $table = "bukus";
    protected $guarded = ['id']; //MENGATUR HANYA COLUMN ID YANG TIDAK ADA DI ISI
    
    public function ulasanbuku()
    {
        return $this->thisMany(UlasanBuku::class);
    }
    public function koleksipribadi()
    {
        return $this->thisMany(KoleksiPribadi::class);
    }
    public function kategoriBuku_Relasi()
    {
        return $this->thisMany(KategoriBuku_Relasi::class);
    }
    public function peminjaman()
    {
        return $this->thisMany(Peminjaman::class);
    }
}



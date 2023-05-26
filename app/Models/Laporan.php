<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = "laporan";

    protected $guarded = [];

    public function pemasukan(){
        return $this->belongsTo(Pemasukan::class);
    }

    public function pengeluaran(){
        return $this->belongsTo(Pengeluaran::class);
    }
}

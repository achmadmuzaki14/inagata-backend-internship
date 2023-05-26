<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function laporan(){
        return $this->hasMany(Laporan::class, 'pengeluaran_id');
    }
}

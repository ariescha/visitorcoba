<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nda extends Model
{
    protected $table = 'nda';
    protected $primaryKey = 'id_nda';
    protected $fillable = ['nik_visitor', 'id_petugas','file_nda','tanggal_mulai_nda','tanggal_akhir_nda','status_nda'];
}
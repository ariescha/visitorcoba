<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas_DC extends Model
{
    protected $table = 'petugas_dc';
    protected $primaryKey = 'id_petugas';
    protected $fillable = ['nama_lengkap_petugas', 'npp_petugas','email_petugas','password_petugas','nomor_hp_petugas','status_petugas','is_superadmin'];
}
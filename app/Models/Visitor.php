<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitor';
    protected $primaryKey = 'id_visitor';
    //public $timestamps = false;
    protected $fillable = ['nama_lengkap_visitor', 'nik_visitor','nomor_hp_visitor','asal_instansi_visitor','email_visitor','password_visitor','foto_ktp_visitor','approval_by','rejected_by','status_visitor'];
}

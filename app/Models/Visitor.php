<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitor';
    protected $primaryKey = 'nik_visitor';
    //public $timestamps = false;
    protected $fillable = ['nik_visitor','nama_lengkap_visitor','nomor_hp_visitor','asal_instansi_visitor','email_visitor','password_visitor','foto_ktp_visitor','approval_timestamp','approval_by','rejected_by','rejected_alasan','status_visitor','status_nda_visitor'];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_checkin extends Model
{
    protected $table = 'list_checkin';
    protected $primaryKey = 'id_checkin';
    protected $fillable = ['nik_visitor', 'id_petugas','tanggal_checkin','checkin_time','checkout_time','foto_visitor', 'nomor_tag_visitor', 'keperluan_visit', 'barang_bawaan', 'approval_timestamp', 'rejected_timestamp', 'rejected_alasan', 'status_checkin'];
}
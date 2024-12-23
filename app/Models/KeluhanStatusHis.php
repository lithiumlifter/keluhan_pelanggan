<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluhanStatusHis extends Model
{
    use HasFactory;

    protected $table = 'keluhan_status_his';
    protected $fillable = [
        'keluhan_id', 'status_keluhan', 'updated_at'
    ];

    public function keluhan()
    {
        return $this->belongsTo(KeluhanPelanggan::class, 'keluhan_id');
    }
}

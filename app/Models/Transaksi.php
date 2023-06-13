<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $guarded = ['id_transaksi'];

    public function print()
    {
        return $this->belongsTo(PrintList::class, 'id_print_list', 'id_print_list');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id');
    }
}

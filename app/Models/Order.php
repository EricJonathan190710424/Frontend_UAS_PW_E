<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice',
        'date',
        'payment',
        'change',
    ];

    public function getIncrement()
    {
        return DB::table('orders')->select(DB::raw('COUNT(*) as counter'))
            ->where('date', date('Y-m-d'))->first()->counter + 1;
    }

    public function getByID($id)
    {
        return DB::table('orders')
            ->select('*', DB::raw('IF(payment = 0, "Belum Lunas", "Lunas") as status_pembayaran'))
            ->where('id', $id)
            ->first();
    }
}

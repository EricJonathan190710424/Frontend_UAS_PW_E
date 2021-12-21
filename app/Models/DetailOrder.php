<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id',
        'order_id',
        'qty',
    ];

    public function getIndex()
    {
        return DB::table('detail_orders as do')
            ->join('menus as m', 'm.id', '=', 'do.menu_id')
            ->select('do.*', 'm.*', DB::raw("m.harga * do.qty as subtotal"))
            ->where('order_id', request()->query('order_id'))
            ->get();
    }

    public function create($data)
    {
        DB::table('detail_orders')->updateOrInsert(
            ['menu_id' => $data['menu_id'], 'order_id' => $data['order_id']],
            ['qty' => $data['qty']]
        );
    }
}

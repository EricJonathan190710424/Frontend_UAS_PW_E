<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Helper\Apibuilder as Api;

class OrderController extends Controller
{
    protected $data, $code, $order;

    public function __construct(Order $order)
    {
        $this->code = 200;
        $this->data = [];
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->data = Order::query()->get();
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $storedData = $request->all();
            $storedData['date'] = date('Y-m-d');
            $storedData['invoice'] = 'INV-' . date('Ymd') . '-' . str_pad($this->order->getIncrement(), 4, '0', STR_PAD_LEFT);
            $this->data = Order::create($storedData);
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        try {
            $this->data = $order->getByID($order->id);
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        try {
            $this->data = $order->update($request->all());
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        try {
            $this->data = $order->delete();
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }
}

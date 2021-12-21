<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Apibuilder as Api;
use App\Models\DetailOrder;

class DetailOrderController extends Controller
{
    protected $data, $code, $order_detail;

    public function __construct(DetailOrder $order_detail)
    {
        $this->code = 200;
        $this->data = [];
        $this->order_detail = $order_detail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->data = $this->order_detail->getIndex();
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
            $this->data = $this->order_detail->create($storedData);
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
    public function show(DetailOrder $order_detail)
    {
        try {
            $this->data = $order_detail;
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
    public function update(Request $request, DetailOrder $order_detail)
    {
        try {
            $this->data = $order_detail->update($request->all());
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
    public function destroy(DetailOrder $order_detail)
    {
        try {
            $this->data = $order_detail->delete();
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }
}

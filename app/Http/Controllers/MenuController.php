<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Helper\Apibuilder as Api;

class MenuController extends Controller
{
    protected $data, $code;

    public function __construct()
    {
        $this->code = 200;
        $this->data = [];
    }

    public function index()
    {
        try {
            $this->data = Menu::query()->get();
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }

    public function show(Menu $menu)
    {
        try {
            $this->data = $menu;
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }

    public function store(Request $request)
    {
        try {
            $this->data = Menu::create($request->all());
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }

    public function update(Request $request, Menu $menu)
    {
        try {
            $this->data = $menu->update($request->all());
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }

    public function destroy(Menu $menu)
    {
        try {
            $this->data = $menu->delete();
        } catch (Exception $e) {
            $this->code = 500;
            $this->data = $e->getMessage();
        }
        return Api::apiRespond($this->code, $this->data);
    }
}
<?php

namespace App\Http\Controllers\Bills;

use App\RingoProduct;
use App\RingoSubProductList;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;


class RouteController extends HomeController
{

    public function index()
    {
        $products = RingoProduct::whereStatus(true)->get();
        return view('dashboard.bills.index ', compact('products'));
    }

    public function electricity(RingoProduct $product)
    {
        return view('dashboard.bills.electricity.index', compact('product'));
    }

    public function tv(RingoProduct $product)
    {
        $view = $product->name == 'STARTIMES' ? 'startime' : 'index';
        $groups = $product->name == 'STARTIMES' ? $product->productList->groupBy('group') : false;
        $prices = $product->name == 'STARTIMES' ? $product->productList->pluck('selling_price', 'id') : false;

        return view('dashboard.bills.tv.' . $view, compact('product', 'groups', 'prices'));
    }

    public function internet(RingoProduct $product)
    {
        return view('dashboard.bills.internet.index', compact('product'));
    }

    public function misc(RingoProduct $product)
    {
        return view('dashboard.bills.misc.index', compact('product'));
    }
}

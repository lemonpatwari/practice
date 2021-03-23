<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        Cart::add([
            ['id' => '293ad', 'name' => 'Product 1', 'qty' => 10, 'price' => 10.00, 'weight' => 0],
            ['id' => '4832k', 'name' => 'Product 2', 'qty' => 1, 'price' => 10.00, 'weight' => 0, 'options' => ['size' => 'large']],
            ['id' => '4835k', 'name' => 'Product 3', 'qty' => 1, 'price' => 10.00, 'weight' => 0, 'options' => ['size' => 'large']],
            ['id' => '4815k', 'name' => 'Product 3', 'qty' => 1, 'price' => 10.00, 'weight' => 0, 'options' => ['size' => 'large']],
        ]);

//        Cart::destroy();
        $carts = Cart::content();
        $cartContents = Cart::count();


        return [$carts,$cartContents];

    }

    public function cartDetails()
    {
        $cartContents = Cart::count();
        /*if (sizeof($cartContents) >= 1) {
            return $cartContents;
        }*/

        dd($cartContents);
    }
}

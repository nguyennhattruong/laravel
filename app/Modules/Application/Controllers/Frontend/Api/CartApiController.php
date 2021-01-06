<?php

namespace App\Modules\Application\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartApiController extends Controller
{
    public function addCart(Request $request) {
        $id = $request->id;
        $quantity = $request->quantity;
        $cart = [];

        if ($request->session()->has('cart')) {
            $cart = session('cart');
        }

        if (!isset($cart[$id])) {
            $cart[$id] = ['quantity' => $quantity];
        } else {
            $cart[$id] = ['quantity' => $cart[$id]['quantity'] + $quantity];
        }

        $request->session()->put('cart', $cart);

        return response()->json(count($cart));
    }

    public function deleteCart(Request $request) {
        $ids = $request->id;
        $cart = [];

        if ($request->session()->has('cart')) {
            $cart = session('cart');
            foreach ($ids as $id) {
                unset($cart[$id]);
            }
        }

        $request->session()->put('cart', $cart);
        return response()->json(count($cart));
    }

    public function deleteCartById(Request $request, $id) {
        $cart = [];

        if ($request->session()->has('cart')) {
            $cart = session('cart');
            unset($cart[$id]);
        }

        $request->session()->put('cart', $cart);
        return response()->json('1');
    }

    public function addCookies(Request $request) {
        /*$id = $request->id;
        $quantity = $request->quantity;
        $cart = json_decode('{}');

        if (Cookie::has('cart')) {
            $cart = json_decode(Cookie::get('cart'));
        }

        if (!isset($cart->$id)) {
            $cart->$id = [
                'quantity' => $quantity
            ];
        }

        setcookie('cart', json_encode($cart));

        return response()->json(Cookie::get('cart'));*/
    }
}

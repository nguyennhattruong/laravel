<?php

namespace App\Modules\Application\Controllers\Frontend;

use App\Modules\Domain\Services\Queries\ProductsCategoriesServiceQuery;
use App\Modules\Domain\Services\Queries\ProductsServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends IController
{
    function __construct() {
        parent::__construct();
        $this->_serviceQuery = new ProductsServiceQuery();
    }

    public function show($alias) {
        $service = new ProductsServiceQuery();
        $product = $service->getByAlias($alias);
        $product->images = explode(',', $product->images);

        // Get category's info
        $serviceCate = new ProductsCategoriesServiceQuery();
        $cate = $serviceCate->getAncestorsAndSelf($product->category_id);

        // Get related products
        $relatedProducts = $service->getListByCategoryId($product->category_id);

        return iView('product.detail', [
            'data' => $product,
            'cate' => $cate,
            'relatedProducts' => $relatedProducts
        ]);
    }

    public function category($alias) {
        $service = new ProductsCategoriesServiceQuery();
        $serviceProducts = new ProductsServiceQuery();
        $category = $service->getByAlias($alias);

        if (empty($category)) {
            return view('errors.404');
        }

        $products = $serviceProducts->getListForFrontend($category->id);
        $siblings = $service->getAncestors($category->id);
        $categories = $service->getAll()->toHierarchy();
        $menu = '';

        foreach ($categories as $node) {
            $menu .= $service->buildMenu($node);
        }


        return iView('product.category', [
            'data' => $products,
            'category' => $category,
            'categories' => $categories,
            'siblings' => $siblings,
            'menu' => $menu
        ]);
    }

    public function checkout() {
        $data = [];
        $service = new ProductsServiceQuery();
        $priceTotal = 0;

        if ($cart = session('cart')) {
            $ids = array_keys($cart);
            $list = $service->getListByIn($ids);

            foreach ($list as $product) {
                $product->quantity_cart = $cart[$product->id]['quantity'];
                $data[] = $product;

                if ($product->price_contact != 1) {
                    $priceTotal += $product->quantity_cart * $product->price;
                }
            }
        }

        return iView('product.checkout', [
            'data' => $data,
            'priceTotal' => $priceTotal
        ]);
    }

/*
 * ly bi
 */
    public function finish_checkout() {
        $data = [];
        $service = new ProductsServiceQuery();
        $priceTotal = 0;
//
        if ($cart = session('cart')) {
            $ids = array_keys($cart);
            $list = $service->getListByIn($ids);

            foreach ($list as $product) {
                $product->quantity_cart = $cart[$product->id]['quantity'];
                $data[] = $product;

                if ($product->price_contact != 1) {
                    $priceTotal += $product->quantity_cart * $product->price;
                }
            }
        }

        return iView('product.finish_checkout', [
            'data' => $data,
            'priceTotal' => $priceTotal
        ]);
    }

    public function updateCart(Request $request) {
        $input = $request['product_id'];
        $cart = [];

        if ($request->session()->has('cart')) {
            $cart = session('cart');
        }

        foreach ($input as $id => $quantity) {
            if (isset($cart[$id])) {
                $cart[$id] = [
                    'quantity' => $quantity
                ];
            }
        }

        $request->session()->put('cart', $cart);
        return redirect()->route('FrontendProductCheckout');
    }
}

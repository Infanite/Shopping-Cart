<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Session;
use App\Product;
use App\Order;
use Auth;
use App\User;
use Stripe\Stripe;
use Stripe\Charge;

class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::all();
        return view('user.shop.index', ['products' => $products]);
    }

    public function getAddToCart(Request $request, $id)
    {

      $product = Product::find($id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->add($product, $product->id);

      $request->session()->put('cart', $cart);
      // dd($request->session()->get('cart'));
      return redirect()->route('product.index');
    }


    public function getReducedByOne($id){

      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->reducedByOne($id);

      if(count($cart->items) > 0){
          Session::put('cart', $cart);
      }else{
        Session::forget('cart');
      }
      return redirect()->route('product.shoppingCart');

    }

    public function getRemoveItem($id){

      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->removeItem($id);

      if(count($cart->items) > 0){
          Session::put('cart', $cart);
      }else{
        Session::forget('cart');
      }
      return redirect()->route('product.shoppingCart');
    }

    public function getCart()
    {

      if (!Session::has('cart')){
        return view('user.shop.shopping-cart');
      }
      else{
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('user.shop.shopping-cart',['products' => $cart->items, 'totalPrice'=>$cart->totalPrice]);
      }

    }

    public function getCheckout()
    {

      if(!Session::has('cart')){
        return view('user.shop.shopping-cart');
      }
      else{
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('user.shop.checkout', ['total' => $total]);
      }

    }

    public function postCheckout(Request $request)
    {
      if(!Session::has('cart')){
        return redirect()->route('shop.shoppingCart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);

      Stripe::setApiKey('sk_test_xy4F0snc8jBrMFCl2oRtLV1a');
      try{
          $charge = Charge::create(array(
          "amount" => $cart->totalPrice * 100,
          "currency" => "usd",
          "source" => $request->input('stripeToken'), // obtained with Stripe.js
          "description" => "Test Charge"
        ));
        //code to save user purchased info in our database

        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->payment_id = $charge->id;

        Auth::user()->orders()->save($order);

      } catch(\Exception $e){
          return redirect()->route('checkout')->with('error',  $e->getMessage());

      }

      Session::forget('cart');
      return redirect()->route('product.index')->with('success', 'Successfully purchased products!');

    }

}

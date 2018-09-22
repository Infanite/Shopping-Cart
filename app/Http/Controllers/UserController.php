<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

// use Illuminate\Support\Facades\Auth;

use App\User;



class UserController extends Controller
{
    public function getSignup()
    {
      return view('user.signup');
    }

    public function postSignup(Request $request)
    {
      $this->validate($request, [

        'email' => 'email|required|unique:users',
        'password' => 'required|min:4'
      ]);

      $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
        'password' => bcrypt($request->input('conformPassword')),
      ]);
      $user->save();

      Auth::login($user);

      if(Session::has('oldUrl')){
        $oldUrl = Session::get('oldUrl');
        Session::forget('oldUrl');
        return redirect()->to($oldUrl);
      }

      return redirect()->route('product.index');
  }

  public function getLogin()
  {
      return view('user.login');
  }

  public function postLogin(Request $request)
  {

    if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

        if(Session::has('oldUrl')){
          $oldUrl = Session::get('oldUrl');
          Session::forget('oldUrl');
          return redirect()->to($oldUrl);
        }

      return redirect()->route('user.profile');

    }
    return redirect()->back();

  }

  public function getProfile()
  {
    $orders = Auth::user()->orders;
    $orders->transform(function($order, $key){

      $order->cart = unserialize($order->cart);
      return $order;

    });

    return view('user.profile', compact('orders'));

  }

  public function getLogout()
  {

    Auth::logout();
    return redirect()->route('user.login');
    // echo "logout";
  }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;

use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;

    public function __construct(SliderService $slider, MenuService $menu,
        ProductService $product)
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
    }

    public function index()
    {
        return view('home', [
            'title' => 'Shop',
            'sliders' => $this->slider->show(),
            'menusHome' => $this->menu->show(1),
            'products' => $this->product->get()
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result ])->render();

            return response()->json([ 'html' => $html ]);
        }

        return response()->json(['html' => '' ]);
    }

    public function contact(Request $request)
    {
        if($request->isMethod('post')){

            Session::forget('error');
            Session::forget('success');

            $email = $request->input('email', '');
            if (strlen($email) > 0 && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format";
            }else if(strlen($email) < 1){
                $error = "Email is required";
            }

            $message = $request->input('message', '');
            if (strlen(trim($message)) == 0) {
                $error = "Message is required";
            }

            if(isset($error)){
                Session::flash('error', $error);
                // return redirect()->back();
            }else{
                Session::flash('success', 'Email sent successfully');
            }

            return view('contact', [
                'title' => 'Contact',
                'email' => $email,
                'message' => $message,
            ]);
        }
        return view('contact', [
            'title' => 'Contact',
            'email' => '',
            'message' => ''
        ]);
    }

    public function about(Request $request)
    {
        return view('about', [
            'title' => 'About'
        ]);
    }

    
}

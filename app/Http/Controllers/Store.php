<?php


namespace App\Http\Controllers;


use App\Store_model;

class Store extends Controller
{

    public function index($id = 1)
    {
        $user_id = session('user_id', -1);
        $categories = Store_model::get_categories();
        $products = Store_model::get_products($id);
        $cart = self::getCart();
        return view("products", [
            "categories" => $categories,
            "active_category" => $id,
            "products" => $products,
            "cart" => $cart,
            "user_id" => $user_id
        ]);
    }

    public static function getCart()
    {
        $cart = session('cart', []);
        return array_map(function ($product_id, $quantity) {
            $product = Store_model::get_product($product_id);
            $product->quantity = $quantity;
            return $product;
        }, array_keys($cart), $cart);
    }

    public function cartItemInsert($id)
    {
        $cart = session('cart', []);
        $cart[$id] = isset($cart[$id]) && $cart[$id] > 0 ? $cart[$id] + 1 : 1;
        session(['cart' => $cart]);
        return back();
    }

    public function cartItemRemove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back();
    }

    public function checkout()
    {
        $user_id = session('user_id', -1);
        $categories = Store_model::get_categories();
        $cart = self::getCart();
        return view("checkout", [
            "categories" => $categories,
            "cart" => $cart,
            "user_id" => $user_id
        ]);
    }

    public function checkoutAction()
    {
        $user_id = session('user_id', -1);
        if ($user_id === -1) return redirect()->action("Store@login");
        $cart = self::getCart();
        $total = empty($cart) ? 0 : array_reduce($cart, function ($carry, $product) {
            return $carry + $product->price * $product->quantity;
        });
        $order_id = Store_model::create_order($user_id, $total);
        foreach ($cart as $product) {
            Store_model::insert_order_item($order_id, $product->id, $product->quantity);
        }
        $this->cartRemove();
        return view("message", [
            "message" => "Encomenda concluída com sucesso!"
        ]);
    }

    public function cartRemove()
    {
        session(['cart' => []]);
        return back();
    }

    public function orders()
    {
        $user_id = session('user_id', -1);
        if ($user_id === -1) return redirect()->action("Store@login");
        $categories = Store_model::get_categories();
        $cart = self::getCart();
        $orders = Store_model::get_orders($user_id);
        $orders_with_items = array_map(function ($order) {
            $result = $order;
            $order->items = Store_model::get_order_items($order->id);
            return $result;
        }, $orders);
        $orders_with_items = array_reverse($orders_with_items);
        return view("orders", [
            "user_id" => $user_id,
            "categories" => $categories,
            "cart" => $cart,
            "orders" => $orders_with_items
        ]);
    }

    public function register()
    {
        if (session("user_id", -1) !== -1) return redirect()->action("Store@index");
        $categories = Store_model::get_categories();
        $cart = self::getCart();
        return view("register", [
            "categories" => $categories,
            "cart" => $cart
        ]);
    }

    public function registerAction()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|confirmed'
        ]);
        $name = request('name');
        $email = request('email');
        $password = request('password');
        Store_model::register_user($name, $email, $password);
        return view('message', [
            'message' => "A conta foi criada com sucesso!"
        ]);
    }

    public function login()
    {
        if (session("user_id", -1) !== -1) return redirect()->action("Store@index");
        $categories = Store_model::get_categories();
        $cart = self::getCart();
        return view("login", [
            "categories" => $categories,
            "cart" => $cart
        ]);
    }

    public function loginAction()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = request('email');
        $password = request('password');
        $user = Store_model::validate_user($email, $password);
        if ($user) {
            session(['user_id' => $user->id]);
            return view('message', [
                'message' => "Entrou na sua conta com sucesso!"
            ]);
        }
        return back()->withErrors(["Email ou password incorretos!"]);
    }

    public function logout()
    {
        session()->forget('user_id');
        return view('message', [
            'message' => "Terminou a sessão com sucesso!"
        ]);
    }
}
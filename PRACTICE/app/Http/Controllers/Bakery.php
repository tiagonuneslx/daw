<?php


namespace App\Http\Controllers;


use App\Bakery_model;

class Bakery extends Controller
{
    public function menu($id = false)
    {
        $categories = Bakery_model::get_categories();
        if (!$id) $id = collect($categories)->first()->id;
        $products = Bakery_model::get_products($id);
        return view('menu', [
            'cat_id' => $id,
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function register()
    {
        if (session("user_id", -1) !== -1) return redirect()->action("Bakery@menu");
        return view('register');
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
        $activation_digest = substr(md5(time()), 0, 32);
        Bakery_model::register_user($name, $email, $password, $activation_digest);
        $subject = "Confirm register - Bakery";
        $message = "Your account has been registered successfully!<br />
                    To activate your account, click 
                    <a href='http://all.deei.fct.ualg.pt/~a61271/PRACTICE/bakery/activate/$activation_digest'>
                    here</a>";
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = "To: $name <$email>";
        $headers[] = "From: Bakery <bakery@bakery.com>";
        mail($email, $subject, $message, implode("\r\n", $headers));
        return redirect()->action("Bakery@menu");
    }

    public function activate($token)
    {
        Bakery_model::activate_user($token);
        return redirect()->action("Bakery@menu");
    }
}
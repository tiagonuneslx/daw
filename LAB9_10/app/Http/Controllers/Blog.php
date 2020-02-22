<?php

namespace App\Http\Controllers;

use App\Blog_model;
use Illuminate\Support\Facades\Cookie;

class Blog extends Controller
{
    public function index()
    {
        self::session_login();
        $user_id = session('user_id', -1);
        $user_name = session('user_name', '');
        $posts = Blog_model::get_posts();
        return view('index_template', [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'posts' => $posts
        ]);
    }

    public static function session_login()
    {
        if (Cookie::has('siteAuth')) {
            $remember_digest = Cookie::get('siteAuth', '');
            $result = Blog_model::check_remember_digest($remember_digest);
            if ($result) {
                session([
                    'user_id' => $result->id,
                    'user_name' => $result->name
                ]);
            }
        }
    }

    public function register()
    {
        return view('register_template');
    }

    public function register_action()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        $name = request('name');
        $email = request('email');
        $password = request('password');
        Blog_model::register_user($name, $email, $password);
        return view('message_template', [
            'message' => "Success! New user registered"
        ]);
    }

    public function login()
    {
        return view('login_template');
    }

    public function login_action()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = request('email');
        $password = request('password');
        $remember_me = \request('remember_me');
        $user = Blog_model::get_user_by_login($email, $password);
        if ($user) {
            session(['user_id' => $user->id]);
            session(['user_name' => $user->name]);
            if($remember_me) {
                $remember_digest = substr(md5(time()), 0, 32);
                Cookie::queue('siteAuth', $remember_digest, 60*24*30);
                Blog_model::set_remember_digest($user->id, $remember_digest);
            }
            return view('message_template', [
                'message' => "Welcome back!"
            ]);
        }
        return back()->withErrors(["Login failed!"]);
    }

    public function post($blog_id = false)
    {
        $content = $blog_id;
        if (session()->has('user_id') && $blog_id !== false) {
            $user_id = session('user_id');
            $content = Blog_model::get_blog($user_id, $blog_id)->content;
        }
        return view('blog_template', [
            'blog_id' => $blog_id,
            'content' => $content
        ]);
    }

    public function post_action($blog_id = false)
    {
        if (!session()->has('user_id'))
            return view('message_template', [
                'message' => "ERROR: Login first"
            ]);
        $user_id = session('user_id');
        $content = request('content', '');
        if ($blog_id === false) {
            Blog_model::new_blog($user_id, $content);
            return view('message_template', [
                'message' => "SUCCESS: New post submitted"
            ]);
        }
        if (empty(Blog_model::get_blog($user_id, $blog_id)))
            return view('message_template', [
                'message' => "ERROR: Not allowed"
            ]);
        Blog_model::update_blog($user_id, $blog_id, $content);
        return view('message_template', [
            'message' => "SUCCESS: Post updated"
        ]);
    }

    public function logout() {
        session([
            'user_id' => '',
            'user_name' => ''
        ]);
        Cookie::queue(Cookie::forget('siteAuth'));
        return view('message_template', [
            'message' => "See you back soon"
        ]);
    }

}
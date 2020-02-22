<?php

namespace App\Http\Controllers;

use App\Shelter_model;

class Shelter extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function pets($cat_id = false)
    {
        $user_id = session('user_id', false);
        $user_name = session('user_name', false);
        $categories = Shelter_model::get_categories();
        if ($cat_id) $pets = Shelter_model::get_pets($cat_id);
        else $pets = Shelter_model::get_all_pets();
        return view('pets', [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'categories' => $categories,
            'cat_id' => $cat_id,
            'pets' => $pets
        ]);
    }

    public function register()
    {
        if (session("user_id", false)) return redirect()->action("Shelter@pets");
        return view('register');
    }

    public function registerAction()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:petlovers,email',
            'password' => 'required|confirmed'
        ]);
        $name = request('name');
        $email = request('email');
        $password = request('password');
        Shelter_model::register_user($name, $email, $password);
        return redirect()->action('Shelter@pets');
    }

    public function login()
    {
        if (session("user_id", false)) return redirect()->action("Shelter@pets");
        return view('login');
    }

    public function loginAction()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = request('email');
        $password = request('password');
        $user = Shelter_model::login_user($email, $password);
        if ($user) {
            session(['user_id' => $user->id]);
            session(['user_name' => $user->name]);
            return redirect()->action("Shelter@pets");
        }
        return back()->withErrors(["Incorrect email or password."]);
    }

    public function logout()
    {
        session()->forget('user_id');
        session()->forget('user_name');
        return redirect()->action("Shelter@pets");
    }

    public function adopt($pet_id)
    {
        $user_id = session("user_id", false);
        if (!$user_id) return redirect()->action("Shelter@login");
        Shelter_model::adopt_pet($user_id, $pet_id);
        return redirect()->back();
    }

    public function mypets()
    {
        $user_id = session("user_id", false);
        $user_name = session("user_name", false);
        if (!$user_id) return redirect()->action("Shelter@login");
        $categories = Shelter_model::get_categories();
        $pets = Shelter_model::get_adopted_pets($user_id);
        return view('mypets', [
            'user_name' => $user_name,
            'categories' => $categories,
            'pets' => $pets
        ]);
    }
}

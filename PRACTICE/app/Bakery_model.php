<?php


namespace App;

use Illuminate\Support\Facades\DB;


class Bakery_model
{
    public static function get_products($id)
    {
        return DB::select(
            "SELECT *
             FROM products
             WHERE cat_id = ?",
            [$id]
        );
    }

    public static function get_product($id)
    {
        return collect(
            DB::select(
                "SELECT *
                 FROM products
                 WHERE id = ?",
                [$id]
            )
        )->first();
    }

    public static function get_categories()
    {
        return DB::select(
            "SELECT *
             FROM categories"
        );
    }

    public static function register_user($name, $email, $password, $activation_digest)
    {
        $password_digest = substr(md5($password), 0, 32);
        return DB::insert(
            "INSERT INTO customers(name, email, password_digest, created_at, updated_at, activation_digest)
             VALUES(?, ?, ?, NOW(), NOW(), ?)",
            [$name, $email, $password_digest, $activation_digest]
        );
    }

    public static function activate_user($activation_digest)
    {
        return DB::update(
            "UPDATE customers
             SET activated = 1, activated_at = NOW()
             WHERE activation_digest = ?",
            [$activation_digest]
        );
    }
}
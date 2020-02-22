<?php


namespace App;

use Illuminate\Support\Facades\DB;


class Store_model
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

    public static function create_order($customer_id, $total)
    {
        return DB::table("orders")->insertGetId([
            "customer_id" => $customer_id,
            "total" => $total,
            "created_at" => date('Y-m-d H:i:s', time())
        ]);
    }

    public static function insert_order_item($order_id, $product_id, $quantity)
    {
        return DB::insert(
            "INSERT INTO order_items(order_id, product_id, quantity)
             VALUES (?, ?, ?)",
            [$order_id, $product_id, $quantity]
        );
    }

    public static function get_orders($customer_id)
    {
        return DB::select(
            "SELECT *
             FROM orders
             WHERE customer_id = ?",
            [$customer_id]
        );
    }

    public static function get_order_items($order_id)
    {
        return DB::select(
            "SELECT *
             FROM order_items
             INNER JOIN products p on order_items.product_id = p.id
             WHERE order_id = ?",
            [$order_id]
        );
    }

    public static function register_user($username, $email, $password)
    {
        $password_digest = substr(md5($password), 0, 32);
        return DB::insert(
            "INSERT INTO customers(name, email, password_digest, created_at, updated_at)
             VALUES(?, ?, ?, NOW(), NOW())",
            [$username, $email, $password_digest]
        );
    }

    public static function validate_user($email, $password)
    {
        $password_digest = substr(md5($password), 0, 32);
        return collect(
            DB::select(
                "SELECT *
                 FROM customers
                 WHERE email = ?
                 AND password_digest = ?
                 LIMIT 1",
                [$email, $password_digest]
            )
        )->first();
    }
}
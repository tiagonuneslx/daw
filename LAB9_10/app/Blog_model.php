<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Blog_model
{
    public static function get_posts()
    {
        return DB::select("SELECT u.name user_name, m.*
                           FROM microposts m
                           INNER JOIN users u ON m.user_id = u.id
                           ORDER BY m.updated_at DESC");
    }

    public static function register_user($name, $email, $password)
    {
        $password_digest = substr(md5($password), 0, 32);
        DB::insert("INSERT INTO users(name, email, password_digest, created_at, updated_at)
                    VALUES (?, ?, ?, NOW(), NOW())", [$name, $email, $password_digest]);
    }

    public static function get_user_by_login($email, $password)
    {
        $password_digest = substr(md5($password), 0, 32);
        return collect(
            DB::select("SELECT id, name
                        FROM users
                        WHERE email = ?
                        AND password_digest = ?", [$email, $password_digest])
        )->first();
    }

    public static function new_blog($user_id, $blog)
    {
        DB::insert("INSERT INTO microposts(content, user_id, created_at, updated_at)
                    VALUES (?, ?, NOW(), NOW())", [$blog, $user_id]);
    }

    public static function get_blog($user_id, $blog_id)
    {
        return collect(
            DB::select("SELECT content
                        FROM microposts
                        WHERE id = ?
                        AND user_id = ?", [$blog_id, $user_id])
        )->first();
    }

    public static function update_blog($user_id, $blog_id, $content)
    {
        DB::update("UPDATE microposts
                    SET content = ?, updated_at = NOW()
                    WHERE id = ?
                    AND user_id = ?", [$content, $blog_id, $user_id]);
    }

    public static function set_remember_digest($user_id, $remember_digest)
    {
        DB::update("UPDATE users
                    SET remember_digest = ?
                    WHERE id = ?", [$remember_digest, $user_id]);
    }

    public static function check_remember_digest($remember_digest)
    {
        return collect(
            DB::select("SELECT name, id
                        FROM users
                        WHERE remember_digest = ?", [$remember_digest])
        )->first();
    }
}
<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Shelter_model
{
    public static function get_all_pets()
    {
        return DB::select(
            "SELECT *
             FROM pets
             WHERE status = 0"
        );
    }

    public static function get_pets($cat_id)
    {
        return DB::select(
            "SELECT *
             FROM pets
             WHERE cat_id = ?
             AND status = 0",
            [$cat_id]
        );
    }

    public static function get_categories()
    {
        return DB::select(
            "SELECT *
             FROM petcategories"
        );
    }

    public static function register_user($name, $email, $password)
    {
        $password_digest = substr(md5($password), 0, 32);
        return DB::insert(
            "INSERT INTO petlovers(name, email, password_digest, created_at, updated_at)
             VALUES(?, ?, ?, NOW(), NOW())",
            [$name, $email, $password_digest]
        );
    }

    public static function login_user($email, $password)
    {
        $password_digest = substr(md5($password), 0, 32);
        return collect(
            DB::select(
                "SELECT *
                 FROM petlovers
                 WHERE email = ?
                 AND password_digest = ?",
                [$email, $password_digest]
            )
        )->first();
    }

    public static function adopt_pet($user_id, $pet_id)
    {
        DB::update(
            "UPDATE pets
             SET status = 1
             WHERE id = ?",
            [$pet_id]
        );
        return DB::insert(
            "INSERT INTO adoptions(petlover_id, pet_id, created_at)
             VALUES(?, ?, NOW())",
            [$user_id, $pet_id]
        );
    }

    public static function get_adopted_pets($user_id)
    {
        return DB::select(
            "SELECT p.*, a.created_at adopted_at
             FROM adoptions a
             INNER JOIN pets p ON p.id = a.pet_id
                                      AND a.petlover_id = ?
             ORDER BY created_at DESC",
            [$user_id]
        );
    }
}

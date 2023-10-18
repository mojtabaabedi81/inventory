<?php

function login()
{
    session_start();
    if (post('loginRequest')) {
        if (user_exists(post('email'))) {
            $login = user_login(post('email'), post('password'));
            if ($login) {
                view("inventory_form");
            } else {
                echo "user or password wrong !";
            }

        } else
            echo "user not found !";
    } else
        view("login_register");
    session_destroy();
}


function register()
{
    $email = post('email');

    if (post('email')) {
        $email = post('email');
        $password = post('password');

        if (empty($email) || empty($password)) {
            echo "Please fill in all required fields.";
        } else {

            if (!user_exists($email)) {
                create_user(post('email'),md5(post('password')));
            }
            view('inventory_form');
        }
    } else {
        echo "this account already exist";
        view("login_register");
    }
}
<?php

function login()
{
    session_start();
    if (isset($_SESSION['user_email'])){
        view("inventory_form");
    }else
    if (post('loginRequest')) {
        $email = post('email');
        $password = post('password');

        if (user_exists($email)) {
            $login = user_login($email,$password);
            if ($login) {
                $_SESSION['user_email'] = $email;
                view("inventory_form");
            } else {
                echo "user or password wrong !";
            }

        } else
            echo "user not found !";
    } else
        view("loginForm");
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
                create_user(post('email'), md5(post('password')));
            }
            view('inventory_form');
        }
    } else {
        echo "this account already exist";
        view("loginForm");
    }
}
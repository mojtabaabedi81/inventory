<?php
function login()
{
    if (post('loginRequest')){
        if (user_exists(post('email'))) {
            $login = user_login(post('email'), post('password'));
            if ($login) {
                view("inventory_form");
            } else {
                echo "user or password wrong !";
            }

        }else
            echo "user not found !";
            view("login_register");
    }else
        view("login_register");

}


function register()
{
    if(null !==(post('registerRequest'))) {


    }
    view("login_register");
}
<?php

function login()
{
    if (post('loginRequest')) {
            $email = post('email');
            $password = post('password');

            if (user_exists($email)) {
                $login = user_login($email, $password);
                if ($login) {
                    $_SESSION['user_email'] = $email;
                    header("Location:../inventoryTable/show");
                    exit();
                } else {
                    echo "user or password wrong !";
                }

            } else
                echo "user not found !";
        } else
            view("loginForm");

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
                create_user($email, md5($password));

                header("Location: ../inventoryTable/show");

            } else
                echo "this account already exist";
        }
    }

}
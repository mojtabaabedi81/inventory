<?php

function login()
{
    if (post('loginRequest')) {
        $email = post('email');
        $password = post('password');


        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (strlen($password) >= 6) {
                if (user_exists($email)) {
                    $login = user_login($email, $password);
                    if ($login) {
                        $_SESSION['user_email'] = $email;
                        header("Location:../inventoryTable/show");
                        exit();
                    } else {
                        echo "User or password is incorrect!";
                    }
                } else {
                    echo "User not found!";
                }
            } else {
                echo "Password must be at least 6 characters long.";
            }
        } else {
            echo "Invalid email address!";
        }
    } else {
        view("loginForm");
    }
}


function register()
{
    $email = post('email');
    $password = post('password');

    if (post('email')) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (strlen($password) >= 6) {
                if (empty($email) || empty($password)) {
                    echo "Please fill in all required fields.";
                } else {
                    if (!user_exists($email)) {
                        create_user($email, md5($password));
                        header("Location: ../inventoryTable/show");
                    } else {
                        echo "This account already exists.";
                    }
                }
            } else {
                echo "Password must be at least 6 characters long.";
            }
        } else {
            echo "Invalid email address.";
        }
    }
}


function logout()
{
    session_destroy();
    header('Location: ' . BASEURL);
}
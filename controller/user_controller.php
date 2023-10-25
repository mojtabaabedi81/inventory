<?php
function login()
{
    if (post('loginRequest')) {
        $email = post('email');
        $password = post('password');
        if (validate_email($email)) {
            if (validate_password($password)) {
                if (user_exists($email)) {
                    $login = user_login($email, $password);
                    if ($login) {
                        $_SESSION['user_email'] = $email;
                        header("Location:../inventoryTable/show");
                        exit();
                    } else
                        view("loginForm");
                }
                echo "n";
            }
        }
        echo "b";
    } else
        view('loginForm');
}

function register()
{

    if (post('email') && post('password')) {
        $email = post('email');
        $password = post('password');
        if (!validate_email($email)) {
            //error
            if (!validate_password($password)) {
                //error
            }
        }
        if (!user_exists($email)) {
            create_user($email, md5($password));
            header("Location: ../inventoryTable/show");
            exit();
        } else {
            echo "This account already exists.";
        }
    }
}


function logout()
{
    session_destroy();
    header('Location: ' . BASEURL);
}
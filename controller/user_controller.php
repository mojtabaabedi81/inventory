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
                    } else {
                        msg_error('email or password wrong !');
                    }
                } else {
                    msg_error('user not found !');
                }
            } else {
                msg_error('password not strong !');
            }
        } else {
            msg_error('email not valid !');
        }
    }

    view('loginForm');
}

function register()
{

    if (post('email') && post('password')) {
        $email = post('email');
        $password = post('password');
        if (!validate_email($email)) {

            if (!validate_password($password)) {
                //error
            }
        }
        if (!user_exists($email)) {
            create_user($email, md5($password));
            header("Location: ../inventoryTable/show");
            exit();
        } else {
            header('Location: ' . BASEURL);
            msg_error("This account already exists.");
        }
    }else
        header('Location: ' .BASEURL);
    msg_error("Some thing went wrong !");
}


function logout()
{
    session_destroy();
    header('Location: ' . BASEURL);
}
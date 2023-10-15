<?php

function login()
{
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

}


function register()
{
    if (post('registerRequest')) {
        $email = post('email');
        $password = post('password');
        // Additional fields like username, name, etc. can be retrieved here.

        if (empty($email) || empty($password)) {
            echo "Please fill in all required fields.";
        } else {

            if (user_exists($email)) {
                create_user(post('email'),post('password'));
            } else {
                // You should add code to securely hash the password and store user information in the database.
                // Example: user_register($email, $hashedPassword, $username, $name);

                // After successfully registering the user, you can redirect them to a login page or show a success message.
                echo "Registration successful! Please log in.";
                // You might also redirect the user to the login page.
                // header("Location: login_page.php");
            }
        }
    } else {
        // If the 'registerRequest' is not present in the POST data, display the registration form.
        view("registration_form");
    }
}
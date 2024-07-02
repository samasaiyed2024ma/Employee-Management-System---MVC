<?php

namespace Ems\Controllers;

use Ems\Models\Admin;
use Ems\Controller;

class AdminLoginController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Admin();
    }

    /**
     * form validation
     */
    private function validate(array $data): array
    {
        $errors = [];

        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $password = $data['password'];
        $confirm_password = $data['confirm_password'];

        //firstname validation
        if (empty($firstname)) {
            $errors['firstname'] = 'Please enter your first name.';
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
            $errors['firstname'] = 'first name must contain characters and white space only.';
        }

        //lastname validation
        if (empty($lastname)) {
            $errors['lastname'] = 'Please enter your last name.';
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            $errors['lastname'] = 'Name must contain characters and white space only.';
        }

        //email validation
        $getAdmin = $this->model->getRecordByEmail($email);
        if (empty($email)) {
            $errors['email'] = 'Please enter your email address.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Enter valid email address.';
        } elseif ($getAdmin['email'] == $email) {
            $errors['email'] = 'E-mail already registered.';
        }

        //password validation
        if (empty($password) && empty($confirm_password)) {
            $errors['password'] =  'Please enter your password';
        } elseif ($password !== $confirm_password) {
            $errors['password'] =  'Password and confirm password should be same.';
        }

        return $errors;
    }

    /**
     * @return registration form
     */
    public function registration(): void
    {
        $this->render('registration');
    }

    /**
     * store registered data
     */
    public function storeRegData(): void
    {
        $input = $_POST;

        $password_hash = password_hash($input['password'], PASSWORD_DEFAULT);

        $errors = $this->validate($input);

        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $_SESSION['input'] = $input;
            $this->redirect('registration');
        }

        $data = [
            'first_name' => $input['firstname'],
            'last_name' => $input['lastname'],
            'email' => $input['email'],
            'password' => $password_hash
        ];

        $save = $this->model->insertAdminData($data);
        if (!$save) {
            $errors['registration_error'] = 'Registration failed!';
            $this->redirect('registration');
        }
        $this->redirect('login');
    }

    /**
     * @return login form
     */
    public function login(): void
    {
        $this->render('login');
    }

    /**
     * login via email and password
     */
    public function loginAdmin(): void
    {
        $errors = [];
        $input = $_POST;
        $email = $input['email'];
        $password = $input['password'];

        $getAdmin = $this->model->getRecordByEmail($email);

        //email validation
        if (empty($email)) {
            $errors['email'] = 'Please enter your email address.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Enter valid email address.';
        } elseif ($getAdmin['email'] != $email) {
            $errors['email'] = 'Email not registered.';
        }

        //password validation
        if (empty($password)) {
            $errors['password'] = 'Please enter your password';
        } elseif (!password_verify($password, $getAdmin['password'])) {
            $errors['password'] = 'wrong password';
        }


        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $_SESSION['input'] = $input;
            $this->redirect('login');
        }

        $this->redirect('dashboard');
    }
}

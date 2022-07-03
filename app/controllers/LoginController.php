<?php
namespace App\Controllers;

use App\Models\User;

class LoginController{
    
    public function loginForm(){
        include_once './app/views/auth/login.php';
    }

    public function postLogin(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = User::where('email', $email)->first();
        if($user && password_verify($password, $user->password)){
            $_SESSION['auth'] = [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "role_id" => $user->role_id
            ];
            header('location: ' . BASE_URL);
            die;
        }

        header('location: '. BASE_URL . 'login?msg=Đăng nhập không thành công!');
        die;
    }
}
?>
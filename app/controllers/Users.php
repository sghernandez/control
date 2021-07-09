<?php
class Users extends Controller{

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    public function register()
    {
        $data = addIndexErrors([
            'name' => post('name'),
            'email' => post('email'),
            'password' => post('password'),
            'confirm_password' => post('confirm_password'),
        ]);        

        if (isPost())
        {
            $validator = [
                'name' => 'required|min_len(3)',
                'email' => 'required|valid_email',     
                'password' => 'required|min_len(6)',
                'confirm_password' => 'required',                     
            ];

            $data = validate($validator, $data);

            if($this->userModel->findUserByEmail($data['email']))
            {
                $data['email_err'] = 'El email ya está registrado';
                $data['has_errors'] = TRUE;
            }

            if($data['password'] != $data['confirm_password'])
            {
                $data['confirm_password_err'] = 'La confirmación del Password es incorrecta.';
                $data['has_errors'] = TRUE;
            }               

            if (! array_key_exists('has_errors', $data)) // empty($data['has_errors'])
            {                                
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if($this->userModel->register($data))
                {
                   flash('register_success', 'you are registerd you can login now');
                   redirect('users/login');
                }
            }
           
        }

        $this->view('users/register', $data); 
    }


    public function login()
    {
            $data = addIndexErrors([
                'email' => post('email'),
                'password' => post('password'),
                'email_err' => '',
                'password_err' => ''
            ]);   

            if(isPost())
            {
                $loggedInUser = $this->userModel->login(post('email'), post('password'));
                if($loggedInUser){
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['email_err'] = 'Password / Email incorrecto';                
                }    
            }    

            $this->view('users/login', $data);
    
    }

    //setting user section variable
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;

        redirect('home/index');
    }

    //logout and destroy user session
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        session_destroy();

        redirect('users/login');
    }
}
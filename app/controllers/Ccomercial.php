<?php

class Ccomercial extends Controller{

    public function __construct()
    {        
        if(isLoggedIn()) { redirect('home/index'); }
        $this->CcomercialModel = $this->model('CcomercialModel');
    }

    public function register()
    {
        $dataInsert = [
            'razonSocial' => post('razonSocial'),
            'email' => post('email'),
            'nit' => post('nit'),
            'password' => post('password')
        ];

        $data = addIndexErrors($dataInsert);   
        $data['confirm_password'] = post('confirm_password');    

        if (isPost())
        {
            $validator = [
                'razonSocial' => 'required|min_len(3)',
                'email' => 'required|valid_email',     
                'nit' => 'required|min_len(7)',
                'password' => 'required|min_len(6)',
                'confirm_password' => 'required',                     
            ];

            $data = $this->CcomercialModel->validate_unique(validate($validator, $data));

            if (! array_key_exists('has_errors', $data)) 
            {                                
                $dataInsert['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->CcomercialModel->insert('Ccomercial', tableName('Ccomercial', $dataInsert)))
                {
                   flash('register_success', 'Ahora se encuentra registrado');
                   redirect('ccomercial/login');
                }
            }
           
        }

        $this->view('ccomercial/register', $data); 
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
                $loggedIn = $this->CcomercialModel->login(post('email'), post('password'));

                if($loggedIn){
                    $this->createSession($loggedIn);
                }else{
                    $data['email_err'] = 'Password / Email incorrecto';                
                }    
            }    

            $this->view('ccomercial/login', $data);
    
    }

    // variables de sessión
    public function createSession($row)
    {
        $_SESSION['user_id'] = $row->id_Ccomercial;
        $_SESSION['name'] = $row->Ccomercial_razonSocial;

        redirect('home/index');
    }

    //logout and destroy user session
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        session_destroy();

        redirect('ccomercial/login');
    }
}
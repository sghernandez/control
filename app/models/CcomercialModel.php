<?php

require_once 'DB_CORE\DB.php';

class CcomercialModel extends DB {

    public function login($email, $password)
    {
        $row = $this->getRow('Ccomercial', ['Ccomercial_email' => $email]);
        if(isset($row->id_Ccomercial)){
            if(password_verify($password, $row->Ccomercial_password)) { return $row; }
        }
        
        return FALSE;
    }    


    public function validate_unique($data)
    {        
        if($this->getRow('Ccomercial', ['Ccomercial_razonSocial' => post('razonSocial')]))
        {
            $data['razonSocial_err'] = 'Razón Social ya está registrado';
            $data['has_errors'] = TRUE;
        }            

        if($this->getRow('Ccomercial', ['Ccomercial_email' => post('email')]))
        {
            $data['email_err'] = 'El email ya está registrado';
            $data['has_errors'] = TRUE;
        }

        if($this->getRow('Ccomercial', ['Ccomercial_nit' => post('nit')]))
        {
            $data['nit_err'] = 'El NIT ya está registrado';
            $data['has_errors'] = TRUE;
        }  

        if($data['password'] != $data['confirm_password'])
        {
            $data['confirm_password_err'] = 'La confirmación del Password es incorrecta.';
            $data['has_errors'] = TRUE;
        }           
        
        return $data;
    }
    
}
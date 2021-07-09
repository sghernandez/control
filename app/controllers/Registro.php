<?php

class Registro extends Controller{

    public function __construct()
    {        
        $this->RegistroModel = $this->model('RegistroModel');
    }

    public function ingreso()
    {
        $data = addIndexErrors(['documento' => post('documento')]);    

        if (isPost())
        {
            $validator = ['documento' => 'required|min_len(7)'];

            $data = validate($validator, $data);            

            if (! array_key_exists('has_errors', $data))
            {                                            
                $row = $this->RegistroModel->getRow('Persona', ['Persona_documento' => post('documento')]);

                if(isset($row->id_Persona))
                {
                    $this->RegistroModel->registrar_ingreso($row->id_Persona);
                    $mensaje = "Se ha registrado el ingreso de: $row->Persona_nombre $row->Persona_apellido"; 
                    $data['documento'] = '';
                }
                else{
                    $data['nuevo_registro'] = TRUE;   
                    $mensaje = 'Por favor pulse en botón "REGISTRAR CIUDADANO" para ingresarlo; ya que no se halla en la BD.';
                }

                flash('register_success', $mensaje);

                if(post('nuevo')){ 
                    $_SESSION['nuevo_registro'] = post('documento'); 
                    redirect('registro/add');
                }
            }
           
        }

        $this->view('registro/ingreso', $data); 
    }


    public function add()
    {
        $registro_ingreso = FALSE;
        $dataInsert = [
            'nombre' => post('nombre'),
            'apellido' => post('apellido'),
            'email' => post('email'),
            'documento' => post('documento'),
            'nuevo' => post('nuevo'),
        ];

        if(isset($_SESSION['nuevo_registro']))
        {
           $dataInsert['documento'] = $dataInsert['nuevo'] = $_SESSION['nuevo_registro'];
           unset($_SESSION['nuevo_registro']);
        }

        $data = addIndexErrors($dataInsert);  

        if (isPost())
        {
            $validator = [
                'nombre' => 'required|min_len(3)',
                'apellido' => 'required|min_len(3)',
                'email' => 'required|valid_email',     
                'documento' => 'required|min_len(7)',                  
            ];

            $data = $this->RegistroModel->validate_unique(validate($validator, $data));

            if (! array_key_exists('has_errors', $data)) // empty($data['has_errors'])
            {     
                $registro_ingreso = $dataInsert['nuevo'];            
                unset($dataInsert['nuevo']);     
                
               
                if($ID = $this->RegistroModel->insert('Persona', tableName('Persona', $dataInsert)))
                {
                    $mensaje = 'Se ha Registrado el Ciudadano.';     
                    if($registro_ingreso)
                    { 
                        $this->RegistroModel->registrar_ingreso($ID);
                        $mensaje .= ' Y también su ingreso.';
                    }
                    
                    flash('register_success', $mensaje);
                    return redirect('registro/add');
                }
                
            }
           
        }  

        $this->view('registro/add', $data); 
    }




}
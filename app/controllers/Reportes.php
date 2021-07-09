<?php

class Reportes extends Controller{

    public function __construct(){
        $this->ReportesModel = $this->model('ReportesModel');
    }


    public function notificar()
    {
        $data = [
           'extensionsAllowed' => ['xls', 'xlsx', 'ods'],
           'input' => 'excel',           
        ];   

        if(isPost())
        {
            $upload = $this->ReportesModel->validate_upload($data);

            if(! empty($upload['has_error']))
            {
                flash('register_success', $upload['has_error']);            
            }else{
                flash('register_success', 'El archivo se cargó correctamente.');             
            }    
        }    

        $this->view('reportes/notificar', $data);
    }


}
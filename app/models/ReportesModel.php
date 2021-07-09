<?php

require_once 'DB_CORE\DB.php';

class ReportesModel extends DB {

    public function validate_upload($data)
    {      
        $errors = [];
        $input = $data['input'];
        $MB = 1048576;
        $sizeMb = 2; 	 
        $extensionsAllowed = $data['extensionsAllowed'];
   
        $dir = APPROOT. '/public/uploads/';
        if (! is_dir($dir)) { mkdir($dir, 0777, true); }	 
   
        if (isset($_FILES[$input]['tmp_name'])) 
        {   
            $filename = $_FILES[$input]["name"];
            $filetype = $_FILES[$input]["type"];
            $filesize = $_FILES[$input]["size"];	
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));	
                   
            // $newname = $dir .basename($_FILES[$input]['name']);
            $newname = $dir . $_SESSION['user_id']. '_reporte_actual.'. $ext;

           // (move_uploaded_file($_FILES[$input]['tmp_name'], $newname));
        
            if($filesize > ($sizeMb * $MB)) {
                $errors['has_error'] = "El archivo no debe pesar más de $sizeMb MB. <br>";
            }
                    
            if(! in_array($ext, $extensionsAllowed)) {
                @$errors['has_error'] .= " Extensión no válida. <br>";             
            }
            
            if(! count($errors))
            {			
                if (! (move_uploaded_file($_FILES[$input]['tmp_name'], $newname))) 
                {
                   @$errors['has_error'] .= " Hubo un problema subiendo el archivo. <br>";  
                } 
            }
                
            return $errors;                   
        }  

    }
    
}
<?php

require_once 'PDO_Value_Binder.php';

class DB extends PDO_Value_Binder{ 

	 public static $pdo;
     private $host = DB_HOST;
     private $user = DB_USER;
     private $pass = DB_PASS;
     private $dbname = DB_NAME;
     
     public function __construct()
     {
        $dns = 'mysql:host='. $this->host. ';dbname='. $this->dbname. ';charset=utf8';
        
        self::$pdo = new \PDO($dns, $this->user, $this->pass);	 
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);               
     }


    /* insert - ingresa un registro en la tabla*/
    public static function insert($table, $dataInsert)
    {   
        $fields = implode(', ', array_keys($dataInsert));   
        $binds = ':'. implode(', :', array_keys($dataInsert)); 

        try 
        {
            $stm = self::$pdo->prepare("INSERT INTO $table ($fields) VALUES($binds)");    
            self::bindValues($stm, $dataInsert);            
            $stm->execute();    
            
            return self::$pdo->lastInsertId();
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }        

    }   

        
    /* update => actualiza un registro */
    public static function update($table, $array, $index) 
    {
        $cols = $binds = '';    
        foreach ($array as $key => $data)
        {
		   if($key != $index){ $cols .= $table.'_'. $key. '=?,';  }           
           $update[] = $data;
        }
        
        try 
        {            
            $sql = "UPDATE  `$table` SET " . rtrim($cols, ',') . " WHERE $index=?";
            return self::$pdo->prepare($sql)->execute($update); 
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
       
    }
	
    /* delete - borra un registro de la tabla: "$table" con el id: "$id"
       retorna: boolean  */
    public static function delete($table, $idArray) 
    {		
		foreach ($idArray as $key => $id){
			$field_id = $key;
		}
		
        try 
        {
            $stm = self::$pdo->prepare("DELETE FROM $table WHERE idArray = ?");
            return $stm->execute([$id]);
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }
	
	
    /* getRow - retornas un registro de la tabla: "$table"
       retorna: resultados de la consulta */
    public static function getRow($table, $idArray) 
    {		
		foreach ($idArray as $key => $id){ $field = $key; }		

        try 
        {            
            $stm = self::$pdo->prepare("SELECT * FROM $table WHERE $field = ? LIMIT 1");
            $stm->execute([$id]);
			
			return $stm->fetch();
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }	


    /* getRows - retornas los registros de la tabla: "$table"
       retorna: resultados de la consulta */
       public static function getRows($table, $idArray=[]) 
       {		
           try 
           {            
               $stm = self::$pdo->prepare("SELECT * FROM $table");  
               $stm->execute();             
               return $stm->fetchAll();
           } 
           catch (\PDOException $e) 
           {
              self::setErrorPDO($e->getMessage());
              return FALSE;  
           }
       }	    

       
     public static function sp()
     {
        $published_year = 2010;
        $sql = 'CALL get_books(:published_year)';
        
        try {

            $statement = self::$pdo->prepare($sql);        
            $statement->bindParam(':published_year', $published_year, \PDO::PARAM_INT);        
            $statement->execute();
        
            return $statement->fetchAll(\PDO::FETCH_ASSOC);        
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }

     }


    /* guarda en sesión el último error: Solo para ambiente de desarrollo */
    public static function setErrorPDO($error)
    {
        if(ENVIROMENT == 'development'){
            $_SESSION['pdo_error'] = $error;
        }       
    }     

    	
} // End of class




    /* insert - ingresa un registro en la tabla*/
    /*
    public static function insert($table, $array)
    {   
        $cols = $binds = '';    
        foreach ($array as $key => $data){
            $cols .= $table.'_'.$key.',';
            $binds .= '?,';
            $insert[] = $data;
        }               

        try 
        {
            $sql = "INSERT INTO `$table` (" . rtrim($cols, ',') . ") VALUES (" . rtrim($binds, ',') .")";     
            return self::$pdo->prepare($sql)->execute($insert);             
        } 
        catch (\PDOException $e) 
        {
            self::setErrorPDO($e->getMessage());
            return FALSE;  
        }
    }   */
    
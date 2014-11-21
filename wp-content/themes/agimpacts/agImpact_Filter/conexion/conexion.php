<?php 
require('adodb/adodb.inc.php');
define('ADODB_ASSOC_CASE',2); 

	function obtenerConexion() 
	{
	    $db =ADONewConnection('mysqli');
		$db->SetFetchMode(ADODB_FETCH_ASSOC);   // muestra los arreglos con asociaciones
		//$db->SetFetchMode(ADODB_FETCH_NUM);	//muestra los arreglos enumerados
		if(!$db->PConnect("localhost", "root", "", "agimpacts")){
			echo"<h1> [:(] Error al conectar a la base de datos</h1>";	
			exit();
		}
		else
			return $db;
    }

	function query($sql)
	{
		$db = obtenerConexion();
		$pre = $db->Prepare($sql);
		$rs =&$db->_Execute($pre);
		if (!$rs){
		   die($db->ErrorMsg()); 
		}
		else{
			return $rs->GetRows(); 
		}
	}

	function operacion($sql)
	{
		$db = obtenerConexion();
		$pre = $db->Prepare($sql);
		$rs =&$db->_Execute($pre);
		if (!$rs){	
			$ret=false;
			die($db->ErrorMsg()); 
		}
		else{	$ret=true;	}
		return $ret;
	}
	

?>

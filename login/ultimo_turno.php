<?php
	header("Content-Type: application/json");
	include("../conexi.php");
	$link  = Conectarse();
	$respuesta   = array();
	
	
	//Buscar Ultimo Turno
	$q_turnos = "SELECT * FROM  turnos ORDER BY id_turnos DESC LIMIT 1";
	
	$respuesta["q_turnos"] = "$q_turnos";
	$result = mysqli_query($link, $q_turnos);
	
	if(!$result){
		$respuesta["buscar_turno"] = "Error al Buscar Turno: $q_turnos". mysqli_error($link);
	}
	else{
		$num_rows = mysqli_num_rows($result) ;
		$respuesta["num_rows"] = "$num_rows";
		
		//Si no hay turno iniciar uno 
		if($num_rows == 0){
			$respuesta["ultimo_turno"] = 1;
			$respuesta["pedir_efectivo"] = 1;
			$respuesta["mensaje"] = "No hay turnos";
			
			$insertar_turno = "INSERT turnos SET 
			fecha_inicio_turnos = CURDATE(),
			hora_inicios = CURTIME()
			";
			if(mysqli_query($link,$insertar_turno)){
				$respuesta['estatus'] = 'success';
				}else{
				$respuesta['estatus'] = 'error';
				$respuesta['mensaje'] = 'Error en Insertar Turno';
			}
		}
		else{ 
			//Si hay turno checar si esta cerrado
			$consulta = "SELECT * FROM turnos WHERE cerrado = 0 ";
			$resultado = mysqli_query($link,$consulta);
			$numero_turno_abiertos = mysqli_num_rows($resultado);
			
			//Si el turno esta cerrado abrir uno nuevo
			if($numero_turno_abiertos == 0){
			
				
				$insertar_nuevo_t = "INSERT INTO turnos SET 
				fecha_inicio_turnos = CURDATE(),
				hora_inicios = CURTIME(), cerrado = 0";
				
				if(mysqli_query($link,$insertar_nuevo_t)){
					$respuesta['estatus'] = "success";
					$respuesta["pedir_efectivo"] = 1;
				}
				else{
					$respuesta['estatus'] = 'error';
					$respuesta['mensaje'] = 'Error en Insertar';
					
				}
				
			}
			else{
				while($fila = mysqli_fetch_assoc($result)){
					$respuesta["ultimo_turno"] = $fila["id_turnos"];
					$respuesta["cerrado"] = $fila["cerrado"];
					$respuesta["efectivo_inicial"] = $fila["efectivo_inicial"]; 
				}
				
			}
			
			
		}
	}
	echo json_encode($respuesta);
	
?>
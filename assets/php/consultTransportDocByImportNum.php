<?php
// <!--
// 	* This file returns the transport's document
// by importation number
// -->
    $importation = $_GET['importation'];
	include_once('PhpMySQL.php');
    $connection = new Database();
	// Acentos de base de datos a html.
	$acentos = $connection->query("SET NAMES 'utf8'");
	if(!$connection->link)
          {
            $result['ERROR'][0] = "Error de conexión";
            $result['ERROR'][1] = "No se pudo conectar a la base de datos";
          }
    
          else
            {
                $query = "CALL DOCUMENTOS_IMPORTACION('$importation');";
		$queryResult = $connection->query($query);

		if($queryResult)
		{
			$data = array();
			while($tempData = $connection->fetch_array_assoc($queryResult))
                            {
				$data[] = $tempData;
                            }
			foreach($data as $row)
                            {
				foreach ($row as $key => $value) 
				{
					$temp[] = $value;
				}
				$result['DATA'][] = $temp;
				unset($temp);
                            }
		}
                    else
                        {
                            $result['ERROR'][0] = "Error de consulta";
                            $result['ERROR'][1] = "No se pudo realizar la consulta.";
                        }
		$connection->close();
	}
	print json_encode($result);
?>
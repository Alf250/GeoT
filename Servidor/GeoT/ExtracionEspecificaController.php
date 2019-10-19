<?php
    include_once 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\IOFactory;

    class ExtracionEspecificaController{

        function Sel($id){
            $rutarchivo = "INFORMACION.xlsx";
            $documento = IOFactory::load($rutarchivo);
            $hojactual = $documento->getSheet(0);

            $registro['Registro'] = array();

            for($z =2;$z<22;$z++){

                if($hojactual->getCellByColumnAndRow(1,$z)->getValue() == $id){
                    $item = array(
                        'id' => $hojactual->getCellByColumnAndRow(1,$z)->getValue(),
                        'fecha_inicio' => $hojactual->getCellByColumnAndRow(2,$z)->getValue(),
                        'fecha_fin' => $hojactual->getCellByColumnAndRow(3,$z)->getValue(),
                        'categoria' => $hojactual->getCellByColumnAndRow(4,$z)->getValue(),
                        'area_responsable' => $hojactual->getCellByColumnAndRow(5,$z)->getValue(),
                        'sector' => $hojactual->getCellByColumnAndRow(6,$z)->getValue(),
                        'nombre' => $hojactual->getCellByColumnAndRow(7,$z)->getValue(),
                        'primer_apellido' => $hojactual->getCellByColumnAndRow(8,$z)->getValue(),
                        'segundo_apellido' => $hojactual->getCellByColumnAndRow(9,$z)->getValue(),
                        'instituto' => $hojactual->getCellByColumnAndRow(10,$z)->getValue(),
                        'clausula' => $hojactual->getCellByColumnAndRow(11,$z)->getValue(),
                        'documento' => $hojactual->getCellByColumnAndRow(12,$z)->getValue()
                    );
                    array_push($registro['Registro'],$item);
                }
            }
            $this->PrintJSON($registro);
        }

        function PrintJSON($array){
            header('Content-Type: application/json');
            echo json_encode($array,JSON_UNESCAPED_UNICODE);
            http_response_code(200);
        }
    }
?>
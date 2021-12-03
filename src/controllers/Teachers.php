<?php

namespace controllers;

class Teachers{
    private $evidencesTable;
    private $profesorTable;
    private $autentification;

    public function __construct(
        \models\DataBaseTable $evidencesTable,
        \models\DataBaseTable $profesorTable,
        \controllers\Autentification $autentification
        )
    {
        $this->evidencesTable= $evidencesTable;
        $this->profesorTable= $profesorTable;
        $this->autentification= $autentification;

    }

    public function ingreso(){
        $evidences = $this->evidencesTable->selectJoinFull();
        return [
            'title' => 'Ingreso de evidencias - SAC',
            'template' => 'teachers/ingreso.html.php',
            'variables' => [
                'evidences' => $evidences
            ]
        ];
    }

    public function evidencias(){
        return [
            'title' => 'Listado de evidencias - SAC',
            'template' => 'teachers/evidencias.html.php'
        ];
    }

    public function reportes(){
        return [
            'title' => 'Gernerar reportes - SAC',
            'template' => 'teachers/reportes.html.php'
        ];
    }

    public function guardar(){
        $user = $this->autentification->getUser();
        $carpetaPrincipal = 'Archivos/'.$user->id_profesor.'/';            
        for ($i=0; $i < count($_FILES); $i++){
             $carpetEvidencia = $carpetaPrincipal.$_POST['file'.$i]['cod_evidences'].'/';
            if($_FILES['file'.$i]['name']['pdf'] != '' ||
               $_FILES['file'.$i]['name']['doc'] != '' ||
               $_FILES['file'.$i]['name']['xlsx'] != '' 

            ){
                $evidence = $this->evidencesTable->selectFromColumn('cod_evidencia',$_POST['file'.$i]['cod_evidences'])[0]; 
                $pdf_direcion= $evidence->pdf_archivo;
                $docx_direcion= $evidence->docx_archivo;
                $xlsx_direccion= $evidence->xlxs_archivo;          
                
                if ($_FILES['file'.$i]['name']['pdf'] != ''){
                    $archivo =$_FILES['file'.$i]["tmp_name"]['pdf'];
                    $destino = $carpetEvidencia. $_FILES['file'.$i]['name']['pdf'];
                    $pdf_direcion = $destino;
                    $this->moveFile($carpetaPrincipal,$archivo,$destino,$carpetEvidencia);
                    
                }
                 if( $_FILES['file'.$i]['name']['doc'] != ''){
                    $archivo2 =$_FILES['file'.$i]["tmp_name"]['doc'];
                    $destino2 = $carpetEvidencia. $_FILES['file'.$i]['name']['doc'];
                    $docx_direcion = $destino2;
                    $this->moveFile($carpetaPrincipal,$archivo2,$destino2,$carpetEvidencia);
                }
                 if ($_FILES['file'.$i]['name']['xlsx'] != ''){
                    $archivo3 =$_FILES['file'.$i]["tmp_name"]['xlsx'];
                    $destino3 = $carpetEvidencia. $_FILES['file'.$i]['name']['xlsx'];
                    $xlsx_direccion= $destino3;
                    $this->moveFile($carpetaPrincipal,$archivo3,$destino3,$carpetEvidencia);
                    
                }   
                
                $file = [
                    'cod_evidencia' => $_POST['file'.$i]['cod_evidences'],
                    'pdf_archivo'=> $pdf_direcion,
                    'docx_archivo'=> $docx_direcion,
                    'xlxs_archivo' => $xlsx_direccion 
               ];
            }

            $this->evidencesTable->update($file);
            
        }
        header('location:/');
    }
    private function moveFile(string $directionArchivo, string $archivo, string $destino, string $carpetEvidencia)
    {
        if(file_exists($carpetEvidencia)){
            move_uploaded_file($archivo,$destino);    
    }else{
         mkdir($directionArchivo);
         mkdir($carpetEvidencia);                
        move_uploaded_file($archivo,$destino);
     }
    }
}
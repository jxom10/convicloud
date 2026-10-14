<?php

class mano_de_obra{

    public function grabar(){
        require_once('../connect.php');
        $this->referencia     =   $_GET['referencia'];
        $this->tecnico_id     =   $_GET['tecnico_id'];
        $this->descripcion    =   $_GET['descripcion'];
        $this->importe        =   $_GET['importe'];
        if ($_GET['id']){
            $this->id = $_GET['id'];
            $sql= "UPDATE mano_de_obra set `tecnico_id` = '$this->tecnico_id' , `descripcion`='$this->descripcion',`importe`='$this->importe' WHERE    `id`='$this->id'";
             if(!mysqli_query($con, $sql)){echo "error grabando".mysqli_error($con);}
             return $this->referencia ;
        }
        else{
            $sql="INSERT INTO mano_de_obra (`importe`,`descripcion`,`tecnico_id`,`parte_id`) VALUES('$this->importe','$this->descripcion','$this->tecnico_id','$this->referencia')";
            if(!mysqli_query($con, $sql)){echo "error grabando".mysqli_error($con);}
        }
      
    }
    
    public function cargar_todos($referencia){
        require_once('../connect.php');
        $sql="SELECT M.*,U.usuario FROM mano_de_obra M
                LEFT JOIN Usuarios U on
                U.codigo=M.tecnico_id
            WHERE parte_id='$referencia'";
        $resultado = mysqli_query($con,$sql);
        $salida=array();
        while($fila = mysqli_fetch_assoc($resultado)){
            array_push($salida,$fila);
            }
        echo json_encode($salida);
    }
    public function borrar($id){
        require_once('../connect.php');
        $sql="DELETE FROM mano_de_obra  WHERE id='$id'";
        mysqli_query($con,$sql);
       
       
    }
    public function calcular_total($referencia){
        require_once('../connect.php');
        $sql="SELECT SUM(importe) as total FROM mano_de_obra  WHERE parte_id='$referencia'";
        $result=mysqli_fetch_row(mysqli_query($con,$sql));
        $total= $result[0];
        $sql="UPDATE Partes set manoObra ='$total' WHERE codigo='$referencia'";
        if(!mysqli_query($con, $sql)){
            echo "error grabando".mysqli_error($con);
        }else{
            echo $total;
        }
 
    }

}
$MO = new mano_de_obra();
if ($_GET['action']=='cargar'){
    $parte_id=$_GET['referencia'];
    $MO->cargar_todos($parte_id);
}
elseif ($_GET['action']=='borrar'){
    $MO->borrar($_GET['id']);
}
elseif($_GET['action']=='grabar'){
    $parte_id=$MO->grabar($_GET);
    
    
}
elseif ($_GET['action']=='calcular'){
    $parte_id=$_GET['referencia'];
    $MO->calcular_total($parte_id);
}
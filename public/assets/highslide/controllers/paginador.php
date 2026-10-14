<?php

$tamanioPagina = ($_SESSION['config']['registrosPorPaginas']>1)?$_SESSION['config']['registrosPorPaginas']:50;

$_SESSION['pagina']=($_POST['pagina']=='siguiente')?$_SESSION['pagina']+1:$_SESSION['pagina']-1;
$_SESSION['pagina']=($_SESSION['pagina']<1 || !isset($_POST['pagina']))?1:$_SESSION['pagina'];
$pagina = ($_SESSION['pagina']=='')?'1':$_SESSION['pagina'];
$inicio = ($pagina - 1) * $tamanioPagina;






?>
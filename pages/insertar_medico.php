<?php
include("model/Medico.php");
include("model/TipoCita.php");
include("model/Medicos_x_tipoCita.php");
include("model/sala.php");


//Codigo para insertar medico y Medico_x_tipoCita

if (isset($_POST['txtNombre'])) {
	

try {
		$link= new Conexion();
		$conexion = $link->getConexion();
		mysqli_begin_transaction ( $conexion );
		
		$id= -1;
		$nombre =$_POST['txtNombre'];
		$apellido =$_POST['txtApellido'];
		$genero =$_POST['genero'];
		/*if ($_POST['genero'].checked == true || $_POST['genero'].checked == true) {
			
		}else{
			echo "Selecione el genero por favor";
		}*/
		
		$idUsuario =$_POST['usuario'];
		$idSala =$_POST['sala'];

		//validar


		
		$medicoA = new Medico($id,$nombre,$apellido,$genero,1,$idUsuario,$idSala);

		$medicoA->insertarMedico($link);
		
		$lastId = mysqli_insert_id( $conexion );
		$arregloCitas = $_POST ["listaTC"];
		
		//print_r ( $arregloTags );

		$resultActUsu= $medicoA->actualizarUsuario($link,$idUsuario);

		$sala = new Sala();
		$sala->actualizarEstadoSala($link,$idSala);
		
		foreach ( $arregloCitas as &$value ){
			$Medico_x_tipoCita = new  Medico_x_tipoCita();
			$resultMedico_Cita = $Medico_x_tipoCita->insertarMedico_x_tipoCita($link,$lastId,$value);
		}
		
		mysqli_commit ( $conexion );
		
	} catch ( Exception $e ) {
		mysqli_rollBack ( $conexion );
		echo "Failed: " . $e->getMessage ();
	}

	header("Location: system.php?page=listamedicos");	
	
}

//Codigo para obtener la lista de categorias que puede elegir un medico

$conexion = new Conexion();
$tipoC = new TipoCita();
$result = $tipoC->listarTipoCita($conexion);

//Codigo para obtener la lista de usuarios de las cuales podra elegir uno para asignarselo al  	   medico
$medico=new Medico();
$resultUsua=$medico->listarUsuariosDisponibles($conexion);

//Codigo para obtener la lista de slas de las cuales podra elegir una para asignarsela al  	   medico
$sala=new Sala();
$resultSala=$sala->listarSalas($conexion);

?>

<!--tutulo y formulario para ingresar un merico -->

<title>Ingresar medico</title>

<div class="container">
<div class="row">
  <div class="col-md-10">
    <div class="well">
		<div class="col-md-3"></div>
		<h2 class="page-header">Registre un nuevo doctor</h2>

	  <div class="card-content ">
		<form id="form1" class="form-horizontal" method="POST">
 <div id="mensaje"></div> 
			<div class="form-group">
				<label class="control-label col-xs-3">Nombre:</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre">
					<div id="nombreV"></div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Apellido:</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido">
					<div id="apellidoV"></div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Genero:</label>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio"  id="generoM" name="genero" value="M">Masculino
					</label>
				</div>
				<div class="col-xs-2">
					<label class="radio-inline">
						<input type="radio" id="generoF" name="genero" value="F">Femenino
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Elija un usuario:</label>
				<div class="col-xs-5">
					<select  name="usuario" id="usuario"  class="form-control" > 
					<option value="" selected >- - - - - - Elija un usuario - - - - - - -</option>
						<?php
							while($rowUsu = $conexion->getRecords($resultUsua)){ ?> 
								<option value="<?php echo $rowUsu['id_usuario'];?>"><?php echo $rowUsu['usuario'];?></option>
								<?php	} ?>
								
					</select>
				</div>

			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Elija una sala:</label>
				<div class="col-xs-5">
					<select  name="sala" id="sala"  class="form-control" > 
					<option value="" selected >- - - - - - Elija una sala - - - - - - -</option>
						<?php
							while($rowSala = $conexion->getRecords($resultSala)){ ?> 
								<option value="<?php echo $rowSala['id_sala'];?>"><?php echo $rowSala['nombre_sala'];?></option>
								<?php	} ?>
								
					</select>
				</div>

			</div>

			<!-- SELECTS LISTAS DE TIPO DE CITA -->

			<div class="row form-group ">

		   		<label class="control-label col-xs-3">Citas que atendera :</label>
			
				<div class="col-xs-3">
					<select id="listTCDisponible" name="listTCDisponible" class="form-control" multiple="multiple">
						<?php  while ($row =$conexion->getRecords($result)) { ?>
							
						<option value="<?php echo $row['id_tipo_cita']; ?>" ><?php echo $row['nombre_cita']; ?></option>

					<?php	} ?>
					</select>
				</div>
				<div class="col-xs-1 form-group">
				
					<div class="col-xs-1">
		                	<button id="btnAgregar" class="pasar izq"><span  class="glyphicon glyphicon-chevron-right"></span></button>
		                
		            </div><br/>
	            	
	            	<div class="col-xs-1">
		               		 <button id="btnQuitar" class="quitar der"><span class="glyphicon glyphicon-chevron-left"></span></button>
		            </div>
		            
            	</div>
			<!--divicion de tags 
			<label class="control-label col-xs-3">Tipo de medico :</label>-->
			
				
				<div class="col-xs-3 ">
					<select id="listaTC" name="listaTC[]" class="form-control" multiple="multiple">
						
					</select>
				</div>
			
		  </div>
			<div class="form-group">
				<div class="col-xs-offset-3 col-xs-1">
					<input type="submit" class="btn btn-primary " id="btnIngresar" name="btnIngresar" value="Registrar" >
				</div>
				<div class="col-xs-offset-3 col-xs-1">
				<!--<input type="button" name="btnCsncelar" class="btn btn-default" onclick="cancelarInsersion();"  value="Cancelar">-->
					<a href="system.php?page=listamedicos" class="btn btn-default ">Cancelar</a>
				</div>
			</div>
		</form>
	 </div>
	</div>
   </div>
</div>
</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="dist/jquery.validate.js"></script>
<script src="./js/jquery-3.2.1.min.js"></script>
<!-- Funciones de javascrips para validar el formulario -->
<script type="text/javascript">

var cancelarInsersion=function(){
	header("Location: system.php?page=listamedicos");
}

//formulario.addEventListener("button",cancelarInsersion);

///////////////////////////////

	var formulario = document.getElementById("form1");
	
	var validarNombre =function(e){
		if (formulario.txtNombre.value==0) {
			alert("Ingrese un nombre por favor");
			e.preventDefault();
		}
	};
	var validarApellido =function(e){
		if (formulario.txtApellido.value==0) {
			alert("Ingrese un apellido por favor");
			e.preventDefault();
		}
	};
	var validarGenero = function(e){
		if (formulario.genero[0].checked == true || formulario.genero[1].checked == true) {

		}else{
			alert("Selecione el genero por favor");
			e.preventDefault();
		}
	};
	

	var validarUsuario = function(e){
		indiceU = document.getElementById("usuario").selectedIndex;
		if (indiceU == null || indiceU==0) {

		alert("Elija un usuario por favor");
			e.preventDefault();
			
		} 
	};

	var validarSala = function(e){
		indiceS = document.getElementById("sala").selectedIndex;
		if (indiceS == null || indiceS==0) {

		alert("Elija una sala por favor");
			e.preventDefault();
			
		} 
	};

	var validarTipoCita = function(e){
		indiceTC = document.getElementById("listaTC").selectedIndex;
		if (indiceTC == -1) {

		alert("Asigne los tipos de citas que atendera por favor");
			e.preventDefault();
			
		} 
	};
	

	var validar = function(e){
		validarNombre(e);
		validarApellido(e);
		validarGenero(e);
		validarUsuario(e);
		validarSala(e);
		validarTipoCita(e);
	} ;
	
	formulario.addEventListener("submit",validar); 
	
	/*$(document).ready(function() {
    $("#ok").hide();

     $("#form1").validate({
        rules: {
            txtNombre: { required: true, minlength: 2},
            txtApellido: { required: true, minlength: 2},
            genero:{ required:checked, genero: checked},
            
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}
        },
        messages: {
            txtNombre: "Debe introducir un nombre.",
            txtApellido: "Debe introducir un apellido.",
           
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",
        },
        submitHandler: function(form){
            var dataString = 'txtNombre='+$('#txtNombre').val()+'&txtApellido='+$('#txtApellido').val()+'...';
            $.ajax({
                type: "POST",
                url:"op_validar_insert.php",
                data: dataString,
                success: function(data){
                    $("#ok").html(data);
                    $("#ok").show();
                    $("#formid").hide();
                }
            });
        }
    });
});*/

/*$(function(){
	$("#btn_ajax").click(function(){
		var url= "ajax.php";
		$.ajax({
			type:"POST",
			url: url,
			data: $("#form1").serialize(),
			success: function(data){
				$("#mensaje").html(data);
			}
		});
		return false;
	});
});*/

//////////////////////////////////////7
/*var resultado = document.getElementById("mensaje");

function validarInsercion(){

	var xmlHttp;
	if (window.XMLHttpRequest) {
		xmlHttp = new XMLHttpRequest();
	}else{
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var nombre = formulario.txtNombre.value;
	var apellido = formulario.txtApellido.value;
	var generoM = formulario.estado[0];
	var generoF = formulario.estado[1];

	var datos = "nombre="+nombre+"&apellido="+apellido+"&generoM="+generoM+"&generoF="+generoF;

	xmlHttp.onreadystatechange =function(){
		if (xmlHttp.readystate===4 && xmlHttp.status===200) {
			var msj = xmlHttp.responseText;
			resultado.innerHTML=msj;
		}
	}

	xmlHttp.open("POST","op_validar_inser.php",true);
	xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlHttp.send(datos);
}*/
//}
//}




//funciones del boton de select y submit

	$().ready(function(){
		$("#btnAgregar").click(function(){
			return !$('#listTCDisponible option:selected').remove().appendTo('#listaTC');  
		});

		$("#btnQuitar").click(function(){
			return !$('#listaTC option:selected').remove().appendTo('#listTCDisponible');  
		});

		$("#btnIngresar").click(function() { $('#listaTC option').prop('selected', 'selected'); });
	
	});
	

</script>


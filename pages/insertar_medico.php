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
		$idUsuario =$_POST['usuario'];
		$idSala =$_POST['sala'];
		
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
 <div id="ok"></div> 
			<div class="form-group">
				<label class="control-label col-xs-3">Nombre:</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-3">Apellido:</label>
				<div class="col-xs-5">
					<input type="text" class="form-control" id="txtApellido" name="txtApellido" placeholder="Apellido">
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
					<input type="submit" class="btn btn-primary " id="btnIngresar" name="btnIngresar" value="Registrar">
				</div>
				<div class="col-xs-offset-3 col-xs-1">
					<a href="system.php?page=listamedicos" class="btn btn-default btn-sm">Cancelar</a>
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

<!-- Funciones de javascrips para validar el formulario -->
<script type="text/javascript">

	var formulario = document.getElementById("form");
	
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
	var validarEstado = function(e){
		if (formulario.estado[0].checked == true|| formulario.estado[1].checked == true) {

		}else{
			alert("Asignele un estado por favor");
			e.preventDefault();
		}
	};

	var validarComboM = function(e){
		if (formulario.usuario[0] == 0) {

		}else{
			alert("Elija un doctor por favor");
			e.preventDefault();
		} 
	};


	
	var validar = function(e){
		validarNombre(e);
		validarGenero(e);
		validarEstado(e);
	} ;
	
	//formulario.addEventListener("submit",validar); 
	
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
                url:"op_enviarRegistro.php",
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


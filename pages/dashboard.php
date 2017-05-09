 <h2 class="page-header">Panel Principal</h2>
 <div id="resultado"></div>
 <div class="panel-body">
  <div class="tab-content">
   <div  class="tab-pane active">
    <!--Row-->
     <div class="row">
      <div class="col-lg-3 col-md-6 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                 <i class="fa fa-user-circle-o fa-4x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div>Administrar</div>
              </div>
            </div>
          </div>
          <a href="system.php?page=listar_usuarios">
            <div class="panel-footer">
              <span class="pull-left"  >Ir</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                 <i class="fa fa-medkit fa-4x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div>Enfermeria</div>
              </div>
            </div>
          </div>
          <a href="system.php?page=enfermeria">
            <div class="panel-footer">
              <span class="pull-left"  >Ir</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
        <div class="col-lg-3 col-md-6 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                 <i class="fa fa-user-md fa-4x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div>Medicos</div>
              </div>
            </div>
          </div>
          <a href="system.php?page=listar_medicos">
            <div class="panel-footer">
              <span class="pull-left"  >Ir</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                 <i class="fa fa-user-times fa-4x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div>Deshabilitar a todos los Paciente</div>
              </div>
            </div>
          </div>
          <a href="javascript:confirmacion();">
            <div class="panel-footer">
              <span class="pull-left" >Aceptar</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>
<script type="text/javascript">
  function confirmacion(){
    var confirmacion = confirm("Se eliminarán todos los pacientes ¿desea continuar?");
    if (confirmacion){
      $.ajax({url: "pages/dehabilitar_pacientes.php", success: function(result){
        $("#resultado").html(result);
    }});
    }
  }
  
</script>
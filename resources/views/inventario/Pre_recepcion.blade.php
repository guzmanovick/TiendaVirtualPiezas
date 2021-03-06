@extends('panel.menu')
@section('operaciones')
@include('modal')
<div id="Centro" style="font-size: 0.8em;">
	<div class="header">
    
  </div>
	<form  method="POST"  action="{{url('AddProductoRecepcion')}}" class="form-horizontal md-form" id="datosrecepcion" style="font-size: .85em;">
  @csrf

  
    <div class="card-header card">
        <h6>Recepción de productos</h6>
      </div>
    <div class="col-lg-12 card" style="background: white; padding: 20px; ">
        <div class="row" style="margin-bottom: 3px;">
            <div class="table-responsive">
                        
                    <table  class="table table-striped table-bordered" style="width:100%">
                    <thead id="cuerpo">
                        <tr>
                            <th>Fecha: <input type="date" class="form-control-sm" id="fecha" name="fecha" required></th>
                            <th>Proveedor: <input type="text" class="form-control-sm" id="proveedor" name="proveedor"  required> </th> 
                            <th>No. Documento: <input type="text" class="form-control-sm" id="documento" name="documento"  required> </th> 
                             <th>Almacen: <select class="form-control-sm" id="almacen" name="almacen" required>
                              <option value="" selected>...</option>
                              <option value="001">Almacen 1</option> 
                              <option value="002">Almacen 2</option>
                              <option value="003">Almacen 3</option>
                            </select></th>
                        </tr>
                    </thead>
              </table>                  
                
            </div>
         </div>  
         <div class="form-group row" style="margin-bottom: 3px; ">
                  <label class="col-lg-2 col-form-label text-right" for="codigo_fabricante">Código Producto:</label>
                  <div class="col-sm-3 input-group" >
                    <input type="text" class="form-control form-control-sm" id="codigo" name="codigo" required>
                    <div class="input-group-btn input-group-append">
                          <button  type="button" class="btn btn-info btn-sm"data-toggle="modal" data-target="#myModal" onclick="Modal('codificador.ObtenCodigoProducto','codigo','descr_producto')"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                  <label class="col-lg-6 col-form-label text-left" id="descr_producto" style="font-size: 1.2em; color:blue"></label>
        </div>

        
       <div class="form-group row"  style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-md-left text-lg-right" for="codigo">Cantidad:</label>
            <div class="col-sm-3">
              <input type="text" class="form-control form-control-sm" id="cantidad" name="cantidad"  required>
              <div class="col-sm-12" id="grupocodigo">  </div>
            </div>           
        </div>

        <div class="form-group row"  style="margin-bottom: 3px; ">
            <label class="col-lg-2 col-form-label text-md-left text-lg-right" for="codigo">Precio:</label>
            <div class="col-sm-3">
              <input type='number' step='0.01' placeholder='0.00' class="form-control form-control-sm" id="precio" name="precio" required>
              <div class="col-sm-12" id="grupocodigo">  </div>
            </div>
        </div>
        <div class="col-lg-10 text-md-left text-lg-right ">
            <button class="btn btn-success btn-sm" id="GuardarForm" type="submit">agregar <i class="fa fa-plus"></i></button>
        </div>
                             
        <div class="card" id="ListaPrerecepcion"  style="margin-top: 20px;">
 
        </div> 

      		  
    		  <div class="col-lg-10 text-md-left text-lg-right ">
  				  <button class="btn btn-success btn-sm" id="GuardarForm" type="submit">Recepcionar <i class="fa fa-save"></i></button>
    		  </div> 
    </div>
      
  </form>
</div>
 <script type="text/javascript">
   

   $data="vista=inventario.lista_prerecepcion&coleccion=Pre_recepcion";
   
  $.get('Resgistro', $data, function(subpage){ 
     $('#ListaPrerecepcion').html(subpage);

    }).fail(function() {
       console.log('Error en carga de Datos');
  });

$('body').on('blur', '#codigo', function()
    { 
      $data="indice=codigo&ocurrencia="+this.value+"&columnas=codigo,nombre&coleccion=Producto";
      $.get('Resgistro', $data, function(subpage){ 
            if (subpage[0]) {  $('#descr_producto').text(subpage[0]['nombre']);
                              $('#descr_producto').css('color','blue');  
                            }
                else { $('#descr_producto').text('CÓDIGO DESCONOCIDO');
                        $('#descr_producto').css('color','red');  
                        $('#codigo').focus();}

        }).fail(function() {
           console.log('Error en carga de Datos');
        });   
    });
  
  function borraItem(controlador, clase, condicion)
  {
      $data="_token={{ csrf_token()}}&clase="+clase+"&condicion="+condicion;
 
      $.post(controlador, $data, function(subpage){ 
            console.log(subpage);
      }).fail(function() {
           console.log('Error en carga de Datos');
      });
  }


  $('body').on( 'click', '.fa-trash-o', function () {  
                                                                            $tablaMarcas
                                                                                .row( $(this).parents('tr') )
                                                                                .remove()
                                                                                .draw();
                                                                            } );

 </script>
  }
@endsection
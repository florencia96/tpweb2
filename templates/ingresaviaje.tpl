{include file='templates/header.tpl'}
<div class="container d-flex justify-content-center">
    <div class="m-3 w-25">
           <h2>AGREGAR VIAJE</h2>
            <form class="form-alta" action="agregar-viaje" method="POST"> 
                <div class="col-auto mb-2">
                    <input placeholder="origen" type="text" name="origen" id="origen" required>
                </div>
                <div class="col-auto mb-2">
                   <input placeholder="destino" type="text" name="destino" id="destino" required>
                </div>
                <div class="col-auto mb-2">
                   <input placeholder="fecha" type="date" name="fecha" id="fecha" required>
                </div>
                <div class="col-auto mb-2">
                    <input placeholder="salida" type="time" name="salida" id="salida" required>
                </div>
                <div class="col-auto mb-2">
                    <input placeholder="llegada" type="time" name="llegada" id="llegada" required>
                </div>
                <div class="col-auto mb-2">
                    <input placeholder="precio" type="number" name="precio" id="precio" required>
                </div>
                <select class="custom-select mb-2 col-7" name="id_conductor">
                    {foreach $conductores as $conductor}
                       <option value="{$conductor->id_conductor}">{$conductor->nombre}</option>
                    {/foreach}
                </select>
                <br>
              {if $isAdmin} 
             <input type="submit" class="btn btn-primary">
             {/if} 
            </form>
    </div>

</div>
<a href="conductores" class="volver">VOLVER</a>
{include file="templates/footer.tpl"}
  
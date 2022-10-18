{include file='templates/header.tpl'}
                               {* AGREGAR CONDUCTOR *}
<div class="container d-flex justify-content-center">
    <div class="m-3 w-25">
        <h2>AGREGAR CONDUCTOR</h2>
        <form class="form-alta" action="agregar-conductor" method="post"> 
            <div class="col-auto mb-2">
                <input class="form-control" placeholder="Nombre.." type="text" name="nombre" id="nombre" >
            </div>
            <div class="col-auto mb-2">
                <input class="form-control" placeholder="vehiculo.." type="text" name="vehiculo" id="vehiculo" >
            </div>
        {if $isAdmin} 
        <input type="submit" class="btn btn-primary">
    {/if}
        </form>
        {* <p>{$aviso}</p> *}
    </div>
</div>
<p>{$aviso}</p>
<a href="conductores" class="volver">VOLVER</a>
{include file='templates/footer.tpl'}
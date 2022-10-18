{include file='templates/header.tpl'}



<a href="viajes" class="m-3"><button type="button" class="btn btn-success">Ver viajes</button></a>

 {* {if $isAdmin }  *}
    <a href="tablaconductores" class="m-3"><button type="button" class="btn btn-success">Editar conductores</button></a>
    <a href="tablaviajes" class="m-3"><button type="button" class="btn btn-success">Editar viajes</button></a>
{* {/if}  *}
{* {if $rol == "true"} *}
    <a href="panel" class="m-3"><button type="button" class="btn btn-danger">Administrador</button></a>
{* {/if} *}
<a href="logout" class="m-3"><button type="button" class="btn btn-danger">Log Out</button></a>

{* {if $rol == "true"} *}
    <a href="agregarconductor" class="m-3"><button type="button" class="btn btn-success">Agregar conductor</button></a>
    <a href="agregarviaje" class="m-3"><button type="button" class="btn btn-success">Agregar viaje</button></a>
{* {/if} *}

{* {if $logged == "false"} *}
    <a href="registro" class="m-3"><button type="button" class="btn btn-success">Registrarse</button></a>
    <a href="login" class="m-3"><button type="button" class="btn btn-warning">Log In</button></a>
{* {/if} *}


<div class="container w-75 d-flex flex-wrap my-2 mb-3">
    {foreach from=$conductores item=$conductor}
        <div class="conductor mx-auto">
            <a href="conductor/{str_replace(' ', '-', $conductor->nombre)}/{$conductor->id_conductor}">
                <p>{$conductor->nombre}</p>
            </a>
        </div>

    {/foreach}
</div>

{include file='templates/footer.tpl'}
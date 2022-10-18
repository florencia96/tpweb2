{include file='templates/header.tpl'}

<div class="container-fluid container d-flex justify-content-center">
<div class="w-25 mt-4 container-lg">
{if $mostrarTodo}
   
    <h1 class="display-5">{$nombre_conductor}</h1>
    
{else}
    <h1 class="display-5">Viajes</h1>
{/if}    
    <ul class="list-group">
        {foreach from=$viajes item=$viaje}
            <li class="list-group-item mb-4"><a href="detalle/{str_replace(' ', '-', $viaje->origen)|lower}/{$viaje->id_viaje}">{$viaje->origen}</a></li>
        {/foreach}
    </ul>
    </div>
</div>
<a href="conductores" class="volver">VOLVER</a>
{include file='templates/footer.tpl'}
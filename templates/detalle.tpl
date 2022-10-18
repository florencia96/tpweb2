{include file="templates/header.tpl"}

<div class="container mt-2">

    <ul class="list-group">
        <li class="list-group-item mb-3">Origen | {$viaje->origen}</li>
        <li class="list-group-item">Destino | {$viaje->destino}</li>
    </ul>
</div>
  <a href="conductor" class="volver">VOLVER</a>  
{include file="templates/footer.tpl"}
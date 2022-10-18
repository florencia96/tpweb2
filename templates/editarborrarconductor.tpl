{include file="templates/header.tpl"}

<div class="container-fluid w-100 d-flex justify-content-center">
    <div>
        <h1> EDITAR Y BORRAR CONDUCTORES</h1>
        <table class="my-4 table">
            <thead>

                <tr>
                    <th class="col">Conductor</th>
                    <th class="col">Vehiculo</th>
                    {if $isAdmin}
                        <th class="col"> BORRAR</th>
                        <th class="col">EDITAR</th>
                    {/if}


                </tr>

            </thead>

            <p class="lead">{$aviso}</p>
            {foreach from=$tablaConductores item=item}
                <form class="form-alta" action="editarconductor/{$item->id_conductor}" method="POST">

                    <tr>
                        <td><input class="form-control" type="text" name="nombre" value="{$item->nombre}"></td>
                        <td><input class="form-control" type="number" name="vehiculo" value="{$item->vehiculo}"></td>
                        {if $isAdmin}
                            <td><a class="btn btn-primary" id="borrar" href="borrarconductor/{$item->id_conductor}">borrar</a></td>
                            <td><button type="submit" class="btn btn-primary">editar</button></td>
                        {/if}
                </form>
                </tr>
            {/foreach}
        </table>
    </div>

</div>

<a href="conductores" class="volver">VOLVER</a>

{include file="templates/footer.tpl"}
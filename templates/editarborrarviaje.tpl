{include file="templates/header.tpl"}

<div class="container-fluid w-100 d-flex justify-content-center">
    <div>

        <h1> EDITAR Y BORRAR VIAJES</h1>
        <table class="my-4 table">
            <thead>

                <tr>


                    <th class="col">ORIGEN</th>
                    <th class="col">DESTINO</th>
                    <th class="col">FECHA</th>
                    <th class="col">SALIDA</th>
                    <th class="col">LLEGADA</th>
                    <th class="col">PRECIO</th>
                    <th class="col">CONDUCTOR</th>

                    {if $isAdmin}
                        <th class="col">borrar</th>
                        <th class="col">editar</th>
                    {/if}


                </tr>

            </thead>


            {foreach from=$tablaViajes item=item}
                <form class="form-alta" action="editarviaje/{$item->id_viaje}" method="POST">
                    <tr style=text-align:center>

                        <td><input class="form-control" type="text" name="origen" value="{$item->origen}"></td>
                        <td><input class="form-control" type="text" name="destino" value="{$item->destino}"></td>
                        <td><input class="form-control" type="text" name="fecha" value="{$item->fecha}"></td>
                        <td><input class="form-control" type="text" name="salida" value="{$item->salida}"></td>
                        <td><input class="form-control" type="text" name="llegada" value="{$item->llegada}"></td>
                        <td><input class="form-control" type="text" name="precio" value="{$item->precio}"></td>
                        <td><input class="form-control" type="number" name="id_conductor" value="{$item->id_conductor}"></td>
                        {if $isAdmin}
                            <td><a class="btn btn-primary" href="borrarviaje/{$item->id_viaje}">borrar</a></td>
                            <td><button type="submit" class="btn btn-primary">editar</button></td>
                        {/if}
                    </tr>
                </form>

            {/foreach}

        </table>

    </div>
</div>
<a href="conductores" class="volver">VOLVER</a>
{include file="templates/footer.tpl"}
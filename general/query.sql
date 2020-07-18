select
    `controlServicios`.clientes.primernombre,
    `controlServicios`.clientes.primerapelldio,
    `controlServicios`.clientes.direccion,
    `controlServicios`.zona.nombrezona,
    `controlServicios`.servicioscontratados.subtotal,
    `controlServicios`.servicioscontratados.detmesesporpagar,
    `controlServicios`.servicioscontratados.mesesnopagados
from
    `controlServicios`.zona
    inner join `controlServicios`.clientes on `controlServicios`.zona.nombrezona = `controlServicios`.clientes.nombrezona
    inner join `controlServicios`.servicioscontratados on `controlServicios`.clientes.idcliente = `controlServicios`.servicioscontratados.idcliente
where

case $P{nombreZona} when  '*'  then  true else `controlServicios`.clientes.nombrezona = $P{nombreZona} end

        `controlServicios`.clientes.nombrezona = any( case $P{nombreZona} when  '*'  then (select * from `controlServicios`.estado ) else $P{nombreZona} end )
    AND `controlServicios`.servicioscontratados.nombreestado = $P{estado}

    AND  year(`controlServicios`.cobros.fecha)  =  $P{fecha} 
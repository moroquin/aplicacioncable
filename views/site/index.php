<?php

/* @var $this yii\web\View */

$this->title = 'Cable e internet';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Bienvenido a la aplicaci&oacute;n</h1>

        <p class="lead">La aplicaci&oacute;n esta formada por los siguientes men&uacute;s.</p>
    </div>


    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>Men&uacute; de clientes</h2>
                <p><br />Ac&aacute; aparece un listado de todos los clientes que se encuentran registrados. All&iacute; se puede actualizar y consultar la informaci&oacute;n de cada cliente. El men&uacute; tiene un bot&oacute;n para crear un nuevo cliente.</p>
            </div>
            <p>&nbsp;</p>
            <div class="col-lg-12">
                <h2>Men&uacute; de Servicios</h2>
                <p><br />Este tiene dos divisiones importantes:</p>
                <ul>
                    <li>contratos de servicios: Esto se refiere a los contratos que clientes tienen con la empresa</li>
                    <li>Servicios prestados: ac&aacute; se muestran los servicios que la empresa provee, ya sea internet, cable, . . . .</li>
                </ul>
                <p>En el caso de los servicios contratados se encuentran las opciones de<br />Nuevo contrato: ac&aacute; se puede crear un nuevo contrato con un cliente ya existente o se puede crear un nuevo cliente al momento de ingresar el contrato.<br />Listado de contratos: muestra todos los contratos que hay en la base de datos, se puede revisar los contratos finalizados, los activos entre otros.</p>
            </div>
            <p>&nbsp;</p>
            <div class="col-lg-12">
                <h2>Men&uacute; de Cobros</h2>
                <p><br />Est&eacute; men&uacute; tiene las opciones para poder utilizar los cobros de los servicios.</p>
                <p>&nbsp;</p>
                <p>El funcionamiento de los cobros de contratos mensuales es el siguiente:</p>
                <ol>
                    <li>Cada nuevo mes aparecer&aacute; un bot&oacute;n para generar los cobros del periodo en curso. Esto crear&aacute; una casilla con pago 0 para cada cliente con contrato activo.</li>
                    <li>Despu&eacute;s de hacer esto se podr&aacute;n realizar los reportes para los cobradores de cada lugar.</li>
                    <li>Se podr&aacute;n ingresar por bloque los cobros realizados por una persona.</li>
                </ol>
                <p>&nbsp;</p>
                <p>Si se tiene un contrato nuevo se puede registrar un nuevo cobro en este mismo men&uacute;</p>
            </div>
        </div>

    </div>
</div>

        <div class="panel-heading">Identificación</div>
        <div class="panel-body">
            <div class="col-xs-4"><?= $form->field($model, 'correlativo')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-4"><?= $form->field($model, 'dpi')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-4"><?= $form->field($model, 'nit')->textInput(['maxlength' => true]) ?></div>
        </div>

        <div class="panel-heading">Nombres y apellidos</div>
        <div class="panel-body">
            <div class="col-xs-3"><?= $form->field($model, 'primernombre')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-3"><?= $form->field($model, 'segundonombre')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-3"><?= $form->field($model, 'primerapelldio')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-3"><?= $form->field($model, 'segundoapellido')->textInput(['maxlength' => true]) ?></div>
        </div>


        <div class="panel-heading">Contacto</div>
        <div class="panel-body">
            <div class="col-xs-12"><?= $form->field($model, 'direccion')->textarea(['rows' => 2]) ?></div>
            <div class="col-xs-4"><?= $form->field($model, 'telefono1')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-4"><?= $form->field($model, 'telefono2')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-12"><?= $form->field($model, 'referencias')->textarea(['rows' => 6]) ?></div>
        </div>

        <div class="panel-heading">Agrupación para cobradores</div>
        <div class="panel-body">
            <div class="col-xs-6">
                <?= $form->field($model, 'nombrezona')
                    ->widget(Select2::classname(), [
                        'data' =>  $zonas,
                        'options' => ['tag' => true, 'placeholder' => 'Seleccione la zona para agrupar al cliente'],
                        'pluginOptions' => ['allowClear' => true,],

                    ]) ?>
            </div>

            <div class="col-xs-6" id="agregarzona" style="display: none">
                <?= $form->field($zona, 'nombrezona')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
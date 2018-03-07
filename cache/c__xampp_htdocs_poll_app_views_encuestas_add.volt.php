<h3>Añadir nueva encuesta</h3>

<form action="<?= $this->url->get('encuestas/submit') ?>" method="POST" class="form-horizontal">
    <div class="form-group">
        <label for="titulo" class="col-sm-2 control-label">Título:</label>
        <div class="col-sm-10 col-md-9">
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required>
        </div>
    </div>
    <div class="form-group">
        <label for="fecha" class="col-sm-2 control-label">Fecha fin:</label>
        <div class="col-sm-10 col-md-9">
            <input type="datetime" class="form-control" id="fecha" name="fecha" 
                   placeholder="Fecha fin (Formato: DD/MM/AAAA hh:mm)" 
                   pattern="[0-9]{2}/[0-9]{2}/[0-9]{4} [0-9]{2}:[0-9]{2}" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="opcion1" class="col-sm-2 col-md-3 control-label">Opción 1:</label>
            <div class="col-sm-10 col-md-9">
                <input type="text" class="form-control" id="opcion1" name="opciones[]" placeholder="Texto...">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="opcion2" class="col-sm-2 col-md-3 control-label">Opción 2:</label>
            <div class="col-sm-10 col-md-9">
                <input type="text" class="form-control" id="opcion1" name="opciones[]" placeholder="Texto...">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="opcion3" class="col-sm-2 col-md-3 control-label">Opción 3:</label>
            <div class="col-sm-10 col-md-9">
                <input type="text" class="form-control" id="opcion3" name="opciones[]" placeholder="Texto...">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="opcion4" class="col-sm-2 col-md-3 control-label">Opción 4:</label>
            <div class="col-sm-10 col-md-9">
                <input type="text" class="form-control" id="opcion4" name="opciones[]" placeholder="Texto...">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="opcion5" class="col-sm-2 col-md-3 control-label">Opción 5:</label>
            <div class="col-sm-10 col-md-9">
                <input type="text" class="form-control" id="opcion5" name="opciones[]" placeholder="Texto...">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="opcion6" class="col-sm-2 col-md-3 control-label">Opción 6:</label>
            <div class="col-sm-10 col-md-9">
                <input type="text" class="form-control" id="opcion6" name="opciones[]" placeholder="Texto...">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="opcion7" class="col-sm-2 col-md-3 control-label">Opción 7:</label>
            <div class="col-sm-10 col-md-9">
                <input type="text" class="form-control" id="opcion7" name="opciones[]" placeholder="Texto...">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="opcion8" class="col-sm-2 col-md-3 control-label">Opción 8:</label>
            <div class="col-sm-10 col-md-9">
                <input type="text" class="form-control" id="opcion8" name="opciones[]" placeholder="Texto...">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-primary">Crear Encuesta</button>
          <a href="<?= $this->url->get('') ?>" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</form>

<?php if (isset($error)) { ?>
    <?php
        $this->flash->error($error);
     ?>
<?php } ?>

<h3><?= $encuesta->descripcion ?></h3>

<?php if (!isset($noPuedeVotar)) { ?>
<form action="<?= $this->url->get('encuestas/votar/' . $encuesta->id) ?>" method="POST">
<div class="form-group" data-toggle="buttons">
  
  <label class="btn btn-block btn-default active">
    <input type="radio" name="options" value="1" autocomplete="off" checked> Opción 1
  </label>
  <label class="btn btn-block btn-default">
    <input type="radio" name="options" value="2" autocomplete="off"> Opción 2
  </label>
  <label class="btn btn-block btn-default">
    <input type="radio" name="options" value="3" autocomplete="off"> Opción 3
  </label>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Votar</button>
    <a href="<?= $this->url->get('') ?>" class="btn btn-danger">Cancelar</a>
</div>
</form>

<?php } else { ?>






<h3>Resultados</h3>
<?php foreach (range(0, ($this->length($opciones)) - 1) as $i) { ?>
<div>Opción 1 </div>
<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="6" aria-valuemin="0" aria-valuemax="10" style="width: 60%;">
    6 votos
  </div>
</div>

<?php } ?>

<?php } ?>


<div>
    <a href="<?= $this->url->get('') ?>" class="btn btn-default">Volver</a>
</div>
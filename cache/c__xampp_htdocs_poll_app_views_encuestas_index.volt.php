<?php if (isset($exito)) { ?>
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Éxito!</strong> La encuesta se añadió correctamente!
</div>
<?php } ?>
<a href="<?= $this->url->get('encuestas/add') ?>" class="btn btn-primary">Nueva Encuesta</a>
<?php if ($this->length($inacabadas) != 0) { ?>
<h3>Encuestas activas </h3>
<div class="table-responsive" style="vertical-align: middle;">    
    <table class="table table-striped encuestas">
        <tr><th class="col-sm-8">Pregunta encuesta</th><th class="col-sm-3">Fecha fin</th><th></th><tr>
      <?php $numencuestas = ($this->length($inacabadas)) - 1; ?>
               <?php foreach (range(0, $numencuestas) as $i) { ?>
                <tr>
                  <td class="vmiddle"><?= $inacabadas[$i]->descripcion ?></td>
                  <td class="vmiddle"><?= $this->dateUtils->BD2DateUser($inacabadas[$i]->fecha_fin) ?></td>
                  <td><a href="<?= $this->url->get('encuestas/show/' . $inacabadas[$i]->id) ?>" class="btn btn-sm btn-primary">Votar</a></td>
                </tr>
                 <?php } ?>
    </table>
</div>
<?php } ?>
<?php if ($this->length($acabadas) != 0) { ?>
<h3>Encuestas finalizadas</h3>
<div class="table-responsive" style="vertical-align: middle;">    
    <table class="table table-striped encuestas">
        <tr><th class="col-sm-8">Pregunta encuesta</th><th class="col-sm-3">Fecha fin</th><th></th><tr>
        <?php $numencuestas = ($this->length($acabadas)) - 1; ?>
        <?php foreach (range(0, $numencuestas) as $i) { ?>
        <tr>
            <td><?= $acabadas[$i]->descripcion ?></td>
            <td><?= $this->dateUtils->BD2DateUser($acabadas[$i]->fecha_fin) ?></td>
            <td><a href="<?= $this->url->get('encuestas/show/' . $acabadas[$i]->id) ?>" class="btn btn-sm btn-success">Resultados</a></td>
        </tr>
        <?php } ?>
    </table>
</div>
<?php } ?>
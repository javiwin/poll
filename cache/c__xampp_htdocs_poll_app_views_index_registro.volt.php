<h3>Registrar nuevo usuario</h3>
<form action="<?= $this->url->get('index/submitRegistro') ?>" method="POST" class="form-horizontal">
   <div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nombre" name="nombre"
            placeholder="Nombre" required>
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" 
             placeholder="Email" required>
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Contraseña:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password"
             placeholder="Contraseña" required>
    </div>
  </div>
  <div class="form-group">
    <label for="password2" class="col-sm-2 control-label">Repetir:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password2" name="password2" 
             placeholder="Repetir contraseña" required>
    </div>
  </div>
  <div class="form-group">
    <label for="foto" class="col-sm-2 control-label">Foto:</label>
    <div class="col-sm-10">
        <input type="file" id="foto" name="foto">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Enviar datos</button>
      <a href="<?= $this->url->get('index/login') ?>" class="btn btn-danger">Cancelar</a>
    </div>
  </div>
</form>


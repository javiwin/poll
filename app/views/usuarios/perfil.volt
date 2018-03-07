<form action="{{ url('usuarios/updatePerfil') }}" method="POST" class="form-horizontal">
   <div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nombre" name="nombre"
             value="{{nombre}}" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" 
             value="{{correo}}" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">Contraseña:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
      <p class="help-block">Deje en blanco si no la quiere cambiar.</p>
    </div>
  </div>
  <div class="form-group">
    <label for="password2" class="col-sm-2 control-label">Repetir:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password2" name="password2" placeholder="Repetir contraseña">
      <p class="help-block">Deje en blanco si no la quiere cambiar.</p>
    </div>
  </div>
  <div class="form-group">
    <label for="foto" class="col-sm-2 control-label">Foto:</label>
    <div class="col-sm-10">
        <input type="file" id="foto" name="foto">
        <p class="help-block">Suba otra foto si la quiere cambiar</p>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Modificar datos</button>
    </div>
  </div>
</form>

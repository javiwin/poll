<h3>Entra a nuestro sitio</h3>
<form action="{{ url('index/submitLogin') }}" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">E-mail</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <div class="text-danger form-group">
      {% if error is defined %}
        {{error}}
      {% endif %}
  </div>
  <button type="submit" class="btn btn-primary">Entrar</button>
  <a href="{{ url('index/registro') }}" class="btn btn-default">Registrarse</a>
</form>


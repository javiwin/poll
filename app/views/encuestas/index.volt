{%if exito is defined %}
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Éxito!</strong> La encuesta se añadió correctamente!
</div>
{%endif%}
<a href="{{ url('encuestas/add') }}" class="btn btn-primary">Nueva Encuesta</a>
{% if inacabadas | length!=0 %}
<h3>Encuestas activas </h3>
<div class="table-responsive" style="vertical-align: middle;">    
    <table class="table table-striped encuestas">
        <tr><th class="col-sm-8">Pregunta encuesta</th><th class="col-sm-3">Fecha fin</th><th></th><tr>
      {% set numencuestas=(inacabadas|length) -1 %}
               {%  for i in 0..numencuestas %}
                <tr>
                  <td class="vmiddle">{{inacabadas[i].descripcion}}</td>
                  <td class="vmiddle">{{ dateUtils.BD2DateUser(inacabadas[i].fecha_fin)}}</td>
                  <td><a href="{{ url('encuestas/show/' ~ inacabadas[i].id) }}" class="btn btn-sm btn-primary">Votar</a></td>
                </tr>
                 {% endfor %}
    </table>
</div>
{%endif%}
{% if acabadas|length!=0 %}
<h3>Encuestas finalizadas</h3>
<div class="table-responsive" style="vertical-align: middle;">    
    <table class="table table-striped encuestas">
        <tr><th class="col-sm-8">Pregunta encuesta</th><th class="col-sm-3">Fecha fin</th><th></th><tr>
        {% set numencuestas=(acabadas|length) -1 %}
        {% for i in 0..numencuestas %}
        <tr>
            <td>{{acabadas[i].descripcion}}</td>
            <td>{{dateUtils.BD2DateUser(acabadas[i].fecha_fin)}}</td>
            <td><a href="{{ url('encuestas/show/' ~ acabadas[i].id) }}" class="btn btn-sm btn-success">Resultados</a></td>
        </tr>
        {% endfor %}
    </table>
</div>
{%endif%}
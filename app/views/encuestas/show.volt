<h3>{{ encuesta.descripcion}}</h3>

{%if noPuedeVotar is not defined %}
<form action="{{ url('encuestas/votar/' ~ encuesta.id) }}" method="POST">
<div class="form-group" data-toggle="buttons">
  {# La opción activa, si hay alguna, debe tener la clase active en el label y atributo checked en el input #}
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
    <a href="{{ url('') }}" class="btn btn-danger">Cancelar</a>
</div>
</form>

{% else %}
{# La opción con más votos debe de tener el 100% de la barra. El resto, un porcentaje relativo a esos votos. #}
{# width: X% indica el ancho que tendrá la barra. #}
{# en opciones me llegan todas las opciones de la encuesta #}
{# en votaciones me llegan cuantos voto (rowcount) tiene cada opcion #}
{#en votoMasAlto me llega eso, el voto mas alto#}

<h3>Resultados</h3>
{% for i in 0..(opciones|length)-1 %}
<div>Opción 1 </div>
<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="6" aria-valuemin="0" aria-valuemax="10" style="width: 60%;">
    6 votos
  </div>
</div>

{% endfor %}

{%endif%}


<div>
    <a href="{{ url('') }}" class="btn btn-default">Volver</a>
</div>
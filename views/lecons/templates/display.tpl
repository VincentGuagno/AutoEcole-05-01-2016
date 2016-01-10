{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Planning
{% endblock %}
	
{% block header %}
	Planning
{% endblock %}

{% block content %}
	<div>
		<h3>
			Leçons
		</h3>
		<form method="post" ACTION="/AutoEcole-05-01-2016/lecons/add">
		<button type="submit" > Ajout d'une leçon </button>
		</form>
		
		<table class="table">
			<tr>
				<th> Numéro de leçon </th>
				<th> Date de la leçon  </th>
				<th> Etat de la leçon </th>
				<th> Nom </th>
				<th> Prénom </th>
				<th> Surnom du moniteur </th>
			</tr>
		{% for lecon in lecons %}
			<tr>
				<td>{{lecon.PK_LECON}}</td>
				<td>{{lecon.DATE_LECON}}</td>
				<td>{{lecon.ETAT_LECON}}</td>
				<td>{{lecon.NOM}}</td>
				<td>{{lecon.PRENOM}}</td>
				<td>{{lecon.SURNOM}}</td>
				<td>
				<form method="post" ACTION="/AutoEcole-05-01-2016/lecons/delete/{{lecon.PK_LECON}}">
				<button type="submit" > Supprimer </button>
				</form>	
				</td>
				<td>				
				</td>
			</tr>
		{% endfor %}
		</table>
	</div>
	
	<div>
		<h3>
			Exams
		</h3>
		
		<form method="post" ACTION="/Cas-M-Ping/exams/add">
		<button type="submit" > Ajout d'un exams </button>
		</form>

		<table class="table">
			<tr>
				<th>Numéro de l'examen </th>
				<th>Nom de l'élève </th>
				<th>Prénom de l'élève </th>
				<th>Surnom du moniteur </th>
				<th>Nom de l'examen </th>
				<th>Date de l'examen</th>
				<th>Nom du permis</th>
			</tr>
		{% for exam in exams %}
			<tr>
				<td>{{exam.PK_EXAMEN}}</td>
				<td>{{exam.NOM}}</td>
				<td>{{exam.PRENOM}}</td>
				<td>{{exam.SURNOM}}</td>
				<td>{{exam.NOMEXAM}}</td>
				<td>{{exam.DATE_PASSAGE}}</td>
				<td>{{exam.NOMPERMIS}}</td>
				<td>
				<form method="post" ACTION="//AutoEcole-05-01-2016/exams/delete/{{exam.PK_EXAMEN}}">
				<button type="submit" > Supprimer </button>
				</form>	
				</td>
				<td>
				</td>
			</tr>
		{% endfor %}
		</table>
	</div>	
{% endblock %}
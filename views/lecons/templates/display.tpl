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
		<form method="post" ACTION="/Cas-M-Ping/lecons/add">
		<button type="submit" > Ajout d'une leçon </button>
		</form>

		<form method="post" ACTION="/Cas-M-Ping/lecons/delete/all">
		<button type="submit" > Suppression d'une leçon </button>
		</form>	
		
		<table class="table">
			<tr>
				<th>PK_LECON </th>
				<th>DATE_LECON </th>
				<th>ETAT_LECON </th>
				<th>ELEVE.NOM</th>
				<th>ELEVE.PRENOM</th>
				<th>MONITEUR.SURNOM</th>
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
				<form method="post" ACTION="/Cas-M-Ping/lecons/delete/{{lecon.loc_id}}">
				<button type="submit" > Supprimer </button>
				</form>	
				</td>
				<td>
				<form method="post" ACTION="/Cas-M-Ping/lecons/modify/{{lecon.loc_id}}">
				<button type="submit" > Modifier </button>
				</form>	
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

		<form method="post" ACTION="/Cas-M-Ping/exams/delete/all">
		<button type="submit" > Suppression d'un exams </button>
		</form>	
		
		<table class="table">
			<tr>
				<th>PK_EXAMEN </th>
				<th>ELEVE.NOM </th>
				<th>ELEVE.PRENOM </th>
				<th>MONITEUR.SURNOM</th>
				<th>EXAMEN.NOMEXAM</th>
				<th>EXAMEN.DATE_PASSAGE</th>
				<th>PERMIS.NOMPERMIS</th>
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
				<form method="post" ACTION="/Cas-M-Ping/exams/delete/{{exam.loc_id}}">
				<button type="submit" > Supprimer </button>
				</form>	
				</td>
				<td>
				<form method="post" ACTION="/Cas-M-Ping/exams/modify/{{exam.loc_id}}">
				<button type="submit" > Modifier </button>
				</form>	
				</td>
			</tr>
		{% endfor %}
		</table>
	</div>	
{% endblock %}
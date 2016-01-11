{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Ajout d'un élève
{% endblock %}

{% block title %}
Ajout d'un élève
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/AutoEcole-05-01-2016/students/add/confirm">

		<label for="FK_FORMULES">Formule : </label>
		<select id="FK_FORMULES" name="FK_FORMULES">
		{% for formula in formulas %}
		<option value="{{formula.PK_FORMULE}}">{{formula.LIBELLE}}</option>
		{% endfor %}
		</select> 
		</br></br>
		
		<label for="FK_MONITEUR">Secteur : </label>
		<select id="FK_MONITEUR" name="FK_MONITEUR">
		{% for instructor in instructors %}
		<option value="{{instructor.PK_MONITEUR}}">{{instructor.SURNOM}}</option>
		{% endfor %}
		</select> 
		</br></br>
		
		<label for="NOM">Nom : </label>
		<input class="form-control" id="NOM"name="NOM" >
		
		<label for="PRENOM">Prénom : </label>
		<input class="form-control" id="PRENOM" name="PRENOM" >
				
		<label for="ADRESSE">Adresse : </label>
		<input class="form-control" id="ADRESSE"name="ADRESSE" >
		
		<label for="DATE_NAISSANCE">Date de naissance : </label>
		<input class="form-control" id="DATE_NAISSANCE"name="DATE_NAISSANCE" >
		
		<label for="LIEU_ETUDE">Lieu d'étude : </label>
		<input class="form-control" id="LIEU_ETUDE"name="LIEU_ETUDE" >
		
		<label for="NUM_TEL">Téléphone : </label>
		<input class="form-control" id="NUM_TEL"name="NUM_TEL" >
		
		<button type="submit" class="btn btn-default">Ajouter</button>
	</form>
{% endblock %}


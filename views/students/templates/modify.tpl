{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
 Modification d'un moniteur
{% endblock %}

{% block title %}
 Modification d'un moniteur
{% endblock %}

{% block content %}
<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#DATE_NAISSANCE" ).datepicker();
  });
  </script>
</head>
	
	<form method="post" ACTION="/AutoEcole-05-01-2016/students/modify/confirm/{{student.PK_ELEVE}}">
		
		<label for="PRENOM">Prénom : </label>
		<input class="form-control" id="PRENOM" name="PRENOM" value="{{student.PRENOM}}" placeholder="{{student.PRENOM}}">
		
		<label for="NOM">Nom : </label>
		<input class="form-control" id="NOM" name="NOM" value="{{student.NOM}}" placeholder="{{student.NOM}}">
		
		<label for="ADRESSE">Adresse : </label>
		<input class="form-control" id="ADRESSE" name="ADRESSE" value="{{student.ADRESSE}}" placeholder="{{student.ADRESSE}}">
				
		<label for="NUM_TEL">Téléphone : </label>
		<input class="form-control" id="NUM_TEL" name="NUM_TEL" value="{{student.NUM_TEL}}" placeholder="{{student.NUM_TEL}}">
		
		<label for="LIEU_ETUDE">Lieu d'étude : </label>
		<input class="form-control" id="LIEU_ETUDE" name="LIEU_ETUDE" value="{{student.LIEU_ETUDE}}" placeholder="{{student.LIEU_ETUDE}}">

		<label for="DATE_NAISSANCE">Date de naissance :</label>
		<input class="form-control" id="DATE_NAISSANCE" name="DATE_NAISSANCE" value="{{student.DATE_NAISSANCE}}" placeholder="{{student.DATE_NAISSANCE}}">

		{% for formula in formulas %}
		<option value="{{formula.PK_FORMULE}}">{{formula.LIBELLE}}</option>
		{% endfor %}
		</select> 
		</br></br>
		
		<label for="FK_MONITEUR">Nom du moniteur : </label>
		<select id="FK_MONITEUR" name="FK_MONITEUR">
		{% for instructor in instructors %}
		<option value="{{instructor.PK_MONITEUR}}">{{instructor.SURNOM}}</option>
		{% endfor %}
		</select> 
		</br></br>
		
		<button type="submit" class="btn btn-default">Modifier l'élève'</button>
	</form>
{% endblock %}
	
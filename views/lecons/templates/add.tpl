{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Nouvelle leçon
{% endblock %}
	
{% block header %}
	Nouvelle leçon
{% endblock %}

{% block content %}

<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
   
   <script>
   jQuery(function()
		{
		//formattage de la date dans le format du la bdd       
		jQuery('#DATE_LECON').datepicker({ dateFormat: "dd/mm/yy"}).val();   
		}
	); 
  </script>
</head>
	

</br>
<form method="post" ACTION="/AutoEcole-05-01-2016/lecons/add/confirm">
		
		<label for="eleve_pk_eleve">Elève : </label>
		<select id="FK_STUDENT" name="FK_ELEVE">
		{% for student in students %}
		<option value="{{student.PK_ELEVE}}">{{student.NOM}} {{student.PRENOM}}</option>
		{% endfor %}
		</select> 
		</br></br>
		<label for="DATE_LECON">Date : </label>
		<input class="form-control" id="DATE_LECON"name="DATE_LECON" placeholder ="11-01-2016" >
		</br>
		
		<label for="ETAT_LECON">Etat de la leçon : </label>
		<input class="form-control" id="ETAT_LECON" name="ETAT_LECON" >
		</br>
		<button type="submit" class="btn btn-default">Ajouter la nouvelle leçon</button>
	</form>

{% endblock %}


	
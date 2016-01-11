{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Ajout d'un élève
{% endblock %}

{% block title %}
Ajout d'un élève
{% endblock %}

{% block content %}
	
	<script type="text/javascript">
	// code pour la gestion de la date dans le formulaire
	jQuery(function()
	{
	//formattage de la date dans le format du la bdd       
	jQuery('#dateEvenement').datepicker({ dateFormat: "dd/mm/yy"}).val();   
	}
	);
	</script>

	</br>

	<form method="post" ACTION="/AutoEcole-05-01-2016/students/add/confirm">

		<label for="FK_FORMULES">Formule : </label>
		<select id="FK_FORMULES" name="FK_FORMULES">
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
		
		<label for="NOM">Nom : </label>
		<input class="form-control" id="NOM"name="NOM" >
		</br>
		
		<label for="PRENOM">Prénom : </label>
		<input class="form-control" id="PRENOM" name="PRENOM" >
		</br>
				
		<label for="ADRESSE">Adresse : </label>
		<input class="form-control" id="ADRESSE"name="ADRESSE" >
		</br>
		
		<label for="DATE_NAISSANCE">Date de naissance : </label>
		<input class="form-control" id="DATE_NAISSANCE"name="DATE_NAISSANCE" >
		</br>

		<label for="LIEU_ETUDE">Lieu d'étude : </label>
		<input class="form-control" id="LIEU_ETUDE"name="LIEU_ETUDE" >
		</br>
		
		<label for="NUM_TEL">Téléphone : </label>
		<input class="form-control" id="NUM_TEL"name="NUM_TEL" >
		</br>
		
		<button type="submit" class="btn btn-default">Ajouter un élève</button>
	</form>
{% endblock %}


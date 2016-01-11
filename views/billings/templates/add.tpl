{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Facturation
{% endblock %}
	
{% block header %}
	
{% endblock %}

{% block content %}

	</br>
	
	<form method="post" ACTION="/AutoEcole-05-01-2016/billings/add/confirm">
		
		<strong>Date de facturation :</strong></br>
		<input class="form-control" type="text" id="DATE_FACTURE" name="DATE_FACTURE" value=""></br>
		<strong>Type de facturation : </strong></br>
		<select id="FK_TYPE_FACTURE" name="FK_TYPE_FACTURE">
		{% for billingType in billingTypes %}
		<option value="{{billingType.PK_TYPE_FACTURE}}">{{billingType.LIBELLE}}</option>
		{% endfor %}
		</select>
		</br></br>

		<strong>Nom de l'élève : </strong></br>
		<select id="FK_ELEVE" name="FK_ELEVE">
		{% for student in students %}
		<option value="{{student.PK_ELEVE}}">{{student.NOM}} {{student.PRENOM}}</option>
		{% endfor %}
		</select>
		</br></br>
		
		<label for="PRIX">Prix : </label>
		<input class="form-control" id="PRIX" name="PRIX" >
		</br>
		
		<label for="ETAT_FACTURE">Etat du paiement : </label>
		<input class="form-control" id="ETAT_FACTURE" name="ETAT_FACTURE" >
		</br>
		<button type="submit" class="btn btn-default">Ajouter la facturation</button>
	</form>
{% endblock %}
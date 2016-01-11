{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Modification de la facturation
{% endblock %}

{% block title %}
Modification de la facturation
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
		jQuery('#DATE_FACTURE').datepicker({ dateFormat: "dd/mm/yy"}).val();   
		}
	); 
  </script>
</head>

	</br>
	<form method="post" ACTION="/AutoEcole-05-01-2016/billings/modify/confirm/{{{billing.PK_FACTURATION}}">
		
		<strong>Date de facturation :</strong></br>
		<input class="form-control" type="text" id="DATE_FACTURE" name="DATE_FACTURE" value=""></br>
		<strong>Type de facturation : </strong></br>
		<select id="FK_TYPE_FACTURE" name="FK_TYPE_FACTURE">
		{% for billingType in billingTypes %}
		<option value="{{billingType.PK_TYPE_FACTURE}}" placeholder="{{billingType.LIBELLE}}">{{billingType.LIBELLE}}</option>
		{% endfor %}
		</select>
		</br></br>

		<strong>Nom de l'élève : </strong></br>
		<select id="FK_ELEVE" name="FK_ELEVE">
		{% for student in students %}
		<option value="{{student.PK_ELEVE}}" placeholder="{{student.NOM}} {{student.PRENOM}}">{{student.NOM}} {{student.PRENOM}}</option>
		{% endfor %}
		</select>
		</br></br>
		
		<label for="PRIX">Prix : </label>
		<input class="form-control" id="PRIX" name="PRIX" PRIX="{{billing.PRIX_ACHAT}}" placeholder="{{billing.PRIX_ACHAT}}">
		</br>
		
		<label for="ETAT_FACTURE">Etat du paiement : </label>
		<input class="form-control" id="ETAT_FACTURE" name="ETAT_FACTURE" ETAT_FACTURE="{{billing.PRIX_ACHAT}}" placeholder="{{billing.PRIX_ACHAT}}">
		</br>
		<button type="submit" class="btn btn-default">Modifier la facturation</button>
	</form>
	
{% endblock %}



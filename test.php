<?php
include ("lib/jpGraph/src/jpgraph.php");
include ("lib/jpGraph/src/jpgraph_line.php");
include('dao/factory/IDaoFactory.php');
include('model/User.php');
include('model/Model.php');
include('model/Product.php');
include('model/Sprint.php');
include('model/Task.php');
include('model/UserTask.php');



$tableauNombreExactly = array();
$tableauNombreEstimate = array();
$itteration = array();
$i = 1;
// *****************************************************
// Extraction des données dans la base de données
// **************************************************

$daoFactory = IDaoFactory::getInstance();
$modelDAO = $daoFactory->getModelDAO();

foreach ($modelDAO->getAllWithDependency() as $obj)
{
	array_push($tableauNombreEstimate, $obj->Task->EndTime);

	array_push($tableauNombreExactly, $obj->Task->TaskEffor);

	array_push($itteration, $i);
	$i++;
}


// **************************************
// Création du graphique
// *****************************************

// On spécifie la largeur et la hauteur du graph

// *********************
// Production de données
// *********************



// Initialiser le tableau à 0 pour chaques mois ***********************




// Contrôler les valeurs du tableau
// printf('<pre>%s</pre>', print_r($tableauVentes2006,1));

// ***********************
// Création du graphique
// ***********************

// Création du conteneur
$graph = new Graph(800,500);

// Fixer les marges
$graph->img->SetMargin(40,30,50,40);

// Lissage sur fond blanc (évite la pixellisation)
$graph->img->SetAntiAliasing("white");

// A détailler
$graph->SetScale("textlin");

// Ajouter une ombre
$graph->SetShadow();

// Ajouter le titre du graphique
$graph->title->Set("Graphique : gestion du temps");

// Afficher la grille de l'axe des ordonnées
$graph->ygrid->Show();
// Fixer la couleur de l'axe (bleu avec transparence : @0.7)
$graph->ygrid->SetColor('blue@0.7');
// Des tirets pour les lignes
$graph->ygrid->SetLineStyle('dashed');

// Afficher la grille de l'axe des abscisses
$graph->xgrid->Show();
// Fixer la couleur de l'axe (rouge avec transparence : @0.7)
$graph->xgrid->SetColor('red@0.7');
// Des tirets pour les lignes
$graph->xgrid->SetLineStyle('dashed');

// Apparence de la police
$graph->title->SetFont(FF_ARIAL,FS_BOLD,11);

// Créer une courbes
$courbe = createCourbe($tableauNombreEstimate);
$courbe1 = createCourbe($tableauNombreExactly);
// Paramétrage des axes
$graph->xaxis->title->Set("Ittération");
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetTickLabels($itteration);

// Ajouter la courbe au conteneur
$graph->Add($courbe);
$graph->Add($courbe1);

$graph->Stroke();


function createCourbe($array)
{
	$courbe = new LinePlot($array);

	// Afficher les valeurs pour chaque point
	$courbe->value->Show();

	// Valeurs: Apparence de la police
	$courbe->value->SetFont(FF_ARIAL,FS_NORMAL,9);
	$courbe->value->SetFormat('%d');
	$courbe->value->SetColor("red");

	// Chaque point de la courbe ****
	// Type de point
	$courbe->mark->SetType(MARK_FILLEDCIRCLE);
	// Couleur de remplissage
	$courbe->mark->SetFillColor("green");
	// Taille
	$courbe->mark->SetWidth(5);

	// Couleur de la courbe
	$courbe->SetColor("blue");
	$courbe->SetCenter();

	// Paramétrage des axes

	return $courbe;
}
?>
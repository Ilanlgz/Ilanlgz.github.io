

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - BRI 15 ans</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        .login-form { max-width: 400px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Administration - Soirée des 15ans de la BRI</h1>


    

        <?php
        // Afficher les résultats
        $fichier = 'reponses.txt';
        
        if(file_exists($fichier)) {
            $reponses = file($fichier, FILE_IGNORE_NEW_LINES);
            
            if(count($reponses) > 0) {
                $totalOui = 0;
                $totalPersonnes = 0;
                $totalFoodTruck = 0;
                
                echo '<div class="stats-box">';
                echo '<h3>Récapitulatif</h3>';
                
                echo '<table class="table table-bordered table-hover">';
                echo '<thead>';
                echo '<tr><th>Nom</th><th>Présence</th><th>Accompagnants</th><th>Total personnes</th><th>Option Food-Truck</th><th>Date réponse</th></tr>';
                echo '</thead>';
                echo '<tbody>';
                
                foreach($reponses as $ligne) {
                    $data = explode('|', $ligne);
                    
                    // Vérifier le format des données (compatibilité avec ancien format)
                    $nom = isset($data[0]) ? $data[0] : "Inconnu";
                    $reponse = isset($data[1]) ? $data[1] : "non";
                    $nombrePersonnes = isset($data[2]) ? (int)$data[2] : 0;
                    
                    // Récupérer l'option Food-Truck si disponible
                    $foodTruck = "non"; // Par défaut
                    if(isset($data[3]) && $data[3] === "oui") {
                        $foodTruck = "oui";
                    }
                    
                    // Timestamp (dernier élément)
                    $timestamp = end($data);
                    $date = date('d/m/Y H:i', (int)$timestamp);
                    
                    $total = ($reponse == 'oui') ? 1 + $nombrePersonnes : 0;
                    
                    if($reponse == 'oui') {
                        $totalOui++;
                        $totalPersonnes += $total;
                        
                        if($foodTruck == 'oui') {
                            $totalFoodTruck += $total;
                        }
                    }
                    
                    echo "<tr>";
                    echo "<td>$nom</td>";
                    echo "<td>" . ($reponse == 'oui' ? 'Présent' : 'Absent') . "</td>";
                    echo "<td>$nombrePersonnes</td>";
                    echo "<td>$total</td>";
                    echo "<td>" . ($foodTruck == 'oui' ? '<span class="food-yes">Oui</span>' : '<span class="food-no">Non</span>') . "</td>";
                    echo "<td>$date</td>";
                    echo "</tr>";
                }
                
                echo '</tbody>';
                echo '</table>';
                
                echo '<div class="row">';
                echo '<div class="col-md-4">';
                echo "<p><strong>Nombre de réponses positives : </strong> $totalOui</p>";
                echo '</div>';
                echo '<div class="col-md-4">';
                echo "<p><strong>Total participants : </strong> $totalPersonnes personnes</p>";
                echo '</div>';
                echo '<div class="col-md-4">';
                echo "<p><strong>Option Food-Truck : </strong> $totalFoodTruck personnes</p>";
                echo '</div>';
                echo '</div>';
                
                echo '</div>';
            } else {
                echo "<p>Aucune réponse enregistrée pour l'instant.</p>";
            }
        } else {
            echo "<p>Le fichier de réponses n'existe pas encore.</p>";
        }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
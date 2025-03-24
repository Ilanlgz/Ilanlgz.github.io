<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>BRI - 15 ans</title>
</head>
<body>
    <div class="container" id="main">
        <h1>Soirée des 15 ans de la BRI</h1>
        <h2>Réponses avant le 15 avril</h2>

        <div class="form-group">
            <form action="doc.php" method="post">
                <div class="form-group">
                    <label for="nom">Votre nom :</label>
                    <input type="text" name="nom" id="nom" class="form-control" required>
                </div>
                
                <div class="form-group">
                <h3>Serez-vous présent à la soirée ?</h3>
                    <div class="form-check">
                        <input type="radio" name="reponse" value="oui" id="oui" class="form-check-input" required>
                        <label for="oui" class="form-check-label">Oui</label>
                    </div>
                    
                    <div class="form-check">
                        <input type="radio" name="reponse" value="non" id="non" class="form-check-input">
                        <label for="non" class="form-check-label">Non</label>
                    </div>
                </div>
                
                <div class="form-group" id="nombrePersonnesDiv">
                    <label for="nombrePersonnes" id="label">Nombre de personnes qui vous accompagnent :</label>
                    <select name="nombrePersonnes" id="label" class="form-select">
                        <option value="0">0 (je viens seul)</option>
                        <option value="1">1 personne</option>
                        <option value="2">2 personnes</option>
                        <option value="3">3 personnes</option>
                        <option value="4">4 personnes</option>
                        <option value="5">5 personnes</option>
                        <option value="6">6 personnes</option>
                        <option value="7">7 personnes</option>
                        <option value="8">8 personnes</option>
                        <option value="9">9 personnes</option>
                        <option value="10">10 personnes</option>
                    </select>
                </div>

                <div class="form-group" id="nombrePersonnesDiv">
                    <label for="nombresPersonnesQuiMange" id="label">Prendre l'option Food-Truck à 15€ ?</label>
                        <select name="nombresPersonnesQuiMange" id="label" class="form-select">
                        <option value="oui">oui</option>
                        <option value="non">non</option>
                    </select>
                   
                </div>
                
                <div class="form-group">
                    <input type="submit" class="button" value="Envoyer ma réponse">
                </div>
            </form>
        </div>

        <?php
// Définir le nom du fichier pour stocker les réponses
$fichier = 'reponses.txt';

// Modification dans la partie traitement du formulaire
if(isset($_POST['reponse']) && isset($_POST['nom'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $reponse = $_POST['reponse'];
    $nombrePersonnes = ($reponse == 'oui' && isset($_POST['nombrePersonnes'])) ? (int)$_POST['nombrePersonnes'] : 0;
    $totalPersonnes = ($reponse == 'oui') ? 1 + $nombrePersonnes : 0;
    
    // Récupérer l'option Food-Truck
    $foodTruck = isset($_POST['nombresPersonnesQuiMange']) ? $_POST['nombresPersonnesQuiMange'] : 'non';
    
    // Format: nom|réponse|nombre personnes accompagnantes|food-truck|timestamp
    $ligne = $nom . '|' . $reponse . '|' . $nombrePersonnes . '|' . $foodTruck . '|' . time() . "\n";
    
    // Enregistrer la réponse
    file_put_contents($fichier, $ligne, FILE_APPEND);
    
    echo '<div class="confirmation">Merci ' . $nom . ' ! Votre réponse a été enregistrée.</div>';
}
?>
        
        <script>
            // Afficher/masquer le champ nombre de personnes selon la réponse
            document.querySelectorAll('input[name="reponse"]').forEach(function(elem) {
                elem.addEventListener('change', function() {
                    document.getElementById('nombrePersonnesDiv').style.display = 
                        (this.value === 'oui') ? 'block' : 'none';
                });
            });
        </script>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
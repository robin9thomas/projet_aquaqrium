<?php
require_once('config.php');

$bassin = new bassin();
$bassins = $bassin->load();
unset($bassin);


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Aquariums</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/22a694dfe1.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <h1 class="col-12 text-center px-5 pt-3">Gestion des Aquariums</h1>

    <form action="index.php" method="POST">
        <div class="col-12 d-flex flex-row space-evenly">
            <div class="col-4 p-5">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-fish-fins"></i></span>
                    <select aria-label="BassinId" aria-describedby="basic-addon1" name="bassinId" id="bassin" class="form-select" required>
                        <option value="0">Séléctionnez un bassin</option>
                        <?php foreach ($bassins as $bassin) : ?>
                            <option value="<?php echo $bassin['id_bassin']; ?>"><?php echo $bassin['Nom_bassin']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-4 p-5">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
                    <input type="date" class="form-control" placeholder="00/00/0000" aria-label="Date" aria-describedby="basic-addon1" name="Date">
                </div>
            </div>
            <div class="col-4 p-5 text-center">
                <button id="loadData" name="loadData" type="submit" class="btn btn-primary">Charger les données</button>
            </div>
        </div>
    </form>


    <?php
    if (isset($_POST['loadData'])) {

        $id = $_POST['bassinId'];
        $date = $_POST['Date'];
        
        
        if (!empty($id)) {
            $bassin = new bassin();
            $details_bassin = $bassin->getById($id);
            unset($bassin);

            $donnee = new donnee();
            $donnees = isset($date) ? $donnee->getData($id, $date) : $donnee->getDataById($id);
            unset($donnee);

            echo "  <h2 class='px-5 py-2'> 
                        " . $details_bassin['Nom_bassin'] . "
                    </h2>
            ";

            if (!empty($donnees)) {
    ?> <div id="chart" class="px-5 align-middle">
                    <table class="table text-center border">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Température</th>
                                <th scope="col">PH</th>
                                <th scope="col">Nitrate</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            foreach ($donnees as $donnee) {
                                $color_temp =($donnee["releve_temperature"] >= $details_bassin['valeur_min_temp'] && $donnee["releve_temperature"] <= $details_bassin['valeur_max_temp']) ? 'black' : 'red';
                                $color_ph =($donnee["releve_ph"] >= $details_bassin['valeur_min_ph'] && $donnee["releve_ph"] <= $details_bassin['valeur_max_ph']) ? 'black' : 'red';
                                $color_nitrate =($donnee["releve_nitrate"] >= $details_bassin['valeur_min_nitrate'] && $donnee["releve_nitrate"] <= $details_bassin['valeur_max_nitrate']) ? 'black' : 'red';

                               

                                $col = "
                            <tr>
                                <td>" . $donnee["created_at"] . "</td>
                                <td style='color :".$color_temp.";'>" . $donnee["releve_temperature"] . "°C</td>
                                <td style='color :".$color_ph.";'>" . $donnee["releve_ph"] . "pH</td>
                                <td style='color :".$color_nitrate.";'>" . $donnee["releve_nitrate"] . "mg/L</td>
                            </tr>
                            ";
                                echo $col;
                                unset($col);
                            }

                            ?>


                        </tbody>
                    </table>
                </div>
                
                    <div class="p-5 col-12 text-center">
                        <button id="exportCSV" name="exportCSV" class="btn btn-primary"><a class="text-light text-decoration-none" target="_blank" href="./exportCSV.php?id=<?php echo $id;?>&date=<?php echo $date;?>">Exporter en CSV</a></button>
                    </div>
                
        <?php
            } else {
                echo "<div class='col-12 p-5 text-center display-5'>
                        Aucune donnée à afficher.   
                    </div>";
            }
        } else {
            echo "<div class='col-12 p-5 text-center display-5'>
                   Vous devez séléctionner un bassin.   
                </div>";
        }
    } else {
        ?>
        <div class='col-12 p-5 text-center display-5'>
            Séléctionnez un bassin.
        </div>
    <?php
    }

    ?>





</body>

</html>
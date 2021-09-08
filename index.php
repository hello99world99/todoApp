
<?php require_once("traitement.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todo App</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <nav>
            <h1>My Todo App</h1>
            <button id="ajouter">Ajouter une tâche</button>
        </nav>
    </header>

    <div class="container-hidden">
        <form action="traitement.php" method="get">
            <input type="text" name="ajoutTodo" id="ajoutTodo" placeholder="Nom de la tâche" required>
            <select name="ajoutStatut" id="ajoutStatut">
                <option value="A faire">A faire</option>
                <option value="En cours...">En cours...</option>
                <option value="Terminer">Terminer</option>
            </select>
            <input type="submit" value="Ajouter">
        </form>
    </div>

    <div class="container">
        <table>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Statut</th>
                <th>Supression</th>
            </tr>
            <?php foreach ($connecteur->afficherTodo() as $ligne): ?>
                <tr>
                    <td><?php echo $ligne["id_todo"]; ?></td>
                    <td><?php echo $ligne["nom"]; ?></td>
                    <td>
                        <form id="form<?php echo $ligne["id_todo"]; ?>" class="radio" action="traitement.php" method="get">
                            <div>
                                <label for="faire<?php echo $ligne['id_todo']; ?>">A faire</label>
                                <input type="radio" name="etat" id="faire<?php echo $ligne['id_todo']; ?>" value="A faire" onclick="soumission('<?= $ligne["id_todo"]; ?>')" <?php if ($ligne['statut']=="A faire"){echo "checked"; } ?> />
                            </div>
                            <div>
                                <label for="cours<?php echo $ligne['id_todo']; ?>">En cours...</label>
                                <input type="radio" name="etat" id="cours<?php echo $ligne['id_todo']; ?>" value="En cours..." onclick="soumission('<?= $ligne["id_todo"]; ?>')" <?php if ($ligne['statut']=="En cours..."){echo "checked"; } ?> />
                            </div>
                            <div>
                                <label for="terminer<?php echo $ligne['id_todo']; ?>">Terminer</label>
                                <input type="radio" name="etat" id="terminer<?php echo $ligne['id_todo']; ?>" value="Terminer" onclick="soumission('<?= $ligne["id_todo"]; ?>')" <?php if ($ligne['statut']=="Terminer"){echo "checked"; } ?> />
                            </div>
                            <input type="hidden" name="statut" value="<?php echo $ligne['id_todo']; ?>">
                        </form>
                    </td>
                    <td>
                        <form action="traitement.php" method="get">
                            <input type="hidden" name="supression" value="<?php echo $ligne['id_todo']; ?>" />
                            <input class="btn-supr" type="submit" value="Suprimer">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <script src="index.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
</body>
</html>
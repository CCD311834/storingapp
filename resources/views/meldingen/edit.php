<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Aanpassen</title>
    <?php require_once '../components/head.php'; ?>
</head>

<body>
    <?php require_once '../components/header.php'; ?>
    <div class="container">
        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">
            <?php
                require_once '../../../config/conn.php';
                $id = $_GET['id'];
                $query = "SELECT * FROM meldingen  WHERE id = :id";
                $statement = $conn->prepare($query);
                $statement->execute([":id" => $id]);
                $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach($meldingen as $melding): ?>
                <h1>Melding #<?php echo $melding['id']; ?> aanpassen</h1>
                <div class="form-group">
                    <label for="attractie">Naam attractie:</label>
                    <?php echo $melding['attractie']; ?>
                </div>
                <div class="form-group">
                    <label for="type">Type:</label>
                    <?php echo $melding['type']; ?>
                </div>
                <div class="form-group">
                    <label for="capaciteit">Capaciteit p/uur:</label>
                    <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input" value="<?php echo $melding['capaciteit']; ?>">
                </div>
                <div class="form-group">
                    <label for="prioriteit">Prioriteit:</label>
                    <input type="checkbox" name="prioriteit" id="prioriteit" <?php if($melding['prioriteit']) echo 'checked'; ?>>
                </div>
                <div class="form-group">
                    <label for="melder">Naam melder:</label>
                    <input type="text" name="melder" id="melder" value="<?php echo $melding['melder']; ?>" class="form-input">
                </div>
                <div class="form-group">
                    <label for="overig">Overige info:</label>
                    <textarea name="overig" id="overig" class="form-input" rows="4"><?php echo $melding['overige_info']; ?></textarea>
                </div>
            <?php endforeach; ?>

            <input type="submit" value="Verstuur aanpassing">
            <input type="hidden" name="action" value="update">
        </form>
    </div>
</body>

</html>

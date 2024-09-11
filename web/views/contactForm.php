<link rel="stylesheet" href="../assets/css/style.css">
<form class="form-container" action="#" method="post">
    <div class="form-group-inline">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
    </div>
    <div class="form-group-inline">
        <div class="form-group">
            <label for="email">E-mail :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" required>
        </div>
    </div>
    <div class="form-group-inline">
        <div class="form-group">
            <label for="entreprise">Nom de l'entreprise :</label>
            <input type="text" id="entreprise" name="entreprise" required>
        </div>
        <div class="form-group">
            <label for="status">Statut dans l'entreprise :</label>
            <input type="text" id="status" name="status" required>
        </div>
    </div>
    <div class="form-group">
        <label for="commentaires">commentaires :</label>
        <input type="text" id="commentaires" name="commentaires" required>
    </div>
    <button type="button" onclick="window.location.href='./goodBye.php';">Envoyer</button>
</form>
</div>
<script type="text/javascript" src="/assets/js/script.js"></script>
<form action="../php/form-action/client.php" method="post">
  <h2>clients</h2>
  <p><input type="text" name="nom" placeholder="nom" required></p>
  <p><input type="tel" name="tel" placeholder="téléphone" pattern="^6\d{8}$" required></p>
  <p><input type="submit" value="enregistrer"></p>
</form>

<section class="form">
  <h2 class="text-center">Créez votre compte</h2>
  <input type="email" id="email" name="email" placeholder="prenom.nom@laplateforme.io">
  <input type="email" id="conf_email" name="conf_email" placeholder="Confirmer l'email">
  <input type="password" id="password" name="password" placeholder="Mot de passe">
  <input type="password" id="conf_password" name="conf_password" placeholder="Confirmer le mot de passe">  
  <aside class="my-1rem mx-auto" id="info_password">
    <p>Le mot de passe doit contenir au moins <b>8 caractères</b>, dont :</p>
    <ul>
        <li>1 Majuscule</li>
        <li>1 minuscule</li>
        <li>1 chiffre</li>
    </ul>
</aside>
<div class="acceptation mx-auto my-1rem">
  <input type="checkbox" id="consentement" name="consentement">
  <label for="consentement">Je m'engage à participer à l'évènement avec un cadeau d'une valeur minimum de 5€</label>
</div>
<p class="msg-erreur" id="erreur_insc"></p>
  <button class="clickable button m-1" id="valid_insc">Inscription</button>
  <p id="info_inscription" class="info_none"></p>
  <small class="text-center">Vous avez déjà un compte ? <i class="fas fa-arrow-right"></i> <span id="con_insc" class="hover-gold">Connectez-vous</span></small>
</section>



<script >var url = "ressources/JS/inscription.js";
$.getScript(url)</script>

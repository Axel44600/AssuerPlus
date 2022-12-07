<p>Bonjour <?= htmlspecialchars($pseudo) ?>,</p>

<p>pour disposer de votre compte sur AssuerPlus, il vous faut l'activer en cliquant sur <a href="./confirmation.php?token=<?= urlencode($token) ?>">ce lien</a>.</p>
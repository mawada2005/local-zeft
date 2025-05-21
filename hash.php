<?php
$plainPassword = 'queen=mawada;';
$hashed = password_hash($plainPassword, PASSWORD_DEFAULT);
echo "Hashed password: " . $hashed;
?>

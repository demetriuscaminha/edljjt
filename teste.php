<?php
$path = 'sites/default/files/php/twig/teste';
if (!file_exists($path)) {
    mkdir($path, 0777, true);
}
file_put_contents("$path/teste.txt", "OK");
echo "Criado com sucesso!";
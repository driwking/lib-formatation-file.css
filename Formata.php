<?php
include_once 'index.php';
// abrindo arquivo para formatar
$nameFile = "text.css"; // teu arquivo com a extensão 

$css_formated = "";
$arqv = file($nameFile);
@$pattKey = "/^[@]+[()a-z\W0-9]+[\W>*(a-z)0-9.:][(a-z)][\Wa-z)]({\r\n)$/i";
@$pattKey_02 = "/(}\r\n)$/i";
@$pattKey_03 = "/^(\r\n)$/i";

if (!is_dir("formatado")) {
    mkdir("formatado", 777); // cria pasta
}

if (!file_exists('formatado\\'.$nameFile)) {
    for ($i = 0; !empty($arqv[$i]); $i++) {
        if (preg_match($pattKey, $arqv[$i])) {
            $css_formated = $css_formated . str_replace("{\r\n", "{\n", $arqv[$i]);
            continue;
        }
        if (preg_match($pattKey_03, $arqv[$i])) {
            $css_formated = $css_formated . str_replace("\r\n", "", $arqv[$i]);
            continue;
        }
        $css_formated = $css_formated . str_replace("\n}\r\n", "}\n", str_replace("{\r\n", "{", str_replace(";\r\n", ";", str_replace(",\r\n", ",", str_replace("  ", "", $arqv[$i]))))); // retirando espaçoes e quebra de linhas
    }
}

$op = fopen("formatado/$nameFile", 'a'); // criar arquivo com a permissão "a"
fwrite($op, $css_formated); // escrevendo conteudo 
fclose($op); // fechando arquivo

// fomatado
$css_formated = "";
$file_fomart = file("formatado/$nameFile");


print('Tamanho do arquivo original: ' . get_size_file($nameFile));
print("\nTamanho do arquivo fomatado: " . get_size_file("formatado/$nameFile"));

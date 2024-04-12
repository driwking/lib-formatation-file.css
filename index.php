<?php

try{
$nameFile = "text.css";

$css_formated = "";
$arqv = file($nameFile);
for($i = 0; !empty($arqv[$i]); $i++){
    
    $css_formated = $css_formated . str_replace("\r\n","",str_replace(" ","",$arqv[$i])); // retirando espaçoes e quebra de linhas
    // $inicio = "/^[.#a-z]+[ { ]$/i";
    // $fim_atribute = "/(})$/";
    // if(preg_match($fim_atribute,$arr)){
    //     $arr = $arr . "\r\n";
    // }
}

mkdir("format",777);
$op = fopen("format/formated-$nameFile",'a'); // criar arquivo com a permissão "a"

fwrite($op, $css_formated); // escrevendo no arquivo
fclose($op);

$css_formated = "";
$file_fomart = file("format/formated-$nameFile");

for($i = 0; !empty($file_fomart[$i]); $i++){
    $css_formated = $css_formated . str_replace("}","}\n",$file_fomart[$i]); // retirando espaçoes e quebra de linhas
    // $inicio = "/^[.#a-z]+[ { ]$/i";
        // $fim_atribute = "/^[/*w ]+[w */]$/";
            // if(preg_match($fim_atribute,$css_formated)){
                $css_formated = $css_formated .  str_replace("*/","*/\n",$file_fomart[$i]);
                // continue;
            // }
}

$op = fopen("format/reverse-$nameFile.css",'a'); // criar arquivo com a permissão "a"

fwrite($op, $css_formated); // escrevendo no arquivo
fclose($op);

echo "|arquivos formatados com sucesso|";

}catch(Exception $e){
    echo $e->getMessage();
}
<?php
include_once 'get_size_file.php';

class Formatador
{
    public $name_file;
    public $file_origin;
    public $file_formated;

    private function size_file($name_file)
    {
        return get_size_file($name_file);
    }

    private function formatar($nome)
    {
        if (!is_dir("formatado")) {
            mkdir("formatado", 777); // cria pasta
        }

        $new_lines_file = "";
        $arqvOpen = file($nome);
        print_r($arqvOpen);

        @$pattKey = "/^[@]+[()a-z\W0-9]+[\W>*(a-z)0-9.:][(a-z)][\Wa-z)]({\r\n)$/i";
        // @$pattKey_02 = "/(}\r\n)$/i";
        @$pattKey_02 = "/^(\r\n)$/i";


        if (!file_exists('formatado\\'.$nome)) {
            for ($i = 0; !empty($arqvOpen[$i]); $i++) {
                if (preg_match($pattKey, $arqvOpen[$i])) {
                    $new_lines_file = $new_lines_file . str_replace("{\r\n", "{\n", $arqvOpen[$i]);
                    continue;
                }
                if (preg_match($pattKey_02, $arqvOpen[$i])) {
                    $new_lines_file = $new_lines_file . str_replace("\r\n", "", $arqvOpen[$i]);
                    continue;
                }
               $new_lines_file = $new_lines_file . str_replace("\n}\r\n", "}\n", str_replace("{\r\n", "{", str_replace(";\r\n", ";", str_replace(",\r\n", ",", str_replace("  ", "", $arqvOpen[$i]))))); // retirando espaçoes e quebra de linhas
            }
        }
        $this->file_formated = "formatado/$nome";
        $FileFormatedOpen = fopen($this->file_formated, 'a'); // criar arquivo com a permissão "a"
        fwrite($FileFormatedOpen, $new_lines_file); // escrevendo conteudo 
        fclose($FileFormatedOpen); // fechando arquivo
        return $this->file_formated;
        

    }

    public function envFIle($nome)
    {
        $this->name_file = $nome;

        $formatado = $this->formatar($nome);
        print($this->size_file($nome)."\n");
        print($this->size_file($formatado));
    }
}
$css = new Formatador();
$css->envFIle('text.css');

// // abrindo arquivo para formatar
// $nameFile = "text.css"; // teu arquivo com a extensão 

// $css_formated = "";
// $arqv = file($nameFile);
// @$pattKey = "/^[@]+[()a-z\W0-9]+[\W>*(a-z)0-9.:][(a-z)][\Wa-z)]({\r\n)$/i";
// @$pattKey_02 = "/(}\r\n)$/i";
// @$pattKey_03 = "/^(\r\n)$/i";

// if (!is_dir("formatado")) {
//     mkdir("formatado", 777); // cria pasta
// }

// if (!file_exists('formatado\\'.$nameFile)) {
//     for ($i = 0; !empty($arqv[$i]); $i++) {
//         if (preg_match($pattKey, $arqv[$i])) {
//             $css_formated = $css_formated . str_replace("{\r\n", "{\n", $arqv[$i]);
//             continue;
//         }
//         if (preg_match($pattKey_03, $arqv[$i])) {
//             $css_formated = $css_formated . str_replace("\r\n", "", $arqv[$i]);
//             continue;
//         }
//         $css_formated = $css_formated . str_replace("\n}\r\n", "}\n", str_replace("{\r\n", "{", str_replace(";\r\n", ";", str_replace(",\r\n", ",", str_replace("  ", "", $arqv[$i]))))); // retirando espaçoes e quebra de linhas
//     }
// }

// $op = fopen("formatado/$nameFile", 'a'); // criar arquivo com a permissão "a"
// fwrite($op, $css_formated); // escrevendo conteudo 
// fclose($op); // fechando arquivo

// // fomatado
// $css_formated = "";
// $file_fomart = file("formatado/$nameFile");


// print('Tamanho do arquivo original: ' . get_size_file($nameFile));
// print("\nTamanho do arquivo fomatado: " . get_size_file("formatado/$nameFile"));
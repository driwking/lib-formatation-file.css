<?php

function get_size_file($name_file, $decimals = 2) {
    $bytes = filesize($name_file);
    $size = 'BKMGTP';

    // pegando a letra do tamanho do arquivo
    $factor = floor((strlen($bytes) - 1) / 3);
    if(@$size[$factor] == 'B'){
        return sprintf("%.0f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }else{
    	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .'-'. @$size[$factor]."B";
    }
  }

// var_dump(get_size_file('text.css'));
<?php


function criptographic_encode($data)
{
    $dic = [
        'a' => 'r',
        'b' => 't',
        'c' => 'w',
        'd' => 'c',
        'e' => 'd',
        'f' => 's',
        'g' => 'v',
        'h' => 'x',
        'i' => 'k',
        'j' => '1',
        'k' => 'j',
        'l' => '5',
        'm' => '4',
        'n' => '3',
        'o' => 'b',
        'p' => '2',
        'q' => 'u',
        'r' => '7',
        's' => 'm',
        't' => '0',
        'u' => 'e',
        'v' => 'y',
        'w' => 'l',
        'x' => '8',
        'z' => 'q',
        'y' => 'f',
        '1' => '9',
        '2' => 'g',
        '3' => 'n',
        '4' => 'h',
        '5' => 'z',
        '6' => 'i',
        '7' => 'o',
        '8' => 'p',
        '9' => 'a',
        '0' => '6',
        '@' => '.',
        '.' => ',',
        ',' => '-',
        '-' => '@',
        '_' => '#',
        '!' => '?',
        '?' => '*',
        '*' => '&',
        '&' => '%',
        '%' => '$',
        '#' => '!'

    ];

    $num_caracteres = strlen($data);
    $newString = '';
    $newString2 = '';
    for ($c = 0; $c < $num_caracteres; $c++) {
        $newString .= $dic[strval($data[$c])];
    }
    $newString = strrev($newString);
    for ($c = 0; $c < $num_caracteres; $c++) {
        $newString2 .= $dic[strval($newString[$c])];
    }
    $newString2 = strrev($newString2);


    return $newString2;
}


function criptographic_dencode($data)
{
    $dicDec = [
        'r' => 'a',
        't' => 'b',
        'w' => 'c',
        'c' => 'd',
        'd' => 'e',
        's' => 'f',
        'v' => 'g',
        'x' => 'h',
        'k' => 'i',
        '1' => 'j',
        'j' => 'k',
        '5' => 'l',
        '4' => 'm',
        '3' => 'n',
        'b' => 'o',
        '2' => 'p',
        'u' => 'q',
        '7' => 'r',
        'm' => 's',
        '0' => 't',
        'e' => 'u',
        'y' => 'v',
        'l' => 'w',
        '8' => 'x',
        'q' => 'z',
        'f' => 'y',
        '9' => '1',
        'g' => '2',
        'n' => '3',
        'h' => '4',
        'z' => '5',
        'i' => '6',
        'o' => '7',
        'p' => '8',
        'a' => '9',
        '6' => '0',
        '.' => '@',
        ',' => '.',
        '-' => ',',
        '@' => '-',
        '#' => '_',
        '?' => '!',
        '*' => '?',
        '&' => '*',
        '%' => '&',
        '$' => '%',
        '!' => '#'
    ];


    $num_caracteres = strlen($data);
    $newString = '';
    $newString2 = '';
    for ($c = 0; $c < $num_caracteres; $c++) {
        $newString .= $dicDec[strval($data[$c])];
    }
    $newString = strrev($newString);
    for ($c = 0; $c < $num_caracteres; $c++) {
        $newString2 .= $dicDec[strval($newString[$c])];
    }
    $newString2 = strrev($newString2);

    return $newString2;

}
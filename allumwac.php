#!/usr/bin/env php
<?php

$red="\033[1;31m";
$gre="\033[1;32m";
$yel="\033[1;33m";
$blu="\033[1;34m";
$whi="\033[0;37m";

if (isset($argv[1]) && is_numeric($argv[1]) && abs($argv[1]) <= 30 && abs($argv[1]) >= 11) {
    
    function affichage($nbr_Allumettes)
    {      
        $yel = $GLOBALS['yel'];
        
        $allumettes = 0;
        
        echo PHP_EOL;
        
        while ($allumettes < $nbr_Allumettes) {
            echo $yel."| ";
            $allumettes++;
        }
        if($nbr_Allumettes >= 1) {
            echo $nbr_Allumettes;
        }
        echo PHP_EOL;
    }
    
    function regles($nbr_Allumettes)
    {
        $gre = $GLOBALS['gre'];
        echo $gre."\nVoici le jeu des allumettes.\nTu retire 1, 2, ou 3 allumettes quand c'est ton tour.\n\n";
        echo "L'IA en fait de meme.\nTu gagne si l'IA doit retirer la derniere !\n\n\n";
        
        affichage($nbr_Allumettes);
    }
    
    $nbr_Allumettes = intval(abs($argv[1]));
    regles($nbr_Allumettes);
    
    function jeu($argv)
    {
        $whi= $GLOBALS['whi'];
        $red= $GLOBALS['red'];
        
        $nbr_Allumettes = intval(abs($argv));
        $enlever = 0;
        
        while ($nbr_Allumettes > 1) {
            echo $whi."\nA toi".PHP_EOL;
            $line = 0;

            while (!is_numeric($line) || $line === 0 || $line > 3) {
                $line = intval(abs(trim(fgets(STDIN))));
            }

            $enlever = $line;
            $nbr_Allumettes -= $enlever;
            affichage($nbr_Allumettes);
            
            if ($nbr_Allumettes === 1) {
                echo PHP_EOL;
                echo $red.'That\'s luck ! :-('.PHP_EOL;
                
                echo  $whi.'Je veux ma revanche !'.PHP_EOL;
                
                echo 'Tu veux rejouer ? oui / non'.PHP_EOL;
                
                $line = null;
                
                while ($line === null) {
                    $line = trim(fgets(STDIN));
                }
                
                if (preg_match('/[Oo][Uu][Ii]/', $line)) {
                    $nbr_Allumettes = $argv;
                    affichage($nbr_Allumettes);
                    jeu($argv);
                } else {
                    break;
                }
            } elseif($nbr_Allumettes < 1) {

                echo PHP_EOL;
                echo $red.'Robots 1 humans 0 ! ;-)'.PHP_EOL;
                echo  $whi.'Tu veux rejouer ? oui / non'.PHP_EOL;
                
                $line = null;
                
                while ($line === null) {
                    $line = trim(fgets(STDIN));
                }
                
                if (preg_match('/[Oo][Uu][Ii]/', $line)) {
                    $nbr_Allumettes = $argv;
                    affichage($nbr_Allumettes);
                    jeu($argv);
                } else {
                    break;
                }
            }
            
            echo PHP_EOL;
            echo $whi.'IA'.PHP_EOL;
            
            switch ($nbr_Allumettes) {

                case $nbr_Allumettes >= 13:
                $IA = rand(1, 3);
                break;

                case 12:
                $IA = 3;
                break;

                case 11:
                $IA = 2;
                break;

                case 10:
                $IA = 1;
                break;
                
                case 9:
                $IA = rand(1, 3);
                break;
                
                case 8:
                $IA = 3;
                break;
                
                case 7:
                $IA = 2;
                break;
                
                case 6:
                $IA = 1;
                break;
                
                case 5:
                $IA = rand(1, 3);
                break;
                
                case 4:
                $IA = 3;
                break;
                
                case 3:
                $IA = 2;
                break;
                
                case 2:
                $IA = 1;
                break;
            }
            
            echo $IA.PHP_EOL;
            $enlever = $IA;
            $nbr_Allumettes -= $enlever;
            affichage($nbr_Allumettes);
            
            if ($nbr_Allumettes === 1) {
                echo PHP_EOL;
                echo $red.'Robots 1 humans 0 ! ;-)'.PHP_EOL;
                echo  $whi.'Tu veux rejouer ? oui / non'.PHP_EOL;
                
                $line = null;
                
                while ($line === null) {
                    $line = trim(fgets(STDIN));
                }
                
                if (preg_match('/[Oo][Uu][Ii]/', $line)) {
                    $nbr_Allumettes = $argv;
                    affichage($nbr_Allumettes);
                    jeu($argv);
                } else {
                    break;
                }
            }
        }
    }
    
    jeu($argv[1]);
} else {
    echo $red.'veillez entrer une valeur numerique inferieur 31 et supérieur à 10.'.PHP_EOL;
}

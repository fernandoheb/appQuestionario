<?php

    $indice = $string = "questao_12";
    
    $trim = strrpos($string,"_");

    echo (" strpos _ = $trim ");
    
    $str2 = substr($string,0,$trim);
    echo ( "$str2");  
                    try {
                        if (substr($indice,0,strpos($indice,"_")) == "questao" )
                                echo "<BR> true";
                                $questaoid = substr($indice,strpos($indice,"_")+1,strlen($indice));
                                echo "<br> $num";
                    } catch (Exception $e){}
                    




?>

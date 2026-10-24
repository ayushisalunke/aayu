<?php
    function factorial($n){
        if($n==0 || $n==1){
            return 1;
        }
        return $n * factorial($n-1);
    }
    $result=factorial(5);
    echo "5!".$result;
?>
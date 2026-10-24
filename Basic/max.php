<?php
    function findmax($num1,$num2,$num3)
    {
         return max($num1,$num2,$num3);
    }
    $num1=10;
    $num2=25;
    $num3=15;
     $maxnumber=findmax($num1,$num2,$num3);
    echo "the maximum no is:", $maxnumber;
 ?>
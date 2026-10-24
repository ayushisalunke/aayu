<?php
    $a=10;
    $b=5;
    echo "Arithmatic Operators:\n";
    echo "$a + $b:" .($a + $b)."\n";
    echo "$a - $b:" .($a - $b)."\n";
    echo "$a * $b:" .($a * $b)."\n";
    echo "$a / $b:" .($a / $b)."\n";
    echo "$a % $b:" .($a % $b)."\n";

    echo "Comparsion Operators:\n\n\n";
    echo "$a==$b:" .($a==$b ? "true":"false")."\n";
    echo "$a!=$b:" .($a!=$b ? "true":"false")."\n";
    echo "$a>$b:" .($a>$b ? "true":"false")."\n";
    echo "$a<$b:" .($a<$b ? "true":"false")."\n";
    echo "$a>=$b:" .($a>=$b ? "true":"false")."\n";
    echo "$a<=$b:" .($a<=$b ? "true":"false")."\n";

    echo "Logical Operators:\n\n\n";
    $x=true;
    $y=false;
    echo "X AND Y:" .($x==$y ? "true":"false")."\n";
    echo "X OR Y:" .($x==$y ? "true":"false")."\n";
    echo "NOT X:" .(!$x ? "true":"false")."\n";
?>
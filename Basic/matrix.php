<?php 
    $matrix =[[1,2],[3,4]];
    $matrix =[[5,6],[7,8]];
    function add matrices($mat1,$mat2){
        result[];
        for($i=0;$i<2;$i++){
            for($j=0;$j<2;$j++){
                $result[$i][$j]=$mat1[$i][$j]+$mat2[$i][$j];
            }
        }
        return $result;
    }
    $summatrix = add matrices($matrix,$matrix);

<?php
    function getGrade($percentage){
        if($percentage >= 90){
            return 'A+';
        }elseif($percentage >= 80){
            return 'A';
        }elseif ($percentage >= 70) {
            return 'B';
        }elseif ($percentage >= 60) {
            return 'C';
        }elseif($percentage >= 50){
            return 'D';
        }else{
            return 'F';
        }
    }

    //check if form is submitted
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $subjects=$_POST('subjets');
        $totalmarks =0;
        $maxmarks=count($subjects)*100;
        foreach($subjects as $marks){
            $totalmarks += intval($marks);
        }
        $percentage=($totalmarks/$maxmarks)*100;
        $grade=getGrade($percentage);
    }
?>
<html>
    <head>
        <title>Student Result Grade</title>
    </head>
    <body>
        <h2> Enter marks for each subject</h2>
        <form action="" method="$_POST">
            <label for="">Subject1:</label>
            <input type="number" name="subjects[]" min="0" max="100" required><br>
            <label for="">Subject2:</label>
            <input type="number" name="subjects[]" min="0" max="100" required><br>
            <label for="">Subject3:</label>
            <input type="number" name="subjects[]" min="0" max="100" required><br>
            <label for="">Subject4:</label>
            <input type="number" name="subjects[]" min="0" max="100" required><br>
            <label for="">Subject5:</label>
            <input type="number" name="subjects[]" min="0" max="100" required><br>
            <button type="submit">Calculate</button>
        </form>
        <?php if($_SERVER["REQUEST_METHOD"]=="POST"):?>
        <h3>Results</h3>
        <p> Total Marks:<?php echo $totalmarks;?> / <?php echo $maxmarks ?></p>
        <p>Percentage :<?php echo number_format($percentage,2);?>%</p>
        <p>Grade :<strong><?php echo $grade;?></strong></p>
        <?php endif;?>
        
    </body>
</html>
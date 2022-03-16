<?php
    require('session.php');
    checkLogin();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset=UTF-8" />
	
	<title>PHP Quiz</title>
	
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

	<div id="page-wrap">
        <div id="topnav">
            <?php include 'navbar.php';?>
        </div>

		<h1>Results</h1>
		
        <?php
            
            $answer1 = $_POST['question-1-answers'];
            $answer2 = $_POST['question-2-answers'];
            $answer3 = $_POST['question-3-answers'];
            $answer4 = $_POST['question-4-answers'];
            $answer5 = $_POST['question-5-answers'];
            $answer6 = $_POST['question-6-answers'];
        
            $results = [
                "Action" => 0, 
                "Adventure" => 0, 
                "Fantasy" => 0, 
                "Sci-Fi" => 0, 
                "Comedy" => 0, 
                "Romance" => 0, 
                "Drama" => 0, 
                "Mystery" => 0, 
                "Slice-Of-Life" => 0, 
                "Horror" => 0, 
                "Supernatural" => 0, 
                "Suspense" => 0

            ];

           
			
			switch ($answer1) {
                case "A":
                    $results["Adventure"] ++;
                    $results["Fantasy"] ++;
                    break;
                case "B":
                    $results["Adventure"] ++;
                    $results["Sci-Fi"] ++;
                    $results["Comedy"] ++;
                    break;
                case "C":
                    $results["Action"] ++;
                    $results["Comedy"] ++;
                    break;
                case "D":
                    $results["Comedy"] ++;
                    $results["Romance"] ++;
                    break;
                case "E":
                    $results["Action"] ++;
                    $results["Fantasy"] ++;
                    $results["Drama"] ++;
                    break;
                case "F":
                    $results["Comedy"] ++;
                    break;
                case "G":
                    $results["Action"] ++;
                    $results["Adventure"] ++;
                    $results["Comedy"] ++;
                    $results["Fantasy"] ++;
                    break;
                case "H":
                    $results["Comedy"] ++;
                    $results["Romance"] ++;
                    break;
                
                
            }
            switch ($answer2) {
                case "A":
                    $results["Romance"] ++;
                    $results["Adventure"] ++;
                    break;
                case "B":
                    $results["Fantasy"] ++;
                    $results["Mystery"] ++;
                    break;
                case "C":
                    $results["Action"] ++;
                    $results["Adventure"] ++;
                    break;
                case "D":
                    $results["Romance"] ++;
                    $results["Comedy"] ++;
                    break;
                case "E":
                    $results["Comedy"] ++;
                    $results["Slice-Of-Life"] ++;
                    break;
                case "F":
                    $results["Romance"] ++;
                    $results["Drama"] ++;
                    break;
                case "G":
                    $results["Adventure"] ++;
                    $results["Mystery"] ++;
                    break;
                case "H":
                    $results["Comedy"] ++;
                    $results["Action"] ++;
                    $results["Adventure"] ++;
                    break;
                case "I":
                    $results["Horror"] ++;
                    $results["Supernatural"] ++;
                    $results["Suspense"] ++;
                    break;
                
                
            }
            switch ($answer3) {
                case "A":
                    $results["Fantasy"] ++;
                    $results["Sci-Fi"] ++;
                    break;
                case "B":
                    $results["Romance"] ++;
                    $results["Slice-Of-Life"] ++;
                    break;
                case "C":
                    $results["Mystery"] ++;
                    $results["Adventure"] ++;
                    break;
                case "D":
                    $results["Horror"] ++;
                    $results["Supernatural"] ++;
                    break;
                case "E":
                    $results["Romance"] ++;
                    $results["Suspense"] ++;
                    break;
                case "F":
                    $results["Slice-Of-Life"] ++;
                    $results["Comedy"] ++;
                    break;
                case "G":
                    $results["Mystery"] ++;
                    $results["Adventure"] ++;
                    break;
                case "H":
                    $results["Slice-Of-Life"] ++;
                    $results["Fantasy"] ++;
                    break;
                case "I":
                    $results["Action"] ++;
                    $results["Adventure"] ++;
                    $results["Slice-Of-Life"] ++;
                    break;
                
                
            }
            switch ($answer4) {
                case "A":
                    $results["Romance"] ++;
                    $results["Sci-Fi"] ++;
                    break;
                case "B":
                    $results["Slice-Of-Life"] ++;
                    $results["Adventure"] ++;
                    break;
                case "C":
                    $results["Romance"] ++;
                    $results["Drama"] ++;
                    $results["Comedy"] ++;
                    break;
                case "D":
                    $results["Mystery"] ++;
                    $results["Horror"] ++;
                    $results["Suspense"] ++;
                    break;
                case "E":
                    $results["Sci-Fi"] ++;
                    $results["Adventure"] ++;
                    break;
                case "F":
                    $results["Slice-Of-Life"] ++;
                    $results["Fantasy"] ++;
                    break;
                case "G":
                    $results["Action"] ++;
                    $results["Slice-Of-Life"] ++;
                    break;
                case "H":
                    $results["Action"] ++;
                    $results["Adventure"] ++;
                    break;
                case "I":
                    $results["Romance"] ++;
                    $results["Drama"]++;
                    break;
                
                

            }
            switch ($answer5) {
                case "A":
                    $results["Comedy"] ++;
                    $results["Mystery"] ++;
                    break;
                case "B":
                    $results["Adventure"] ++;
                    $results["Fantasy"] ++;
                    break;
                case "C":
                    $results["Adventure"] ++;
                    $results["Action"] ++;
                    break;
                case "D":
                    $results["Action"] ++;
                    $results["Drama"] ++;
                    break;
                case "E":
                    $results["Action"] ++;
                    $results["Adventure"] ++;
                    break;
                case "F":
                    $results["Sci-Fi"] ++;
                    $results["Suspense"] ++;
                    break;
                case "G":
                    $results["Sci-Fi"] ++;
                    $results["Supernatural"] ++;
                    break;
                case "H":
                    $results["Drama"] ++;
                    $results["Romance"] ++;
                    break;
                case "I":
                    $results["Action"] ++;
                    $results["Horror"] ++;
                    break;
                case "J":
                    $results["Slice-Of-Life"] ++;
                    $results["Suspense"] ++;
                    break;
                
                
            }
            switch ($answer6) {
                case "A":
                    $results["Action"] ++;
                    $results["Adventure"] ++;
                    break;
                case "B":
                    $results["Drama"] ++;
                    $results["Fantasy"] ++;
                    break;
                case "C":
                    $results["Romance"] ++;
                    $results["Drama"] ++;
                    break;
                case "D":
                    $results["Horror"] ++;
                    $results["Supernatural"] ++;
                    break;
                case "E":
                    $results["Sci-Fi"] ++;
                    $results["Slice-Of-Life"] ++;
                    break;
                case "F":
                    $results["Romance"] ++;
                    $results["Comedy"] ++;
                    break;
                case "G":
                    $results["Sci-Fi"] ++;
                    $results["Mystery"] ++;
                    break;
                case "H":
                    $results["Action"] ++;
                    $results["Adventure"] ++;
                    break;
                
                
                
            }

            

            //Get the top genres and the second highest
            //(ties will be printed out together)
            

            $max = -1;
            $secondMax = -1;
    
            //Traverse an array
            foreach($results as $value) {
        
                //If it's greater than the value of max
                if($value > $max) {
            
                    $secondMax = $max;
                    $max = $value;
                }
        
                //If array number is greater than secondMax and less than max
                if($value > $secondMax && $value < $max) {
                    $secondMax = $value;
                }
            }

            $maxValKeys = array_keys($results, $max);
            $secondMaxValKeys = array_keys($results, $secondMax);

            


            
            
            
            
        ?>
        <p>Your Top Genres: <?php echo implode(", ", $maxValKeys); ?></p>
        <p>Your Second Top Genres: <?php echo implode(", ", $secondMaxValKeys); ?></p>
	</div>

</body>

</html>
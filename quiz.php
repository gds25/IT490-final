<?php
    require('session.php');
    checkLogin();
?>

<!DOCTYPE html>
<head>
	<meta charset=UTF-8" />
	
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

	<div id="page-wrap">
        <div id="topnav">
            <?php include 'navbar.php';?>
        </div>

		<h1>What is Your Anime Genre</h1>
		
		<form action="result.php" method="post" id="quiz">
		
            <ol>
            
                <li>
                
                    <h3>What was your First Anime?</h3>
                    
                    <div>
                        <input type="radio" name="question-1-answers" id="question-1-answers-A" value="A" required/>
                        <label for="question-1-answers-A">Naruto</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-1-answers" id="question-1-answers-B" value="B" />
                        <label for="question-1-answers-B">My Hero Academia</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-1-answers" id="question-1-answers-C" value="C" />
                        <label for="question-1-answers-C">One Punch Man</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-1-answers" id="question-1-answers-D" value="D" />
                        <label for="question-1-answers-D">Yuri! On Ice</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-1-answers" id="question-1-answers-E" value="E" />
                        <label for="question-1-answers-E">Attack on Titan</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-1-answers" id="question-1-answers-F" value="F" />
                        <label for="question-1-answers-F">Haikyuu</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-1-answers" id="question-1-answers-G" value="G" />
                        <label for="question-1-answers-G">Dragon Ball Z</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-1-answers" id="question-1-answers-H" value="H" />
                        <label for="question-1-answers-H">Host Club</label>
                    </div>
                
                </li>
                
                <li>
                
                    <h3>Favorite Ice Cream Flavor</h3>
                    
                    <div>
                        <input type="radio" name="question-2-answers" id="question-2-answers-A" value="A" required/>
                        <label for="question-2-answers-A">Coffee</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-2-answers" id="question-2-answers-B" value="B" />
                        <label for="question-2-answers-B">Cookies & Cream</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-2-answers" id="question-2-answers-C" value="C" />
                        <label for="question-2-answers-C">Vanilla</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-2-answers" id="question-2-answers-D" value="D" />
                        <label for="question-2-answers-D">Cheesecake</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-2-answers" id="question-2-answers-E" value="E" />
                        <label for="question-2-answers-E">Strawberry</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-2-answers" id="question-2-answers-F" value="F" />
                        <label for="question-2-answers-F">Green Tea</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-2-answers" id="question-2-answers-G" value="G" />
                        <label for="question-2-answers-G">Chocolate</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-2-answers" id="question-2-answers-H" value="H" />
                        <label for="question-2-answers-H">Cookie Dough</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-2-answers" id="question-2-answers-I" value="I" />
                        <label for="question-2-answers-I">I Dont Like Ice Cream</label>
                    </div>
                
                </li>
                
                <li>
                
                    <h3>Your Favorite Time of Day</h3>
                    
                    <div>
                        <input type="radio" name="question-3-answers" id="question-3-answers-A" value="A" required/>
                        <label for="question-3-answers-A">Early Dusk</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-3-answers" id="question-3-answers-B" value="B" />
                        <label for="question-3-answers-B">Early Morning</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-3-answers" id="question-3-answers-C" value="C" />
                        <label for="question-3-answers-C">That time from Dinner to when you go to Bed</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-3-answers" id="question-3-answers-D" value="D" />
                        <label for="question-3-answers-D">Drifting to sleep</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-3-answers" id="question-3-answers-E" value="E" />
                        <label for="question-3-answers-E">Noon</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-3-answers" id="question-3-answers-F" value="F" />
                        <label for="question-3-answers-F">When your alarm goes off</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-3-answers" id="question-3-answers-G" value="G" />
                        <label for="question-3-answers-G">3 AM</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-3-answers" id="question-3-answers-H" value="H" />
                        <label for="question-3-answers-H">After your last class</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-3-answers" id="question-3-answers-I" value="I" />
                        <label for="question-3-answers-I">9:37 am after you had two cups of coffee</label>
                    </div>
                
                </li>
                
                <li>
                
                    <h3>Favorite Color</h3>
                    
                    <div>
                        <input type="radio" name="question-4-answers" id="question-4-answers-A" value="A" required/>
                        <label for="question-4-answers-A">Navy</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-4-answers" id="question-4-answers-B" value="B" />
                        <label for="question-4-answers-B">Off-White</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-4-answers" id="question-4-answers-C" value="C" />
                        <label for="question-4-answers-C">Anything Neon</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-4-answers" id="question-4-answers-D" value="D" />
                        <label for="question-4-answers-D">Black</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-4-answers" id="question-4-answers-E" value="E" />
                        <label for="question-4-answers-E">Cyan</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-4-answers" id="question-4-answers-F" value="=F" />
                        <label for="question-4-answers-F">Orange</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-4-answers" id="question-4-answers-G" value="G" />
                        <label for="question-4-answers-G">Lavender</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-4-answers" id="question-4-answers-H" value="H" />
                        <label for="question-4-answers-H">Golden Rod</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-4-answers" id="question-4-answers-I" value="I" />
                        <label for="question-4-answers-I">Rainbow/Can't Decide</label>
                    </div>
                
                </li>
                
                <li>
                
                    <h3>Pick a Super-Power</h3>
                    
                    <div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-A" value="A" required/>
                        <label for="question-5-answers-A">Invisability</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-B" value="B" />
                        <label for="question-5-answers-B">X-Ray</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-C" value="C" />
                        <label for="question-5-answers-C">Flying</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-D" value="D" />
                        <label for="question-5-answers-D">Psychic</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-E" value="E" />
                        <label for="question-5-answers-E">Time Control</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-F" value="F" />
                        <label for="question-5-answers-F">Speed</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-G" value="G" />
                        <label for="question-5-answers-G">Time Travel</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-H" value="H" />
                        <label for="question-5-answers-H">Mind Reading</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-I" value="I" />
                        <label for="question-5-answers-I">Strength</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-5-answers" id="question-5-answers-J" value="J" />
                        <label for="question-5-answers-J">Healing</label>
                    </div>
                    
                  
                
                </li>
				
				<li>
                
                    <h3>Pick a Number</h3>
                    
                    <div>
                        <input type="radio" name="question-6-answers" id="question-6-answers-A" value="A" required/>
                        <label for="question-6-answers-A">420 - HAHA Weed Number</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-6-answers" id="question-6-answers-B" value="B" />
                        <label for="question-6-answers-B">12.463</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-6-answers" id="question-6-answers-C" value="C" />
                        <label for="question-6-answers-C">0</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-6-answers" id="question-6-answers-D" value="D" />
                        <label for="question-6-answers-D">666</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-6-answers" id="question-6-answers-E" value="E" />
                        <label for="question-6-answers-E">1000</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-6-answers" id="question-6-answers-F" value="F" />
                        <label for="question-6-answers-F">47</label>
                    </div>
                    
                    <div>
                        <input type="radio" name="question-6-answers" id="question-6-answers-G" value="G" />
                        <label for="question-6-answers-G">-12</label>
                    </div>
					
					<div>
                        <input type="radio" name="question-6-answers" id="question-6-answers-H" value="H" />
                        <label for="question-6-answers-H">69 - HAHA Sex Number</label>
                    </div>
                    
                    
                    
                    
                    </div>
                
                </li>
            
            </ol>
            
            <input type="submit" value="Submit" class="submitbtn" />
		
		</form>
	
	</div>


</body>

</html>
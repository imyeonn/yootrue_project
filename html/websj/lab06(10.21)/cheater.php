<!DOCTYPE html>
<html>
	<head>
		<title>Grade Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
			$sett=isset($_POST["CSE326"])||isset($_POST["CSE107"])||isset($_POST["CSE603"])||($_POST["CIN870"]);
			$settt=($_POST["name"]!="")&&($_POST["id"]!="")&&$sett&&isset($_POST["grade"])&&($_POST["card"]!=" ")&&isset($_POST["cc"]);
			print_r ($_POST);
			$credit=$_POST["card"];
			$card=$_POST["cc"];
			if($sett){
				if($card=="visa"){
					$reg="/^4[0-9]{15}/";
				}
				elseif($card=="MasterCard"){
					$reg="/^5[0-9]{15}/";
				}
			}
			if (!($settt)){
		?>
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. <a href="gradestore.html">Try again?</a></p>
		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		} elseif (!preg_match("/^[a-zA-Z]*[\ \-]?[a-zA-Z]*$/",$_POST["name"])) { 
		?>
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. <a href="gradestore.html">Try again?</a></p>

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		}
		elseif (!preg_match($reg,$credit)) {
		?> 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. <a href="gradestore.html">Try again?</a></p> 

		<?php
		# if all the validation and check are passed 
		}else {
		?>

		<h1>Thanks, looser!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<?php
			$name=$_POST["name"];
			$id=$_POST["id"];
			$course=array();
			
			if(isset($_POST["CSE326"]))
				array_push($course,"CSE326");
			if(isset($_POST["CSE107"]))
				array_push($course,"CSE107");
			if(isset($_POST["CSE603"]))
				array_push($course,"CSE603");
			if(isset($_POST["CIN870"]))
				array_push($course,"CIN870");
			$courses=processCheckbox($course);
			$grade=$_POST["grade"];
			
			$inform="\n".$name.";".$id.";".$credit.";".$card;
		?>

		<ul> 
			<li>Name: <?=$name?></li>
			<li>ID: <?=$id?></li>
			<!-- use the 'processCheckbox' function to display selected courses -->
			<li>Course:<?=$courses?> </li>
			<li>Grade:<?=$grade?> </li>
			<li>Credit<?=$credit." (".$card.")"?> </li>
		</ul>
		 
			<p>Here are all the loosers who have submitted here:</p>
			
		<?php
			$filename = "loosers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'loosers.txt' in the format of : "name;id;cardnumber;cardtype".
			 * For example, "Scott Lee;20110115238;4300523877775238;visa"
			 */
			file_put_contents($filename,$inform,FILE_APPEND);
			$result=file_get_contents($filename);
		?>
		
		<!-- Ex 3: Show the complete contents of "loosers.txt".
			 Place the file contents into an HTML <pre> element to preserve whitespace -->

		<pre><?=$result?></pre>
		<?php
			


		}

		?>
		<?php
			/* Ex 2: 
			 * Assume that the argument to this function is array of names for the checkboxes ("cse326", "cse107", "cse603", "cin870")
			 * 
			 * The function checks whether the checkbox is selected or not and 
			 * collects all the selected checkboxes into a single string with comma seperation.
			 * For example, "cse326, cse603, cin870"
			 */
			function processCheckbox($names){
				$courses=implode(", ",$names);
				return $courses;
			}
		?>
		
	</body>
</html>

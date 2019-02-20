<html>
<head>
<title>Participant Details</title>
</head>
<body>
<center>
<h1 id="header">Disclaimer</h1>
<script type="text/javascript">
var text = "Participant Details";
function do_change(){
text = "Quiz Information";
document.getElementById("header").innerHTML = "Quiz Information";
document.getElementById("Start").style.display = "block";
document.getElementById("ex").style.display = "block";
document.getElementById("Start2").style.display = "block";
document.getElementById("1").style.display = "none";
document.getElementById("2").style.display = "none";
document.getElementById("3").style.display = "none";
document.getElementById("Edu").style.display = "none";
document.getElementById("4").style.display = "none";
document.getElementById("l1").style.display = "none";
document.getElementById("l2").style.display = "none";
document.getElementById("l3").style.display = "none";
document.getElementById("EduLab").style.display = "none";
document.getElementById("l4").style.display = "none";
document.getElementById("l5").style.display = "none";
document.getElementById("28").style.display = "none";
document.getElementById("header").innerHTML = text;
}

function loadForm() {
	document.getElementById("disclaimer").style.display = "none";
	document.getElementById("form").style.display = "block";
	document.getElementById("header").innerHTML = text;
}

</script>
<?php include "connect.php"; ?>

<form id = "disclaimer" method="GET" >
<label >The aim of this quiz is to gather empirical evidence to test a small number hypotheses in the field of data visualization.</br>
		This research is being undertook as part of a final year undergraduate project in the field of Computer Science at the Manchester Metropolitan University. </br>
		By taking part in this quiz your basic demographics (Age, Gender, Occupation, Education) will be stored in a secure university server, </br>
		alongside this your answers to each of the 18 questions as well as the time it took you to answer each question will be stored. </br>
		All of this information is stored in a way that maintains your anonymity. </br></br>
		By clicking the button below you also agree that you understand that if more than a third of your answers are completed in an unacceptable time, </br>
		you will not recieve an MTurk code.
</label></br>
<input type="submit" class="button" name="load" value="I understand"  />
</form>

<form id = "form" method="post" style="display:none;">
<label for="1" id="l1">Age : </label>
<input class = "1" name="1" id="1" type="text" name="age" placeholder="Enter Age" method="post"/></br></br>
<label for="2"id="l2">Gender : </label>
<input class = "2" name="2" id="2" type="radio" checked="checked" value="Male" name="gender" method="post"/> <label for="2"id="l4"> Male </label>
<input class = "2" name="2" id="28" type="radio" value="Female" name="gender" method="post"/> <label for="28"id="l5"> Female </label></br></br>
<label for="3"id="l3">Occupation : </label>
<select class="form-control dropdown" id="3" name="3">
    <option value="" selected="selected" disabled="disabled">-- select one --</option>
      <option value="Full-Time Student">- Full-Time Student</option>
      <option value="Part-Time Student">- Part-Time Student</option>
      <option value="Full-Time Employment">- Full-Time Employment</option>
      <option value="Part-Time Employment">- Part-Time Employment</option>
      <option value="Unemployed">- Unemployed</option>
	  <option value="Other">- Other</option>
</select></br></br>
<label for="Edu"id="EduLab">Highest level of education obtained/working towards : </label>
<select class="form-control dropdown" id="Edu" name="Edu">
    <option value="" selected="selected" disabled="disabled">-- select one --</option>
      <option value="PHD">- PHD</option>
      <option value="Postgraduate">- Postgraduate degree</option>
      <option value="Undergraduate">- Undergraduate degree</option>
      <option value="High School">- High School</option>
	  <option value="Other">- Other</option>
</select></br></br>
<input type="submit" class="button" name="insert" value="Submit" id="4" />
</form>
<form>
<label id="ex" style="display:none; margin-top: -10%;"></br></br>
</label>
<label id="Start" style="display:none;"></br>
=> This quiz contains 18 simple qustions which if answered properly should like around 10 mins (HIT is limited to 25 mins). </br></br>
=> DO NOT press the back button at any point during the quiz as this will reset your progress. </br></br>
=> Please pay close attention to each question until the quiz is finished, All questions must be answered in good time,</br>
if too many questions are deemed to be answered too quickly you will not be given the MTurk quiz completed code at the end.</br></br>
</label>
<button class = "Start" name="Start" id="Start2" formaction="QuizIndex.html" style = "display:none;" >Start Quiz</button>
</form>

<?php
if(isset($_POST['insert'])) {
$age=$_POST['1'];
$gender=$_POST['2'];
$profession=$_POST['3'];
$education=$_POST['Edu'];


if (ctype_digit($age) && $gender != "" && $profession != "" && $education != "") { 


$sql = "INSERT INTO Participant (Age, Gender, Profession, Education) VALUES ('$age', '$gender', '$profession', '$education')";	
$pdo->exec($sql);

echo '<script type="text/javascript">',
     'do_change();',
     '</script>'
;

}
else { echo '<script type="text/javascript">',
     'alert("Please fill out the whole form properly");',
     '</script>'; }

}

if(isset($_GET['load'])) {

echo '<script type="text/javascript">',
     'loadForm();;',
     '</script>'
;
	
}

?>



</form>
</center>
</body>
</html>
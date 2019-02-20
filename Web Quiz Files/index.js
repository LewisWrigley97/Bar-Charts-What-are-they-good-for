(function() {

  var questionCount = 0; 
  var times = []; 
  var quiz = $('#quiz'); 
  var questions = retrieve();
  var insPID = pID();
  var pID = (insPID[0].ParticipantID);
  var startTime;
  var endTime;
  var time;
  var code = code();
  var c = code[0].Code;
  
  
  nextQuestion();
  
    
  function nextQuestion() {
    quiz.fadeOut(function() {
      $('#question').remove();
      
      if(questionCount < questions.length){
		  
        var nextQuestion = questionHTML(questionCount);
        quiz.append(nextQuestion).fadeIn();
        
		
	    $('#next').show();
      }
	  else { // THIS IS WHERE THE QUIZ ENDS
    
        $('#next').hide();
		var badAnswers = 0;
		for (var i=0, len=times.length; i<len; i++) {
			
			var t = times[i];
			
			if (t<3)
			{
				badAnswers++;
			}
			else if (t>2000)
			{
				badAnswers++;
			}
			
		}
		
		if (badAnswers>7)
		{
			document.getElementById("12345").innerHTML = "You answered more than a third of the questions in an unaccecptable time (You took less than 4 seconds to answer). Do not submit your HIT or you will be rejected.";
			document.getElementById("12345").style.display = "block";
		}
		else
		{
			document.getElementById("12345").innerHTML = "Thankyou for participating!   MTurk code: " + c + "00" + pID;
			document.getElementById("12345").style.display = "block";
		}
		
      }
    });
	startTimer();
  }
  
  
  function retrieve() {
	var r;
	$.ajax({
	async: false,
    type: 'POST',
    url: 'retrieve.php',
    success: function(result) {
	r = JSON.parse(result);
	}
});	
	 return r; 
  }
  
	function code() {
		var r;
	$.ajax({
	async: false,
    type: 'POST',
    url: 'code.php',
    success: function(result) {
	r = JSON.parse(result);
	}
});	
	 return r;
		
		
		
	}
  
    function pID() {
	var p;
	$.ajax({
	async: false,
    type: 'POST',
    url: 'ParticipantID.php',
    success: function(result) {
	p = JSON.parse(result);
	}
});	
	 return p; 
  }
  
   
  function questionHTML(index) {
    var HTMLBlock = $('<div>', {
      id: 'question'
    });
    
    var questionText = $('<h2>Question ' + (index + 1) + '/18:  ' + (questions[index].Question) +'</h2>');
    HTMLBlock.append(questionText);
    
	var l = (questions[index].ImageLink);
	
	var img = $('<img id="IMG"  src="' + l + '"style="max-height:90%; max-width: 90%;">');
	var input = $('<br/><input id= "1" type="text" name="answer" placeholder="Enter Answer" method="post" style="margin-top: 15px; height: 50px; width:30%; font-size:20pt;"/>');
	
	HTMLBlock.append(img);
	HTMLBlock.append(input);
    
    
    return HTMLBlock;
  }
  
  function startTimer() {
	  
	  
	  startTime = new Date();
	  
	  
  }
  
  function displayNext() {
	  
	  document.getElementById("next").display = "block";
	  
  }
  
  function isDoubleClicked(element) {
    if (element.data("isclicked")) return true;

    element.data("isclicked", true);
    setTimeout(function () {
        element.removeData("isclicked");
    }, 1000);

    return false;
}
  
  
  $('#next').on('click', function (e) {
	if (isDoubleClicked($(this))) return;
    e.preventDefault();
    var ans = answer();
	var qID = questions[questionCount].QuestionID;
	
    if (ans == "") {
      alert('Please answer the question');
    } else {
	  
	  var endTime = new Date();
	  time = endTime - startTime;
	  time = time /1000; 
	  
	  times.push(time);
	  
      questionCount++;
	  submitAnswer(pID, ans, questionCount, qID, time);
      nextQuestion();
	  
    
	}
  });

  function submitAnswer(pID, ans, questionCount, qID, time) { 
	
	$.ajax({
	async: false,
    type: 'POST',
    url: 'uploadAnswer.php',
	data: { PID: pID, answer: ans, qNo: questionCount, QID: qID, Time: time},
    success: function(response) {
	}
});		
  }
  
  function answer() {
	  
    var ans = document.getElementById(1).value;
	return ans;
	
  }
  
  
  

})();
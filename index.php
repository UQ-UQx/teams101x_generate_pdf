<?php require_once('inc/header.php'); ?>

</head>
<body>

<?php
	$lti->requirevalid();
?>

<!-- Answer a bunch of questions and a pdf will be generated -->


<script type="text/javascript">

$(document).ready(function() {

	console.log('hello world');


	var documentdef = {
		content: [
			'First paragraph',
			'Another paragraph, this time a little bit longer to make sure, this line will be divided into at least two lines'
		]
	}

	$(".makepdf").click(function(event) {

		 pdfMake.createPdf(documentdef).download('awesome.pdf');

	})

});

</script>

<script type="text/javascript" src="www/js/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="www/js/pdfmake/vfs_fonts.js"></script>







<?php


	//get all the variables from the LTI post
	//user class for getting constants and calldata to customs

	$view = '';

	$ltivars = $lti->calldata();

	//get lti id first as defined by edx

	$lti_id = $lti->resource_id();

	//construct survey id, by combining lti id and user id

	$sid = $lti_id.'-lti-uid-'.$lti->user_id();


	//define scale of the survey and questions

?>



<form id="survey_form" action="javascript:void(0);" method="POST">


<div id="qustion_1" class="question_container">
	<h3>Extroversion or introversion</h3>
	<p>Would you consider yourself an extrovert or introvert?</p>
	<div class="input_container extro_intro_inputs">
		<input type="radio" name="extro_intro_input" id="introvert_input"	value="Introvert">Introvert</br>
		<input type="radio" name="extro_intro_input" id="equal_input"	value="Equal traits of both">Equal traits of both</br>
		<input type="radio" name="extro_intro_input" id="extrovert_input"	value="Extrovert">Extrovert</br>
	</div>
</div>

<div id="qustion_2" class="question_container">
	<h3>Friendliness</h3>
	<p>select the option that best describes your level of friendliness</p>

	<div class="input_container friendliness_inputs">
		<input type="radio" name="friendliness_input" id="low_input"	value="Low">Low</br>
		<input type="radio" name="friendliness_input" id="medium_input"	value="Medium">Medium</br>
		<input type="radio" name="friendliness_input" id="high_input"	value="High">High</br>
	</div>
</div>

<div id="qustion_3" class="question_container">
	<h3>Team Interest or Self Interest</h3>
	<p>On a scale of team versus self-interest where does your motivation lie?</p>

	<div class="input_container interest_inputs">
		<input type="radio" name="interest_input" id="1_input"	value="1">1 - Team Interest</br>
		<input type="radio" name="interest_input" id="2_input"	value="2">2</br>
		<input type="radio" name="interest_input" id="3_input"	value="3">3</br>
		<input type="radio" name="interest_input" id="4_input"	value="4">4</br>
		<input type="radio" name="interest_input" id="5_input"	value="5">5 - Self Interest</br>
	</div>
</div>


<div id="question_4" class="question_container">

<h3>Team role preferences</h3>
	<p>Indicate your preference for the team roles below with:</p>

	<div class="input_container preferences_inputs">
		<b>First preference:</b>
		<select class="preference_dropdown">
				<option value=""></option>
				<option value="Coordinator">Coordinator</option>
				<option value="Shaper">Shaper</option>
				<option value="Implementer">Implementer</option>
				<option value="Plant">Plant</option>
				<option value="Team worker">Team worker</option>
				<option value="Monitor/evaluator">Monitor/evaluator</option>
				<option value="Completer/finisher">Completer/finisher</option>
				<option value="Resource Investigator">Resource Investigator</option>
		</select>
	</div>


	<div class="input_container preferences_inputs">
		<b>Second preference:</b>
		<select class="preference_dropdown">
				<option value=""></option>
				<option value="Coordinator">Coordinator</option>
				<option value="Shaper">Shaper</option>
				<option value="Implementer">Implementer</option>
				<option value="Plant">Plant</option>
				<option value="Team worker">Team worker</option>
				<option value="Monitor/evaluator">Monitor/evaluator</option>
				<option value="Completer/finisher">Completer/finisher</option>
				<option value="Resource Investigator">Resource Investigator</option>
		</select>
	</div>

	<div class="input_container preferences_inputs">
		<b>Least prefered role:</b>
		<select class="preference_dropdown">
				<option value=""></option>
				<option value="Coordinator">Coordinator</option>
				<option value="Shaper">Shaper</option>
				<option value="Implementer">Implementer</option>
				<option value="Plant">Plant</option>
				<option value="Team worker">Team worker</option>
				<option value="Monitor/evaluator">Monitor/evaluator</option>
				<option value="Completer/finisher">Completer/finisher</option>
				<option value="Resource Investigator">Resource Investigator</option>
		</select>
	</div>




</div>

<button class="btn btn-primary btn-md makepdf">Generate PDF</button>     <button id='resetButton' type='reset' class="btn btn-default btn-md">Reset</button>


</form>


<style type="text/css">

	.question_container{

		margin-bottom:30px;
	}

	.input_container{

		margin-left:30px;


	}

	.input_container input{

		margin-right: 10px;
		margin-bottom:10px;
	}

	.preference_dropdown{

		display: block;

	}

</style>


<script type='text/javascript'>




// 	$(document).ready(function(){

// 		resize();

// 		var fullwidth, pagewidth;


// 		$('#feedbackButton').hide();
// 		$('.score_text').hide();
// 		var showpage_feature = true;

// 		if(current_response_status == 'finished'){


// 			var current_score = calculateScore();

// // 			constructScoreFeedback(current_score);
// 			showpage_feature = false;
// 			$('#feedbackButton').show();




// 		}

// 		$( window ).resize(function() {
// 			resize();
// 		});
// 		function resize() {
// 			fullwidth = $('body').width();
// 			$('div.page_container').width(fullwidth);
// 			pagewidth = fullwidth;
// 			$('div.question_page').width(pagewidth-60);
// 		}



// 		var currentPage = 1;
// 		var total_pages = <?php echo count($questions); ?>;

// 		var opts = {
// 		    totalPages: total_pages,
// 		    visiblePages: 5,
// 		    startPage:currentPage,
// 		    onPageClick: function (event, page) {
// 		        console.log('Page change event. Page = ' + page);
// 		        $('.pagination').data('currentPage', page);
// 		        showpage(page);
// 		    }
// 		};

// 		$('.questions_pagination').twbsPagination(opts);

// 		$('.question_input').change(function(){

// 			if(showpage_feature){

// 				var pageto = currentPage+1;

// 			    if(pageto < opts['totalPages']){
// 			      $('.questions_pagination').twbsPagination('destroy');
// 			      $('.questions_pagination').twbsPagination($.extend(opts, {
// 			          startPage: pageto+1
// 			      }));
// 			    }
// 			}

// 		});

// 		function showpage(page){

// 			console.log(page);
// 			page = page-1;

// 			leftm = fullwidth*page*-1;

// 			$( ".page_scroller" ).animate({
// 			    marginLeft: leftm,
// 			}, 400);

// 			currentPage = page;

// 			//$('.currentpage_status').text((currentPage+1)+'/'+total_pages);


// 		}


// 		var showprevious = '<?php echo $pre_qresponse_showanswer ?>';
// 		var currentStatus = 'unfinished';
// 		var survey_score = null;

// 		$('#submitButton').click(function(event){

// 			$(this).addClass('disabled');

// 			$(this).prop("disabled", true);
//  			$(this).empty().append("Submitting <i class='fa fa-spinner fa-pulse'></i>");

// 			var data = check();
// 			save(data);

// 		});

// 		$('#resetButton').click(function(event){

// 			reset();

// 		});

// 		function check(){

// 			var status = {};
// 			var statusString;
// 			var qcount = 0;
// 			var answeredcount = 0;



// 			$('.question_container').each(function(){
// 				qcount++;
// 				$(this).find('.question_input').each(function(ind, obj){

// 					if($(obj).is(':checked')){
// 						status["question"+$(obj).data('question_number')] = $(obj).attr('data-option_num');
// 						answeredcount++;
// 						return false;
// 					}else{
// 						status["question"+$(obj).data('question_number')] = null;
// 					}

// 				});
// 			});

// 			var currentScore = calculateScore();

// 			status["score"] = currentScore;

// 			status["questions_answered_count"] = answeredcount;

// 			status["status"] = 'unfinished';

// 			if(qcount == answeredcount){
// 				status["status"] = 'finished';
// 				currentStatus = 'finished';
// 			}else if(answeredcount > 0){
// 				status["status"] = 'attempted';
// 				currentStatus = 'attempted';

// 			}

// 			statusString = JSON.stringify(status);

// 			return statusString;

// 		}

// 		function save(js_data){



// 			var data = {'data':{}};
// 			data['sid'] = '<?php echo $sid ?>';
// 			data['user_id'] = '<?php echo $lti->user_id(); ?>';
// 			data['data'] = $('#questionnaire_form').serialize();
// 			data['js_data'] =  js_data;

// 			data['lti_id'] = '<?php echo $lti->lti_id(); ?>';
// 			data['lis_outcome_service_url'] = '<?php echo $lti->grade_url(); ?>';
// 			data['lis_result_sourcedid'] = '<?php echo $lti->result_sourcedid(); ?>';

// 			$.ajax({
// 			  type: "POST",
// 			  url: "savedata.php",
// 			  data: data,
// 			  success: function(response) {

// 				  console.log(response);

// 				$("#submitButton").removeClass('disabled');
// 				$("#submitButton").prop("disabled", false);
//  				$("#submitButton").empty().append("Submit");



// 			  },
// 			  error: function(error){
// 				  console.log(error);
// 			  }
// 			});




// 		}

// 		function reset(){

// 			console.log('reset');



// 		}





// 	});



</script>





</body>
</html>

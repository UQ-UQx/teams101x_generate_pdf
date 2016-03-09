<?php require_once('inc/header.php'); ?>

</head>
<body>

<?php
	$lti->requirevalid();
?>

<!-- Answer a bunch of questions and a pdf will be generated -->


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
	<span class="titles">Extroversion or introversion</span>
	<p>Would you consider yourself an extrovert or introvert?</p>
	<div class="input_container extro_intro_inputs">
		<input class="target" type="radio" name="extro_intro_input" id="introvert_input"	value="Introvert">Introvert</br>
		<input class="target" type="radio" name="extro_intro_input" id="equal_input"	value="Equal">Equal traits of both</br>
		<input class="target" type="radio" name="extro_intro_input" id="extrovert_input"	value="Extrovert">Extrovert</br>
	</div>
</div>

<div id="qustion_2" class="question_container">
	<span class="titles">Friendliness</span>
	<p>select the option that best describes your level of friendliness</p>

	<div class="input_container friendliness_inputs">
		<input class="target" type="radio" name="friendliness_input" id="low_input"	value="Low">Low</br>
		<input class="target" type="radio" name="friendliness_input" id="medium_input"	value="Medium">Medium</br>
		<input class="target" type="radio" name="friendliness_input" id="high_input"	value="High">High</br>
	</div>
</div>

<div id="qustion_3" class="question_container">
	<span class="titles">Team Interest or Self Interest</span>
	<p>On a scale of team versus self-interest where does your motivation lie?</p>

	<div class="input_container interest_inputs">
		<input class="target" type="radio" name="interest_input" id="1_input"	value="1">1 - Team Interest</br>
		<input class="target" type="radio" name="interest_input" id="2_input"	value="2">2</br>
		<input class="target" type="radio" name="interest_input" id="3_input"	value="3">3</br>
		<input class="target" type="radio" name="interest_input" id="4_input"	value="4">4</br>
		<input class="target" type="radio" name="interest_input" id="5_input"	value="5">5 - Self Interest</br>
	</div>
</div>


<div id="question_4" class="question_container">

<span class="titles">Team role preferences</span>
	<p>Indicate your preference for the team roles below with:</p>

	<div class="input_container preferences_inputs">
		<b>First preference:</b>
		<select name="first_preference" class="preference_dropdown target">
				<option selected disabled hidden style='display: none' value=''></option>
				<option value="Coordinator">Coordinator</option>
				<option value="Shaper">Shaper</option>
				<option value="Implementer">Implementer</option>
				<option value="Plant">Plant</option>
				<option value="TeamWorker">Team worker</option>
				<option value="Monitor">Monitor/evaluator</option>
				<option value="Completer">Completer/finisher</option>
				<option value="Resource_Investigator">Resource Investigator</option>
		</select>
	</div>


	<div class="input_container preferences_inputs">
		<b>Second preference:</b>
		<select name="second_preference" class="preference_dropdown target">
				<option selected disabled hidden style='display: none' value=''></option>
				<option value="Coordinator">Coordinator</option>
				<option value="Shaper">Shaper</option>
				<option value="Implementer">Implementer</option>
				<option value="Plant">Plant</option>
				<option value="TeamWorker">Team worker</option>
				<option value="Monitor">Monitor/evaluator</option>
				<option value="Completer">Completer/finisher</option>
				<option value="Resource_Investigator">Resource Investigator</option>
		</select>
	</div>

	<div class="input_container preferences_inputs">
		<b>Least prefered role:</b>
		<select name="least_preference" class="preference_dropdown target">
				<option selected disabled hidden style='display: none' value=''></option>
				<option value="Coordinator">Coordinator</option>
				<option value="Shaper">Shaper</option>
				<option value="Implementer">Implementer</option>
				<option value="Plant">Plant</option>
				<option value="TeamWorker">Team worker</option>
				<option value="Monitor">Monitor/evaluator</option>
				<option value="Completer">Completer/finisher</option>
				<option value="Resource_Investigator">Resource Investigator</option>
		</select>
	</div>




</div>


<button class="btn btn-primary btn-md makepdf">Generate PDF</button>     <button type='reset' class="btn btn-default btn-md resetButton">Reset</button>
<span class="hint_text">Please complete the survey to generate a PDF</span>

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

	.titles{
		font-weight:bold;
		font-size: 20px;

	}

	.hint_text{
		color: #FFFFFF;
		display: block;
		padding:5px;
		margin-top: 5px;
		background-color: #FF6128;
		text-align: center;
	}

</style>
<script type="text/javascript" src="www/js/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="www/js/pdfmake/vfs_fonts.js"></script>

<script type='text/javascript'>

var current_count = 0;

$(document).ready(function() {


	toggleGenerateButton('on');

	$(".makepdf").click(function(event) {

		var form_data = $('#survey_form').serializeArray();
		generatePDF(form_data);
	});

	$(".resetButton").click(function(event){
		toggleGenerateButton('off');
	});


	$('.target').change(function(event){

		var form_data = $('#survey_form').serializeArray();

		if($(form_data).size() == 6){
			toggleGenerateButton('on');
		}else{
			toggleGenerateButton('off');
		}

	});



	function generatePDF(data){
		function convertImagesToBase64(images, callback){
			//callback(images);

			var base64_images = {};

			$.each(images, function(key, val){



				var img = new Image();
			    img.crossOrigin = 'Anonymous';
			    img.onload = function(){
			        var canvas = document.createElement('CANVAS');
			        var ctx = canvas.getContext('2d');
			        var dataURL;
			        canvas.height = this.height;
			        canvas.width = this.width;
			        ctx.drawImage(this, 0, 0);
			        dataURL = canvas.toDataURL();
			        base64_images[key] = dataURL
			        canvas = null;
			    };
			    img.src = val.url;

			});


			var allImagesConverted = true;

			var keepchecking = setInterval(function(){

				$.each(base64_images,function(key, val){

						if(!val){
							allImagesConverted = false;
						}
				});

				if(allImagesConverted){
					clearInterval(keepchecking);
					callback(base64_images);
				}

			},500);
		}

		var imagesToLoad = {
				"header":{
					"url":"www/images/pdf_header_image.jpg",
					"base64_url":"undefined"
				},
				"sample":{
					"url":"sample.jpg",
					"base64_url":"undefined"
				}
		};

		convertImagesToBase64(imagesToLoad, generate);



		function generate(base64_images){

			var documentStructure = {

				content: [
					{
						image:base64_images.sample,
					}
				]

			}


			pdfMake.createPdf(documentStructure).download('teams101x_Putting_YourSelf_In_The_Picture.pdf');

		}
	}


	/**
	 * Toggles the generate pdf button to on or off
	 * @param  {string} state options["on", "off"]
	 * @return {null}       No return
	 */
	function toggleGenerateButton(state){
		if(state == "on"){
			if($('.makepdf').is(":disabled")){
				$('.makepdf').prop("disabled",false);
				$(".hint_text").hide();
			}
		}else{
			if(!$('.makepdf').is(":disabled")){
				$('.makepdf').prop("disabled",true);
				$(".hint_text").show();
			}
		}
	}



});




</script>

</body>
</html>


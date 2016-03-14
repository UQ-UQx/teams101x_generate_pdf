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


<div id="qustion_0" class="question_container">
	<span class="titles">Experience</span>
	<p>Select the option that best describes your level of experience.</p>
	<div class="input_container exp_inputs">
		<input class="target" type="radio" name="exp_input" id="junior"	value="Junior">Junior</br>
		<input class="target" type="radio" name="exp_input" id="intermediate"	value="Intermediate">Intermediate</br>
		<input class="target" type="radio" name="exp_input" id="senior"	value="Senior">Senior</br>
	</div>
</div>


<div id="qustion_1" class="question_container">
	<span class="titles">Extraversion or Introversion</span>
	<p>Would you consider yourself an extravert or introvert?</p>
	<div class="input_container extra_intro_inputs">
		<input class="target" type="radio" name="extra_intro_input" id="introvert_input"	value="Introvert">Introvert</br>
		<input class="target" type="radio" name="extra_intro_input" id="equal_input"	value="Equal">Equal traits of both</br>
		<input class="target" type="radio" name="extra_intro_input" id="extravert_input"	value="extravert">Extravert</br>
	</div>
</div>

<div id="qustion_2" class="question_container">
	<span class="titles">Friendliness</span>
	<p>Select the option that best describes your level of friendliness.</p>

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

<span class="titles">Team Role Preferences</span>
	<p>Indicate your preference for the team roles below with:</p>

	<div class="input_container preferences_inputs">
		<b>First preference:</b>
		<select name="first_preference" class="preference_dropdown target custom_select" id='preference_1'>
				<option selected disabled hidden style='display: none' value=''></option>
				<option value="Coordinator">Coordinator</option>
				<option value="Shaper">Shaper</option>
				<option value="Implementer">Implementer</option>
				<option value="Plant">Plant</option>
				<option value="TeamWorker">Team Worker</option>
				<option value="Monitor">Monitor Evaluator</option>
				<option value="Completer">Completer Finisher</option>
				<option value="Resource_Investigator">Resource Investigator</option>
		</select>
	</div>


	<div class="input_container preferences_inputs">
		<b>Second preference:</b>
		<select name="second_preference" class="preference_dropdown target custom_select" id='preference_2' >
				<option selected disabled hidden style='display: none' value=''></option>
				<option value="Coordinator">Coordinator</option>
				<option value="Shaper">Shaper</option>
				<option value="Implementer">Implementer</option>
				<option value="Plant">Plant</option>
				<option value="TeamWorker">Team Worker</option>
				<option value="Monitor">Monitor Evaluator</option>
				<option value="Completer">Completer Finisher</option>
				<option value="Resource_Investigator">Resource Investigator</option>
		</select>
	</div>

	<div class="input_container preferences_inputs">
		<b>Least preferred role:</b>
		<select name="least_preference" class="preference_dropdown target custom_select" id='preference_3' >
				<option selected disabled hidden style='display: none' value=''></option>
				<option value="Coordinator">Coordinator</option>
				<option value="Shaper">Shaper</option>
				<option value="Implementer">Implementer</option>
				<option value="Plant">Plant</option>
				<option value="TeamWorker">Team Worker</option>
				<option value="Monitor">Monitor Evaluator</option>
				<option value="Completer">Completer Finisher</option>
				<option value="Resource_Investigator">Resource Investigator</option>
		</select>
	</div>




</div>


<button class="btn btn-primary btn-md makepdf">Generate PDF</button> <button type='reset' class="btn btn-default btn-md resetButton">Reset</button>
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
<script type="text/javascript" src="www/js/jspdf.js"></script>

<script type='text/javascript'>


var current_count = 0;

$(document).ready(function() {


	toggleGenerateButton('off');

	$(".makepdf").click(function(event) {

		var form_data = $('#survey_form').serializeArray();
		generatePDF(form_data);
	});

	$(".resetButton").click(function(event){
		toggleGenerateButton('off');
	});

	$('.custom_select').change(function(){

		update_select_options($(this));

	});


	$('.target').change(function(event){

		var form_data = $('#survey_form').serializeArray();


		if($(form_data).size() == 7){
			toggleGenerateButton('on');
		}else{
			toggleGenerateButton('off');
		}

	});

	function update_select_options(select) {


		// console.log($("#"+select.attr("id")).find(":selected"));





		// //add the selection $('#aioConceptName').find(":selected") to used values
		// //
		// // go through each one and hide it if it's not the parent



	}


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
			        dataURL = canvas.toDataURL("image/jpeg", 1.0);
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
				"completer":{
					"url":"www/images/completer.jpeg",
					"base64_url":"undefined"
				},
				"coordinator":{
					"url":"www/images/coordinator.jpeg",
					"base64_url":"undefined"
				},
				"implementer":{
					"url":"www/images/implementer.jpeg",
					"base64_url":"undefined"
				},
				"monitor":{
					"url":"www/images/monitor.jpeg",
					"base64_url":"undefined"
				},
				"plant":{
					"url":"www/images/plant.jpeg",
					"base64_url":"undefined"
				},
				"resource":{
					"url":"www/images/resource_investigator.jpeg",
					"base64_url":"undefined"
				},
				"shaper":{
					"url":"www/images/shaper.jpeg",
					"base64_url":"undefined"
				},
				"teamworker":{
					"url":"www/images/team_worker.jpeg",
					"base64_url":"undefined"
				},
				"no_tick":{
					"url":"www/images/no_tick.jpeg",
					"base64_url":"undefined"
				},
				"tick":{
					"url":"www/images/tick.jpeg",
					"base64_url":"undefined"
				}
		};

		convertImagesToBase64(imagesToLoad, generate);



		function generate(base64_images){

			console.log(data);

			var margin = 13;
			var icon_size =  30;
			var tickboxsize = 6;
			var headingsize = 16;
			var textsize = 12;
			var extra_friendly_options_offset = 70;
			var team_interest_margin_offset = 40;
			var doc = new jsPDF();
			var vert_offset = 2;
			var total_vert_offset = 45;
			var scalex_offset = 25;
			var prefered_role_offset = 10;

			var role_x_offset = 70;
			var roleimage_y_offset = 7;
			var roleimage_name_y_offset = 30;



			var exp_option_1_status = base64_images.no_tick;
			var exp_option_2_status = base64_images.no_tick;
			var exp_option_3_status = base64_images.no_tick;

			var introvert_option_1_status = base64_images.no_tick;
			var introvert_option_2_status = base64_images.no_tick;
			var introvert_option_3_status = base64_images.no_tick;


			var friendliness_option_1_status = base64_images.no_tick;
			var friendliness_option_2_status = base64_images.no_tick;
			var friendliness_option_3_status = base64_images.no_tick;


			var team_interest_option_1_status = base64_images.no_tick;
			var team_interest_option_2_status = base64_images.no_tick;
			var team_interest_option_3_status = base64_images.no_tick;
			var team_interest_option_4_status = base64_images.no_tick;
			var team_interest_option_5_status = base64_images.no_tick;

			var team_role_option_1 = base64_images.completer;
			var team_role_option_2 = base64_images.completer;
			var team_role_option_3 = base64_images.completer;

			var team_role_name_1 = "Completer";
			var team_role_name_2 = "Completer";
			var team_role_name_3 = "Completer";


			$.each(data, function(key,val){

				console.log(val.name+" = "+val.value);

				if(val.name == "exp_input"){
					switch (val.value) { 
						case 'Junior': 
							exp_option_1_status = base64_images.tick;
							break;
						case 'Intermediate': 
							exp_option_2_status = base64_images.tick;
							break;
						case 'Senior': 
							exp_option_3_status = base64_images.tick;
							break;
						default:
							break;
					}
				}

				if(val.name == "extra_intro_input"){
					switch (val.value) { 
						case 'Introvert': 
							introvert_option_1_status = base64_images.tick;
							break;
						case 'Equal': 
							introvert_option_2_status = base64_images.tick;
							break;
						case 'extravert': 
							introvert_option_3_status = base64_images.tick;
							break;
						default:
							break;
					}
				}

				if(val.name == "friendliness_input"){
					switch (val.value) { 
						case 'Low': 
							friendliness_option_1_status = base64_images.tick;
							break;
						case 'Medium': 
							friendliness_option_2_status = base64_images.tick;
							break;
						case 'High': 
							friendliness_option_3_status = base64_images.tick;
							break;
						default:
							break;
					}
				}


				if(val.name == "interest_input"){
					switch (val.value) { 
						case '1': 
							team_interest_option_1_status = base64_images.tick;
							break;
						case '2': 
							team_interest_option_2_status = base64_images.tick;
							break;
						case '3': 
							team_interest_option_3_status = base64_images.tick;
							break;
						case '4': 
							team_interest_option_4_status = base64_images.tick;
							break;
						case '5': 
							team_interest_option_5_status = base64_images.tick;
							break;
						default:
							break;
					}
				}



				if(val.name == "first_preference"){
					switch (val.value) { 
						case 'Coordinator': 
							team_role_option_1 = base64_images.coordinator;
							team_role_name_1 = "Coordinator";
							break;
						case 'Shaper': 
							team_role_option_1 = base64_images.shaper;
							team_role_name_1 = "Shaper";
							break;
						case 'Implementer': 
							team_role_option_1 = base64_images.implementer;
							team_role_name_1 = "Implementer";
							break;
						case 'Plant': 
							team_role_option_1 = base64_images.plant;
							team_role_name_1 = "Plant";
							break;
						case 'TeamWorker': 
							team_role_option_1 = base64_images.teamworker;
							team_role_name_1 = "Team Worker";
							break;
						case 'Monitor': 
							team_role_option_1 = base64_images.monitor;
							team_role_name_1 = "Monitor Evaluator";
							break;
						case 'Completer': 
							team_role_option_1 = base64_images.completer;
							team_role_name_1 = "Completer Finisher";
							break;
						case 'Resource_Investigator': 
							team_role_option_1 = base64_images.resource;
							team_role_name_1 = "Resource Investigator";
							break;
						default:
							break;
					}
				}


				if(val.name == "second_preference"){
					switch (val.value) { 
						case 'Coordinator': 
							team_role_option_2 = base64_images.coordinator;
							team_role_name_2 = "Coordinator";
							break;
						case 'Shaper': 
							team_role_option_2 = base64_images.shaper;
							team_role_name_2 = "Shaper";
							break;
						case 'Implementer': 
							team_role_option_2 = base64_images.implementer;
							team_role_name_2 = "Implementer";
							break;
						case 'Plant': 
							team_role_option_2 = base64_images.plant;
							team_role_name_2 = "Plant";
							break;
						case 'TeamWorker': 
							team_role_option_2 = base64_images.teamworker;
							team_role_name_2 = "Team Worker";
							break;
						case 'Monitor': 
							team_role_option_2 = base64_images.monitor;
							team_role_name_2 = "Monitor Evaluator";
							break;
						case 'Completer': 
							team_role_option_2 = base64_images.completer;
							team_role_name_2 = "Completer Finisher";
							break;
						case 'Resource_Investigator': 
							team_role_option_2 = base64_images.resource;
							team_role_name_2 = "Resource Investigator";
							break;
						default:
							break;
					}
				}

				if(val.name == "least_preference"){
					switch (val.value) { 
						case 'Coordinator': 
							team_role_option_3 = base64_images.coordinator;
							team_role_name_3 = "Coordinator";
							break;
						case 'Shaper': 
							team_role_option_3 = base64_images.shaper;
							team_role_name_3 = "Shaper";
							break;
						case 'Implementer': 
							team_role_option_3 = base64_images.implementer;
							team_role_name_3 = "Implementer";
							break;
						case 'Plant': 
							team_role_option_3 = base64_images.plant;
							team_role_name_3 = "Plant";
							break;
						case 'TeamWorker': 
							team_role_option_3 = base64_images.teamworker;
							team_role_name_3 = "Team Worker";
							break;
						case 'Monitor': 
							team_role_option_3 = base64_images.monitor;
							team_role_name_3 = "Monitor Evaluator";
							break;
						case 'Completer': 
							team_role_option_3 = base64_images.completer;
							team_role_name_3 = "Completer Finisher";
							break;
						case 'Resource_Investigator': 
							team_role_option_3 = base64_images.resource;
							team_role_name_3 = "Resource Investigator";
							break;
						default:
							break;
					}
				}

			});







			//header
			doc.addImage(base64_images.header, 'JPEG', 0, 0, 210,60);

			//main heading
			doc.setFontSize(22);
			doc.setFontType("bold");
			doc.text(margin+70, 70, "Your Profile");
			doc.setLineWidth(1);
			doc.line(0, 75, 210, 75);


			doc.setFontSize(19);
			doc.setFontType("bold");
			doc.text(margin, 90, "Personal Traits");
			doc.setLineWidth(0.5);
			doc.line(margin, 93, 200, 93);



			doc.setFontSize(headingsize);
			doc.setFontType("bold");
			doc.text(margin, 90+total_vert_offset-30, "Experience");


				doc.setFontType("normal");

				doc.setFontSize(textsize);
				doc.text(margin, 100+vert_offset+total_vert_offset-30, "Junior");
				doc.addImage(introvert_option_1_status, 'JPEG', margin+14, 95+vert_offset+total_vert_offset-30, tickboxsize,tickboxsize);


				doc.setFontSize(textsize);
				doc.text((margin+extra_friendly_options_offset+7), 100+vert_offset+total_vert_offset-30, "Intermediate");
				doc.addImage(introvert_option_2_status, 'JPEG', (margin+extra_friendly_options_offset)+35, 95+vert_offset+total_vert_offset-30, tickboxsize,tickboxsize);


				doc.setFontSize(textsize);
				doc.text((margin+extra_friendly_options_offset*2+20), 100+vert_offset+total_vert_offset-30, "Senior");
				doc.addImage(introvert_option_3_status, 'JPEG', (margin+extra_friendly_options_offset*2+20)+17, 95+vert_offset+total_vert_offset-30, tickboxsize,tickboxsize);





			doc.setFontSize(headingsize);
			doc.setFontType("bold");
			doc.text(margin, 90+total_vert_offset, "Extraversion or Introversion");


				doc.setFontType("normal");

				doc.setFontSize(textsize);
				doc.text(margin, 100+vert_offset+total_vert_offset, "Introvert");
				doc.addImage(introvert_option_1_status, 'JPEG', margin+18, 95+vert_offset+total_vert_offset, tickboxsize,tickboxsize);


				doc.setFontSize(textsize);
				doc.text((margin+extra_friendly_options_offset+2), 100+vert_offset+total_vert_offset, "Equal traits of both");
				doc.addImage(introvert_option_2_status, 'JPEG', (margin+extra_friendly_options_offset)+40, 95+vert_offset+total_vert_offset, tickboxsize,tickboxsize);


				doc.setFontSize(textsize);
				doc.text((margin+extra_friendly_options_offset*2+17), 100+vert_offset+total_vert_offset, "Extravert");
				doc.addImage(introvert_option_3_status, 'JPEG', (margin+extra_friendly_options_offset*2+20)+17, 95+vert_offset+total_vert_offset, tickboxsize,tickboxsize);




			doc.setFontSize(headingsize);
			doc.setFontType("bold");
			doc.text(margin, 120+total_vert_offset, "Friendliness");



				doc.setFontType("normal");

				doc.setFontSize(textsize);
				doc.text(margin, 130+vert_offset+total_vert_offset, "Low");
				doc.addImage(friendliness_option_1_status, 'JPEG', margin+11, 125+vert_offset+total_vert_offset, tickboxsize,tickboxsize);


				doc.setFontSize(textsize);
				doc.text((margin+extra_friendly_options_offset+11), 130+vert_offset+total_vert_offset, "Medium");
				doc.addImage(friendliness_option_2_status, 'JPEG', (margin+extra_friendly_options_offset)+29, 125+vert_offset+total_vert_offset, tickboxsize,tickboxsize);


				doc.setFontSize(textsize);
				doc.text((margin+extra_friendly_options_offset*2+26), 130+vert_offset+total_vert_offset, "High");
				doc.addImage(friendliness_option_3_status, 'JPEG', (margin+extra_friendly_options_offset*2+20)+17, 125+vert_offset+total_vert_offset, tickboxsize,tickboxsize);

		

			doc.setFontSize(headingsize);
			doc.setFontType("bold");
			doc.text(margin, 150+total_vert_offset, "Team Interest or Self Interest");


				doc.setFontType("normal");

				doc.setFontSize(textsize);
				doc.text(margin, 160+vert_offset+total_vert_offset, "Team Interest");



				doc.setFontSize(textsize);
				doc.text((margin+team_interest_margin_offset), 160+vert_offset+total_vert_offset, "1");
				doc.addImage(team_interest_option_1_status, 'JPEG', (margin+team_interest_margin_offset)+4, 155+vert_offset+total_vert_offset, tickboxsize,tickboxsize);


				doc.setFontSize(textsize);
				doc.text((margin+team_interest_margin_offset+scalex_offset), 160+vert_offset+total_vert_offset, "2");
				doc.addImage(team_interest_option_2_status, 'JPEG', (margin+team_interest_margin_offset+scalex_offset)+4, 155+vert_offset+total_vert_offset, tickboxsize,tickboxsize);



				doc.setFontSize(textsize);
				doc.text((margin+team_interest_margin_offset+scalex_offset*2), 160+vert_offset+total_vert_offset, "3");
				doc.addImage(team_interest_option_3_status, 'JPEG', (margin+team_interest_margin_offset+scalex_offset*2)+4, 155+vert_offset+total_vert_offset, tickboxsize,tickboxsize);


				doc.setFontSize(textsize);
				doc.text((margin+team_interest_margin_offset+scalex_offset*3), 160+vert_offset+total_vert_offset, "4");
				doc.addImage(team_interest_option_4_status, 'JPEG', (margin+team_interest_margin_offset+scalex_offset*3)+4, 155+vert_offset+total_vert_offset, tickboxsize,tickboxsize);


				doc.setFontSize(textsize);
				doc.text((margin+team_interest_margin_offset+scalex_offset*4), 160+vert_offset+total_vert_offset, "5");
				doc.addImage(team_interest_option_5_status, 'JPEG', (margin+team_interest_margin_offset+scalex_offset*4)+4, 155+vert_offset+total_vert_offset, tickboxsize,tickboxsize);




				doc.setFontSize(textsize);
				doc.text(margin+161, 160+vert_offset+total_vert_offset, "Self-Interest");

		

			doc.setFontSize(19);
			doc.setFontType("bold");
			doc.text(margin, 180+total_vert_offset, "Team Role Preferences");
			doc.setLineWidth(0.5);
			doc.line(margin, 183+total_vert_offset, 200, 183+total_vert_offset);



				doc.setFontType("bold");
				doc.setFontSize(headingsize);
				doc.text(margin, 183+total_vert_offset+prefered_role_offset, "First");
				doc.text(margin, 183+total_vert_offset+prefered_role_offset+6, "Preference");
				doc.setFontType("normal");
					doc.addImage(team_role_option_1, 'JPEG', margin, 183+total_vert_offset+prefered_role_offset+roleimage_y_offset, icon_size,icon_size);
					doc.setFontSize(textsize+2);
					doc.text(margin, 183+total_vert_offset+prefered_role_offset+roleimage_y_offset+roleimage_name_y_offset, team_role_name_1);




				doc.setFontType("bold");
				doc.setFontSize(headingsize);
				doc.text(margin+role_x_offset, 183+total_vert_offset+prefered_role_offset, "Second");
				doc.text(margin+role_x_offset, 183+total_vert_offset+prefered_role_offset+6, "Preference");
				doc.setFontType("normal");
					doc.addImage(team_role_option_2, 'JPEG', margin+role_x_offset, 183+total_vert_offset+prefered_role_offset+roleimage_y_offset, icon_size,icon_size);
					doc.setFontSize(textsize+2);
					doc.text(margin+role_x_offset, 183+total_vert_offset+prefered_role_offset+roleimage_y_offset+roleimage_name_y_offset, team_role_name_2);



				doc.setFontType("bold");
				doc.setFontSize(headingsize);
				doc.text(margin+role_x_offset*2, 183+total_vert_offset+prefered_role_offset, "Least");
				doc.text(margin+role_x_offset*2, 183+total_vert_offset+prefered_role_offset+6, "Preferred Role");
				doc.setFontType("normal");	
					doc.addImage(team_role_option_3, 'JPEG', margin+role_x_offset*2, 183+total_vert_offset+prefered_role_offset+roleimage_y_offset, icon_size,icon_size);
					doc.setFontSize(textsize+2);
					doc.text(margin+role_x_offset*2, 183+total_vert_offset+prefered_role_offset+roleimage_y_offset+roleimage_name_y_offset, team_role_name_3);






			doc.save("Teams101x_peer_assessment.pdf");




			// var documentStructure = {extraversion or introversion', style: 'tableHeader' }],
			// 							[ {

			// 									text:"hello"
			// 							}, {

			// 									text:"world"

			// 							}, {
			// 									text:"fsdfads"
			// 							} ]
			// 					]
			// 			},
			// 			layout: 'noBorders'
			// 		}
			// 		,{
			// 			columns: [

			// 						{
			// 					image:base64_images.sample,
			// 					width:200
			// 				},
			// 						{
			// 					image:base64_images.sample,
			// 					width:200
			// 				}
			// 			]
			// 		}
			// 	],
			// 	styles: {
			// 		header: {
			// 			fontSize: 18,
			// 			bold: true,
			// 			margin: [0, 0, 0, 10]
			// 		},
			// 		subheader: {
			// 			fontSize: 16,
			// 			bold: true,
			// 			margin: [0, 10, 0, 5]
			// 		},
			// 		tableExample: {
			// 			margin: [0, 5, 0, 15]
			// 		},
			// 		tableHeader: {
			// 			bold: true,
			// 			fontSize: 13,
			// 			color: 'black'
			// 		}
			// 	},
			// 	defaultStyle: {
			// 		// alignment: 'justify'
			// 	}

			// }
			// pdfMake.createPdf(documentStructure).download('teams101x_Putting_YourSelf_In_The_Picture.pdf');
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


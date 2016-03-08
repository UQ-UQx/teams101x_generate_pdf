<?php require_once('inc/header.php'); ?>

</head>
<body>
<?php
	$lti->requirevalid();
?>
<h1>Generate PDF</h1>


<!-- Answer a bunch of questions and a pdf will be generated -->

<button class="makepdf">Generate PDF</button>

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
</body>
</html>

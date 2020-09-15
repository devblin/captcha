<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<title>Captcha</title>
	</head>

	<body>
		<div class="container text-center">
			<h1 class="m-5">Captcha</h1>
			<div class="d-flex flex-column align-items-center">
				<div id="alert_parent" style="max-width: 500px" class="alert w-100">
					<button type="button" class="close">&times;</button>
					<span id="alert_msg"></span>
				</div>
				<input
					style="max-width: 400px"
					type="text"
					class="p-2 w-100 m-2"
					id="code_input"
					placeholder="Enter Code"
				/>

				<button
					style="max-width: 400px"
					id="check_btn"
					class="w-100 p-3 m-2 btn btn-primary"
				>
					Check
				</button>
				<div class="m-1">
					<img class="m-1" id="captcha_img" src="/server/captcha.php" />
					<button id="reset_btn" class="m-1 btn btn-warning">Reset</button>
				</div>
			</div>
		</div>
	</body>
</html>

<script>
"use strict";
$("#alert_parent").hide();

class Captcha {
	constructor() {
		this.captcha_url = location.origin + "/server/captcha.php";
		this.check_url = location.origin + "/server/check.php";
	}

	changeAlert = (status, msg) => {
		$("#alert_parent").removeClass("alert-danger", "alert-success");

		if (status == 0) $("#alert_parent").addClass("alert-danger").show();
		else $("#alert_parent").addClass("alert-success").show();

		$("#alert_msg").html(msg);
	};
	reset = () => $("#captcha_img").attr("src", this.captcha_url);
	check = (value, captcha) => {
		let newFormData = new FormData();
		newFormData.append("entered_code", value);

		let beforeSend = () => $("#check_btn").attr("disabled", true).html("Please Wait...");
		let success = (data) => {
			$("#check_btn").attr("disabled", false).html("Check");

			if (data == 1) this.changeAlert(data, "You are human :)");
			else this.changeAlert(data, "You are not human :(");

			$("#code_input").val("");
			captcha.reset();
		}
		$.ajax({
			url: this.check_url,
			type: "POST",
			data: newFormData,
			contentType: false,
			processData: false,
			beforeSend: beforeSend,
			success: success
		});
	};
};

const newCaptcha = new Captcha();
newCaptcha.reset();

$("#reset_btn").click(() => newCaptcha.reset());
$("#check_btn").click(() => {
	const codeValue = $("#code_input").val();
	if (codeValue) newCaptcha.check(codeValue, newCaptcha);
	else newCaptcha.changeAlert(0, "Please enter code.");
});
$(".close").click(() => $("#alert_parent").hide());
</script>

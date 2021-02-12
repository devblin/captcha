"use strict";

$("#alert_parent").hide();

class Captcha {
	constructor() {
		this.captcha_url = location.origin + "/server/captcha.php";
		this.check_url = location.origin + "/server/check.php";
	}

	changeAlert = (status, msg) => {
		$("#alert_parent").removeClass("alert-danger", "alert-success");

		if (status == 0) $("#alert_parent").addClass("alert-danger")
		else $("#alert_parent").addClass("alert-success")

		$("#alert_msg").html(msg);
		$("#alert_parent").show();
	};

	reset = () => {
		$("#captcha_img").attr("src", this.captcha_url);
	};

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

$("#reset_btn").click(function () {
	newCaptcha.reset();
});

$("#check_btn").click(function () {
	const codeValue = $("#code_input").val();
	if (codeValue) {
		newCaptcha.check(codeValue, newCaptcha);
	} else {
		$("#alert_parent").addClass("alert-danger");
		$("#alert_msg").html("Please enter the code.");
		$("#alert_parent").show();
	}
});

$(".close").click(function () {
	$("#alert_parent").hide();
});
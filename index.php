<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Captcha</title>
</head>

<body>
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center vh-100">
        <span id="alert"></span>
        <div style="max-width: 400px;">
            <h1 class="text-center mb-3">Captcha</h1>
            <div class="m-2 form-group text-center text-middle">
                <input type="text" id="inputcode" class="form-control hidealert" placeholder="Enter Code">
            </div>
            <div class="mb-2">
                <img id="captchaimg" alt="Captcha Image">
                <button id="reset" class="btn btn-warning hidealert">Reset</button>
            </div>
            <button id="login" type="submit" class="btn btn-primary w-100 m-0 hidealert">Check</button>
        </div>
    </div>
</body>

</html>
<script>
$("#alert").hide();

class Captcha {
    posturl = "http://localhost/Captcha/check.php";
    imgurl = "http://localhost/Captcha/captcha.php";
    reset = () => {
        $("#captchaimg").attr("src", this.imgurl);
    }
    check = (value, newCall) => {
        let newForm = new FormData();
        newForm.append("enteredcode", value);

        let beforeSend = () => $("#login").attr("disabled", true).html("Please Wait...");
        let success = (data) => {
            $("#login").attr("disabled", false).html("Check");
            if (data == 1) {
                $("#alert").addClass("text-success");
                $("#alert").html("You are human :)");
                $("#alert").show();
            } else {
                $("#alert").addClass("text-danger");
                $("#alert").html("You are not human :(");
                $("#alert").show();
            }
            $("#inputcode").val("");
            newCall.reset();
        }

        $.ajax({
            url: this.posturl,
            type: "POST",
            data: newForm,
            contentType: false,
            processData: false,
            beforeSend: beforeSend,
            success: success
        });
    }
}
let newCap = new Captcha();
newCap.reset();
$("#login").click(function() {
    if ($("#inputcode").val() != "") {
        newCap.check($("#inputcode").val(), newCap);
    } else {
        $("#alert").addClass("text-danger");
        $("#alert").html("Please enter the code");
        $("#alert").show();
    }
});
$(".hidealert").focus(function() {
    $("#alert").removeClass("text-danger", "text-success").html("");
});
$("#reset").click(function() {
    newCap.reset();
});
</script>
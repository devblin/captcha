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

<script src="/js/script.js"></script>

<?php
if (isset($_SESSION)) {

	$unique_id = $_SESSION['unique_id'];
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/message/messagestyle.css'); ?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
	<link rel="stylesheet" href="<? base_url('/assets/message/loading-bar.css'); ?>">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<title>.NEMU Chatting</title>
</head>

<body>
	<section id="main" class="bg-dark">
		<div id="chat_user_list">
			<div id="owner_profile_details">
				<div id="owner_avtar" style="background-image: url('<?= base_url('/assets/img/undraw_profile.svg') ?>'); background-size: 100% 100%">
					<div>
						<div id="online"></div>
					</div>
				</div>
				<div id="owner_profile_text" class="">
					<h6 id="owner_profile_name" class="m-0 p-0"><?= $this->session->userdata('username'); ?></h6>
				</div>
			</div>

			<hr />
			<div id="user_list" class="py-3">
			</div>
		</div>
		<div id="chatbox">
			<div id="data_container" class="">
				<div id="bg_image" style="background-image: url('<?= base_url('/assets/img/bg-chatorder.jpg') ?>'); width: 400px; height: 390px;"></div>
				<h2 class="mt-0">Hallo, Selamat Datang <?= $this->session->userdata('username'); ?></h2>
				<h2>Aplikasi Chat .NEMU</h2>
				<p class="text-center my-2">Tempat dimana kamu berkomunikasi dengan <br> Admin mengenai pesananmu</p>
			</div>
			<div class="chatting_section" id="chat_area" style="display: none">
				<div id="header" class="py-2">
					<div id="name_details" class="pt-2">
						<div id="chat_profile_image" class="mx-2" style="background-size: 100% 100%">
							<div id="online"></div>
						</div>
						<div id="name_last_seen">
							<h6 class="m-0 pt-2"></h6>
							<p class="m-0 py-1"></p>
						</div>
					</div>

				</div>
				<div id="chat_message_area">

				</div>
				<div id="messageBar" class="py-4 px-4">
					<div id="textBox_attachment_emoji_container">
						<div id="text_box_message">
							<input type="text" maxlength="500" name="txt_message" id="messageText" class="form-control" placeholder="Tuliskan pesanmu..">
						</div>
						<div id="text_counter">
							<p id="count_text" class="m-0 p-0"></p>
						</div>
					</div>
					<div id="sendButtonContainer">
						<button class="btn" id="send_message">
							<span class="material-icons">send</span>
						</button>
					</div>
				</div>
			</div>
		</div>

		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
		<script type="text/javascript" src="<?= base_url('/assets/js/message/main.js'); ?>"></script>
</body>

</html>
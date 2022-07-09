$(document).ready(function () {
	var oldDate, newDate, days, hours, min, sec, unique_id, bg_image, inter, inter3, inter2,
		chatBox = document.getElementById('chat_message_area'),
		main = document.getElementById('main'),
		owenerProfileBio = document.getElementById('owner_profile_bio'),
		dob, phone, addr, bio;

	const MAIN_PLAY = gsap.timeline({ paused: true });
	MAIN_PLAY.from("#main", { duration: 0.5, opacity: 0 });

	//Main funtion which will run at the time of page load
	//UserSidebarIn
	function barIn() {
		$('#details_of_user').css('width', '20%');
		$('#chatbox').css('width', '55%');
		$('#details_of_user').children().show();
	}
	//UserSidebarOut
	function barOut() {
		$('#details_of_user').children().hide();
		$('#details_of_user').css('width', '0');
		$('#chatbox').css('width', '75%');
	}

	//getting all user list except me
	function getUserList() {
		return new Promise(function (resolve, reject) { //Creating new Promise Chain
			$.ajax({
				url: 'Message/allUser',
				type: 'get',
				async: false,
				success: function (data) {
					if (data != "") {
						resolve(data);
					}
				}
			})
		}).then(function (data) { //This function setting the user list
			document.getElementById('user_list').innerHTML = data; //setting data to the user list
			$.get('Message/ownerDetails', function (data) {
				jsonData = JSON.parse(data);
				dob = jsonData[0]['dob'];
				phone = jsonData[0]['phone'];
				addr = jsonData[0]['address'];
				bio = jsonData[0]['bio'];
				if (dob.length != 0 && addr.length != 0 && phone.length != 0 && bio.length != 0) {
					owenerProfileBio.classList.remove('text-warning');
					owenerProfileBio.innerHTML = (bio.length > 28) ? bio.slice(0, 28) + "..." : bio;
				} else {
					owenerProfileBio.innerHTML = "Profile isn't completed";
					owenerProfileBio.classList.add('text-warning');
				}
			})
			$('.innerBox').click(function () {

				barIn();
				$('.chatting_section').css('display', '');

				unique_id = $(this).find('#user_avtar').children('#hidden_id').val();
				bg_image = $(this).find('#user_avtar').css('background-image').split('"')[1];

				clearInterval(inter);
				clearInterval(inter3);

				getBlockUserData();
				setInterval(getBlockUserData, 100);

				getUserDetails(unique_id);
				inter2 = setInterval(getUserList, 1000);
				inter3 = setInterval(function () {
					getUserDetails(unique_id)
				}, 1000);
				sendUserUniqIDForMsg(unique_id, bg_image);

				inter = setInterval(function () {
					sendUserUniqIDForMsg(unique_id, bg_image);
				}, 100);
			})
			$('.innerBox').mouseover(function () {
				clearInterval(inter2);
			})
			$('.innerBox').mouseleave(function () {
				inter2 = setInterval(getUserList, 1000);
			})
		})
	}
	function getUserDetails(uniq_id) {
		$.post('Message/getIndividual', { data: uniq_id }, function (data) {
			var res_data = JSON.parse(data);
			setUserDetails(res_data);
		})
	}
	function setUserDetails(data) {
		var user_name = `${data[0]['user_fname']} ${data[0]['user_lname']}`;
		var status = data[0]['user_status'];
		var avtar = `../upload/${data[0]['user_avtar']}`;
		var last_seen = data[0]['last_logout'];
		offlineOnlineIndicator(status, last_seen);
		$('#name_last_seen h6').html(user_name);
		$('#chat_profile_image').css('background-image', `url(${avtar})`);
		$('#new_message_avtar').css('background-image', `url(${avtar})`);
		$('#mail_link').attr('href', `mailto:${data[0]['user_email']}`);

		$('#user_details_container_avtar').css('background-image', `url(${avtar})`);
		$('#details_of_user h5').html(user_name);
		(data[0]['bio'].length > 1) ? $('#details_of_bio').html(data[0]['bio']) : $('#details_of_bio').html("--Not Given--");

		$('#details_of_created').html(`Created at : ${data[0]['created_at']}`);
		$('#details_of_email').html(`<span><i class="fas fa-envelope text-dark pr-2"></i></span>${data[0]['user_email']}`);

		(data[0]['dob'].length > 1) ?
			$('#details_of_birthday').html(`<span><i class="fas fa-birthday-cake text-dark pr-2"></i></span>${data[0]['dob']}`) :
			$('#details_of_birthday').html(`<span><i class="fas fa-birthday-cake text-dark pr-2"></i></span>--Not Given--`);

		(data[0]['phone'].length > 1) ?
			$('#details_of_mobile').html(`<span><i class="fas fa-mobile-alt text-dark pr-2"></i></span>${data[0]['phone']}`) :
			$('#details_of_mobile').html(`<span><i class="fas fa-mobile-alt text-dark pr-2"></i></span>--Not Given--`);

		(data[0]['address'].length > 1) ?
			$('#details_of_location').html(`<span><i class="fas fa-map-marker-alt text-dark pr-2"></i></span>${data[0]['address']}`) :
			$('#details_of_location').html(`<span><i class="fas fa-map-marker-alt text-dark pr-2"></i></span>--Not Given--`);


	}

	function offlineOnlineIndicator(data, last_seen) {
		if (data == 'active') {
			$('#name_last_seen p').html("Active now");
			$("#chat_profile_image #online").show();
		} else {
			$("#chat_profile_image #online").hide();
			getLastSeen(last_seen);
		}
	}
	function getLastSeen(data) {
		var { hours, min, sec } = calculateTime(data);
		if (days > 0) {
			$('#name_last_seen p').html(`Last active on ${data}`);
		}
		else {
			(hours > 0) ? $('#name_last_seen p').html(`Last seen at ${hours} hours ${min} minutes ago`) :
				(min > 0) ? $('#name_last_seen p').html("Last seen at " + min + " minutes ago") :
					$('#name_last_seen p').html("Last seen just now");
		}
	}
	function calculateTime(data) {
		oldDate = new Date(data).getTime();
		newDate = new Date().getTime();
		differ = newDate - oldDate;
		days = Math.floor(differ / (1000 * 60 * 60 * 24));
		hours = Math.floor((differ % (1000 * 60 * 60 * 24)) / (60 * 60 * 1000));
		min = Math.floor((differ % (1000 * 60 * 60)) / (60 * 1000));
		sec = Math.floor((differ % (1000 * 60)) / 1000);
		var obj = {
			hours: hours,
			min: min,
			sec: sec
		};
		return obj;
	}
	//sending unique_id which is clicked for messages
	function sendUserUniqIDForMsg(uniq_id, bg_image) {
		$.post('getmessage', { data: uniq_id, image: bg_image }, function (data) {
			setMessageToChatArea(data, bg_image);//setting messages to the chatting section
		});
	}
	function setMessageToChatArea(data, bg_image) {
		scrollToBottom();
		var res_data;
		if (data.length > 5) {
			$('#chat_message_area').html(data);
		} else {
			var profileName = $('#name_last_seen h6').html();
			$.ajax({
				url: 'Message/setNoMessage',
				type: 'post',
				async: false,
				data: { image: bg_image, name: profileName },
				success: function (data) {
					res_data = data;
				}
			})
			$('#chat_message_area').html(res_data);
		}
	}
	$('#chat_message_area').mouseenter(function () {
		chatBox.classList.add('active');
	});
	$('#chat_message_area').mouseleave(function () {
		chatBox.classList.remove('active');
	});
	function scrollToBottom() {
		inter4 = setInterval(() => {
			if (!chatBox.classList.contains('active')) {
				chatBox.scrollTop = chatBox.scrollHeight;
			}
		});
	}
	$('#search').keyup(function (e) {
		var user = document.querySelectorAll('.user');
		var name = document.querySelectorAll('#user_list h6');
		var val = this.value.toLowerCase();
		if (val.length > 0) {
			clearInterval(inter2);
			for (let i = 0; i < user.length; i++) {
				nameVal = name[i].innerHTML
				if (nameVal.toLowerCase().indexOf(val) > -1) {
					user[i].style.display = '';
				} else {
					user[i].style.display = 'none';
				}
			}
		} else {
			inter2 = setInterval(getUserList, 1000);
		}
	});
	function getCharLength() {
		const MAX_LENGTH = 200;
		var len = document.getElementById('messageText').value.length;
		if (len <= MAX_LENGTH) {
			$('#count_text').html(`${len}/200`);
		}
	}
	setInterval(getCharLength, 10);
	$('#logout').click(function (e) {
		e.preventDefault();
		var date = new Date();
		date = new Date(date);
		date = date.toLocaleString();
		$.ajax({
			url: 'logout',
			type: 'post',
			data: "date=" + date,
			success: function (res) {
				location.href = res;
			}
		})
	});
	//send message after button click
	$('#send_message').click(function (e) {
		var d = new Date(),
			messageHour = d.getHours(),
			messageMinute = d.getMinutes(),
			messageSec = d.getSeconds(),
			messageYear = d.getFullYear(),
			messageDate = d.getDate(),
			messageMonth = d.getMonth() + 1,
			actualDateTime = `${messageYear}-${messageMonth}-${messageDate} ${messageHour}:${messageMinute}:${messageSec}`;
		var message = $('#messageText').val();
		var data = {
			message: message,
			datetime: actualDateTime,
			uniq: unique_id
		}
		var jsonData = JSON.stringify(data);
		$.post('sent', { data: jsonData }, function (data) {
			$('#messageText').val('');
		})
	})
	// my details edit icon
	$('#edit_icon').click(function () {
		$('#main').addClass('blur');
		$('#update_container').show();
		$('#update_bio').focus();
		$('#dob').val(dob);
		$('#phone_num').val(phone);
		$('#update_bio').val(bio);
		$('#address').val(addr);
	})
	$('#update_container i').click(function () {
		$('#main').removeClass('blur');
		$('#update_container').hide();
	})
	//update form container submit event
	$('#form_details').on('submit', function (e) {
		e.preventDefault();
		var newDate = $('#dob').val();
		var newPhone = $('#phone_num').val();
		var newAddress = $('#address').val();
		var newBio = $('#update_bio').val();
		$.post('Message/updateBio', { dob: newDate, phone: newPhone, address: newAddress, bio: newBio }, function (data) {
			$('#main').removeClass('blur');
			$('#update_container').hide();
		})
	})
	$('#details_btn').click(function () {
		var bar = document.getElementById('details_of_user').style;
		if (bar.width == "20%") {
			barOut();
		} else {
			barIn();
		}
	})
	$('#btn_block').click(function () {
		var d = new Date(),
			messageHour = d.getHours(),
			messageMinute = d.getMinutes(),
			messageSec = d.getSeconds(),
			messageYear = d.getFullYear(),
			messageDate = d.getDate(),
			messageMonth = d.getMonth() + 1,
			actualDateTime = `${messageYear}-${messageMonth}-${messageDate} ${messageHour}:${messageMinute}:${messageSec}`;
		if (this.innerHTML == "Block User") {
			$.post('Message/blockUser', { time: actualDateTime, uniq: unique_id })
		} else {
			$.post('Message/unBlockUser', { uniq: unique_id })
		}
	})
	//working on block & unblock program
	function getBlockUserData() {
		$.post('Message/getBlockUserData', { uniq: unique_id }, function (data) {
			var jsonData = JSON.parse(data);
			if (jsonData.length == 1) {
				for (var i = 0; i < jsonData.length; i++) {
					if (jsonData[i]['blocked_from'] == unique_id) {
						$('#messageText').attr('disabled', '');
						$('#messageText').attr('placeholder', 'This user is not receiving messages at this time.');
						$('#messageText').css('cursor', 'no-drop');
						$('#btn_block').html('Block User');
						$('#send_message').attr('disabled', '');
						$('#send_message').css('cursor', 'no-drop');
					} else {
						$('#messageText').attr('disabled', '');
						$('#messageText').attr('placeholder', 'You have blocked this user');
						$('#btn_block').html('Unblock User');
						$('#messageText').css('cursor', 'no-drop');

						$('#send_message').attr('disabled', '');
						$('#send_message').css('cursor', 'no-drop');
					}
				}
			} else if (jsonData.length == 2) {
				$('#messageText').attr('disabled', '');
				$('#messageText').attr('placeholder', 'You both are blocked each other');
				$('#btn_block').html('Unblock User');
				$('#messageText').css('cursor', 'no-drop');
				$('#send_message').attr('disabled', '');
				$('#send_message').css('cursor', 'no-drop');
			} else {
				$('#messageText').removeAttr('disabled');
				$('#messageText').attr('placeholder', 'Start Typing. . . .');
				$('#btn_block').html('Block User');
				$('#messageText').css('cursor', '');
				$('#send_message').removeAttr('disabled');
				$('#send_message').css('cursor', '');
			}
		})
	}
	Pace.on('done', function () {
		MAIN_PLAY.play();
	})
	getUserList(); //Calling the root function without interval
	inter2 = setInterval(getUserList, 1000); //Calling the root function with interval
})


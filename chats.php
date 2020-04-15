<?php
  session_start();
  require 'connection.php';
  // var_dump($_SESSION['user_id']);
  if (!$_SESSION['user_id']) {
    header('location: register.php');
  }

  $stmt = $db->prepare("select * from messages");
  $stmt->execute();
  $rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
	</head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input type="text" placeholder="Search..." name="" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="card-body contacts_body">
						<ui class="contacts">
						<li class="active">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Khalid</span>
									<p>Kalid is online</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="" class="rounded-circle user_img">
									<span class="online_icon offline"></span>
								</div>
								<div class="user_info">
									<span>Taherah Big</span>
									<p>Taherah left 7 mins ago</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Sami Rafi</span>
									<p>Sami is online</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="" class="rounded-circle user_img">
									<span class="online_icon offline"></span>
								</div>
								<div class="user_info">
									<span>Nargis Hawa</span>
									<p>Nargis left 30 mins ago</p>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="" class="rounded-circle user_img">
									<span class="online_icon offline"></span>
								</div>
								<div class="user_info">
									<span>Rashid Samim</span>
									<p>Rashid left 50 mins ago</p>
								</div>
							</div>
						</li>
						</ui>
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Chat with Khalid</span>
									<p>1767 Messages</p>
								</div>
								<div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div>
							</div>
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div>
						</div>
						<div class="card-body msg_card_body">
              <?php foreach ($rows as $key => $row): ?>
    							<div class="d-flex <?php echo ($row['user_id'] == $_SESSION['user_id']) ? 'justify-content-end' : 'justify-content-start' ?> mb-4">
    								<div class="<?php echo ($row['user_id'] == $_SESSION['user_id']) ? 'msg_cotainer_send' : 'msg_cotainer' ?>">
    									<?php echo $row['messages']; ?>
    								</div>
    							</div>
              <?php endforeach; ?>
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
                  <input type="hidden" class="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    <script src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.mCustomScrollbar.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="style.js"></script>

    <script src="js/pusher.min.js"></script>
    <script>

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('717103058a8b091a45b7', {
        cluster: 'eu',
        forceTLS: true
      });

      var channel = pusher.subscribe('my-channel');
      channel.bind('my-event', function(data) {
        //alert(data.message);
        if ($('.user_id').val() == data.user_id ) {
          $('.msg_card_body').append(`
            <div class="d-flex justify-content-end mb-4">
              <div class="msg_cotainer_send">
                ${(data.message)}
              </div>
            </div>
            `);
          }else{
            $('.msg_card_body').append(`
              <div class="d-flex justify-content-start mb-4">
                <div class="msg_cotainer">
                  ${(data.message)}
                </div>
              </div>
              `);
          }

      });

      $(document).on('click','.send_btn',function (){
        var type_msg = $('.type_msg').val();
        var user_id  = $('.user_id').val();

        $.ajax({
          url: 'message.php',
          method:'POST',
          data : {message:type_msg,user_id:user_id},
          success: function () {
            $('.type_msg').val('');
          },
          error: function () {
            alert('error');
          }
        });
      });
      $(document).on('keypress',function(e) {
          if(e.which == 13) {
            var type_msg = $('.type_msg').val();
            var user_id  = $('.user_id').val();

            $.ajax({
              url: 'message.php',
              method:'POST',
              data : {message:type_msg,user_id:user_id},
              success: function () {
                $('.type_msg').val('');
              },
              error: function () {
                alert('error');
              }
            });
         }
      });
    </script>

	</body>
</html>

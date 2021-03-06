<div class="content_wrapper <?php echo $this->params['controller']; ?> main">
	<div class="sideContainer">
		<div class="topSide">
			<div class="profileDetail">
				<div class="avatar">
					<img src="/chat3/img/avatar.png">
				</div>
				<div class="profileInfo">
					<span><p class="fullName">Jo Antipala</p></span>
					<p class="mood">Giggles giggles...</p>
				</div>
				<div class="searchContainer">
					<div class="searchContact">
						<i class="fa fa-search" aria-hidden="true"></i>
						<input type="text" name="searchContact" placeholder="Search Contact">
						<hr>
					</div>
				</div>
				<div class="menuContainer">
					<div class="menu">
						<i class="fa fa-address-book-o" aria-hidden="true"></i>
						<i class="fa fa-cog" aria-hidden="true"></i>
						<i class="fa fa-phone" aria-hidden="true"></i>
						<i class="fa fa-plus" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="botSide">
			<div class="contactList">
				<ul>
				<?php for ($i = 1; $i <= 10; $i++): ?>
					<li>
						<a href="">
							<div class="itemContainer">
								<div class="itemImageContainer">
									<img src="/chat3/img/avatar.png">
								</div>
								<div class="itemInfo">
									<span><p class="contactName">Name 1</p></span>
									<p class="contactStatus">Online</p>
								</div>
							</div>
						</a>
					</li>
				<?php endfor; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="mainChatContainer">
		<div class="chatHeaderContainer">
			<div class="chatHeader">
				<div class="currentContactContainer">
					<div class="currentContact">
						<div class="currentContactAvatar">
							<img src="/chat3/img/avatar.png">
						</div>
						<div class="currentContactInfo">
							<span><p class="fullName">Jo Antipala</p></span>
							<p class="contactStatus">Giggles giggles...</p>
						</div>
					</div>
				</div>
				<div class="currentContactMenu">
					<i class="fa fa-video-camera" aria-hidden="true"></i>
					<i class="fa fa-phone" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<div class="chatContent">
			<ul class="messages">
				<?php foreach($messageList as $index => $value): ?>
					<?php if ($value['from_id'] == $userID): ?>
						<li class="message left appeared mine">
							<div class="text_wrapper">
								<div class="text"><?php echo $value['message']; ?></div>
							</div>
						 </li>
					<?php else: ?>
						<li class="message left appeared others">
							<span class="sender"><?php echo $value['name']; ?></span>
							<div class="avatar"></div>
							<div class="text_wrapper">
								<div class="text"><?php echo $value['message']; ?></div>
							</div>
						 </li>
					<?php endif; ?>

				<?php endforeach; ?>
			</ul>
			
			<div class="bottom_wrapper clearfix" data-name="<?php echo $userName ?>" data-id="<?php echo $userID ?>">
				<div class="message_input_wrapper">
					<input id="messageInput" type="text" class="message_input" placeHolder="Message" autofocus="autofocus" />
				</div>
				<div class="send_message">
					<div class="icon">
					</div>
					<div class="text" id="send">Send</div>
				</div>
			</div>
		</div>
	</div>
</div>
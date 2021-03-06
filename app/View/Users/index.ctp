<?php date_default_timezone_set('Asia/Manila'); ?>
<div class="content_wrapper <?php echo strtolower($this->params['controller']); ?> main">
	<div class="sideContainer">
		<div class="topSide">
			<div class="profileDetail">
				<div class="avatar">
					<img src="/chat3/img/avatar.png">
				</div>
				<div class="profileInfo">
					<span><p class="fullName"><?php echo $userName; ?></p></span>
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
		<div class="scrollbar botSide" id="style-2">
			<div class="force-overflow contactList">
				<ul>
				<?php foreach($usersList as $index => $value): ?>
					<?php if ($userID != $value['id']): ?>
						<li data-id="<?php echo $value['id'] ?>">
						<?php ?>
							<a href="" class="<?php echo strtotime($value['last_login_time']) < strtotime('-10 minutes') || $value['status'] == 0 ? 'off' : 'on'; ?>"
							data-id="<?php echo $value['id'] ?>"
							data-name="<?php echo $value['name'] ?>">
								<div class="itemContainer">
									<div class="itemImageContainer">
										<img src="/chat3/img/avatar.png">
									</div>
									<div class="itemInfo">
										<span><p class="contactName"><?php echo $value['name'] ?></p></span>
										<p class="contactStatus"><?php echo strtotime($value['last_login_time']) < strtotime('-10 minutes') || $value['status'] == 0 ? 'Offline' : 'Online'; ?></p>
									</div>
								</div>
							</a>
						</li>
				<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="mainChatContainer">
		<div class="chatHeaderContainer" style="">
			<div class="chatHeader">
				<div class="currentContactContainer">
					<div class="currentContact">
						<div class="currentContactAvatar">
							<img src="/chat3/img/avatar.png">
						</div>
						<div class="currentContactInfo" data-id="" data-name="">
							<span><p class="fullName">Ado</p></span>
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
		<div class="chatContentContainer scrollbar" id="style-2">
			<div class="chatContent" class="force-overflow">
				<ul class="messages">
					
				</ul>
			</div>
		</div>
		<div class="mainChatTextArea">
			<div class="hr">
				<hr>
			</div>
			<div class="inputArea">
				<div class="row">
					<div class="col-md-8">
						<div class="bottom_wrapper clearfix" data-name="<?php echo $userName ?>" data-id="<?php echo $userID ?>" data-to="<?php ?>">
							<div class="message_input_wrapper">
								<input id="messageInput" type="text" class="message_input" placeholder="Message" autofocus="autofocus">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="send_message">
							<div class="icon">
							</div>
							<div class="text" id="send">Send</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
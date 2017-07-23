<div class="content_wrapper <?php echo $this->params['controller']; ?>">
	<div>
		<ul>
		<?php foreach($usersList as $index => $value): ?>
			<li>
				<a href="" class="<?php echo $value['status'] ? 'on' : 'off'; ?>"
				data-id="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a>
			</li>
		<?php endforeach; ?>
		</ul>
	</div>
	<div class="chat_window">
		<div class="top_menu">
			<div class="buttons">
				<div class="button close">
				</div>
				<div class="button minimize">
				</div>
				<div class="button maximize">
				</div>
			</div>
		<div class="title">Chat</div>
		</div>
		
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
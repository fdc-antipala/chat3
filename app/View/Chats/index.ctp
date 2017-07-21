<div class="content_wrapper <?php echo $this->params['controller']; ?>">
	
	<div class="message_box">
		<ul id="messages">
		<?php foreach($userlist as $index => $value): ?>
				<li> <strong><?php echo $value['name']; ?></strong> : <?php echo $value['message']; ?> </li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="form-inline" id="messageForm" data-name="<?php echo $userName ?>" data-id="<?php echo $userID ?>">
		<input id="messageInput" type="text" class="input-xxlarge" placeHolder="Message" autofocus="autofocus" />
	
		<button id="send">Send</button>
	</div>
		
</div>
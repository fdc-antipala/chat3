<div class="content_wrapper <?php echo $this->params['controller']; ?>">
	<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand" href="index.php">NodeJS_PHP</a>
					
				</div>
			</div>
		</div>
		
		<div class="container">
			<h1>Integration test NodeJS + PHP</h1>
			<p>
				This is a simple application, showing integration between nodeJS and PHP.
			</p>
			
			<form class="form-inline" id="messageForm">
				<input id="nameInput" type="text" class="input-medium" placeholder="Name" />
				<input id="messageInput" type="text" class="input-xxlarge" placeHolder="Message" />
			
				<input type="submit" value="Send" />
			</form>
			
			<div>
				<ul id="messages">
				<?php foreach($userlist as $index => $value): ?>
						<li> <strong><?php echo $value['name']; ?></strong> : <?php echo $value['message']; ?> </li>
					<?php endforeach; ?>
				</ul>
			</div>
			<!-- End #messages -->
		</div>
</div>
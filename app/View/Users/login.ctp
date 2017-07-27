<div class="content_wrapper <?php echo $this->params['controller']; ?>">
	<div class="form-login">
		<div class="form_header">
			<h1>Sign in</h1>
			<p>abcdefghijklmnopqrstuvwxyz</p>
		</div>
		<?php echo $this->Form->create('Users', array('url' => array('controller' => 'Users'))); ?>
			<?php
				echo $this->Form->inputs(array(
					'legend' => __(''),
					'username' => array(
						'autofocus' => 'autofocus',
						'label' => false,
						'required' => false,
						'div' => array('class' => 'form-group'),
						'class' => 'form-control',
						'placeholder' => 'Username'
					),
					'password' => array(
						'label' => false,
						'required' => false,
						'div' => array('class' => 'form-group'),
						'class' => 'form-control',
						'placeholder' => 'Password'
					),
					'submit' => array(
						'label' => false,
						'type' => 'submit',
						'name' => 'login',
						'div' => array('class' => 'form-group'),
						'class' => 'form-control btn btn-success'
					)
				));
			?>
		<?php echo $this->Form->end(); ?>
		<a href="<?php echo $this->Html->url('/users/register'); ?>">Create an account</a>
	</div>
</div>
<input type="text" name="sample" id="sample">
<script>
	(function(){
		$(document).ready(function(){
			String.prototype.splice = function(idx, rem, str) {
			    return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
			};
			var count = 0;
			var theLength = 0;
			$('#sample').keyup(function(text){

				var theText = $('#sample').val();
				console.log(theLength);

				if ($.isNumeric(text.key))
					theLength++;

				if (theLength > 2 && count == 0){
					var _theText = theText.splice(2, 0, "/");
					$('#sample').val(_theText);
					count++;
				}
				if (theText == '')
					theLength = 0;

			});
			
			$('#sample').keyup(function(event){
				// console.log(event.key);
			});
		});
	})();
</script>
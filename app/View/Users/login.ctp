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
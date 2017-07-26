<div class="form-register">
	<center><h1>Register</h1></center>
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
				'name' => array(
					'label' => false,
					'required' => false,
					'div' => array('class' => 'form-group'),
					'class' => 'form-control',
					'placeholder' => 'Full name'
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
					'name' => 'register',
					'div' => array('class' => 'form-group'),
					'class' => 'form-control btn btn-success'
				)
			));
		?>
	<?php echo $this->Form->end(); ?>
	<a href="<?php echo $this->Html->url('/users/login'); ?>">Login</a>
</div>
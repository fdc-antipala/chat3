<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->css('style');
		echo $this->Html->css('chat');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->script('jquery-3.1.1');

		if ($this->params['action'] != 'login' && $this->params['action'] != 'register') {
			echo $this->Html->script('node_modules/socket.io/node_modules/socket.io-client/dist/socket.io');
			echo $this->Html->script('nodeClient');
		}
	?>
</head>
<body id="<?php echo $this->params['controller'] . '_' . $this->params['action']; ?>">
	<div id="container">
		<!-- <div id="header"> -->
		<?php if ($this->action !== 'login' && $this->action != 'register'): ?>
		<?php echo $this->element('header'); ?>
		<?php endif; ?>
		<!-- </div> -->
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<p>
				<?php // echo "&#x24B8 Copyright" ?>
			</p>
		</div>
	</div>
</body>
</html>

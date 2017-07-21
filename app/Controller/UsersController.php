<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function index () {
		$userlist = $this->Message->find('all');
		// $this->_log($userlista);
		$this->set('userlist', array_column($userlist, 'Message'));
	}

	/**
	 * Insert New Message to Db.
	 */
	public function insertNewMessage () {
		$this->autoRender = false;

		if ($this->Message->save($this->request->data))
			echo 'save';
	}
}
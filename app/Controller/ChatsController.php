<?php

App::uses('AppController', 'Controller');

class ChatsController extends AppController {

	public function index () {
		
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
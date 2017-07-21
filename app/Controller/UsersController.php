<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function index () {

		if(!$this->isLogin())
			$this->redirect(array('action' => 'login'));

		$messageList = $this->Message->find('all');
		$this->set('messageList', array_column($messageList, 'Message'));

		$usersList = $this->Users->find('all');
		$this->set('usersList', array_column($usersList, 'Users'));

		$this->set('userName', $this->Session->read('Users.username'));
		$this->set('userID', $this->Session->read('Users.id'));
	}

	public function register () {
		if ($this->request->is('post') && !empty($this->request->data)) {
			
			if ($this->Users->save($this->request->data)) {
				$this->Session->setFlash('Success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Error');
			}
		}
	}

	public function login () {

		if ($this->request->is('post') && !empty($this->request->data)) {
			
			$result = $this->Users->find('first', array(
				'conditions' => array(
					'username' => $this->request->data['Users']['username'],
					'password' => $this->request->data['Users']['password']
				),
			));

			if (!empty($result)) {

				$this->Session->write('Users.isLogin', true);
				$this->Session->write('Users.username', $this->request->data['Users']['username']);
				$this->Session->write('Users.id', $result['Users']['id']);

				$this->redirect(array(
					'controller' => 'users', 'action' => 'index' , 'login' => 'true'
				));

			}
		}
	}

	public function logout () {
		$this->Session->delete('Users.isLogin');
		$this->redirect(array('action' => 'index'));
	}
}
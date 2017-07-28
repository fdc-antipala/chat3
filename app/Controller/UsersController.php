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

	public function getMessages () {
		$this->autoRender = false;
		$req = $this->request->data;
		$from_id = $req['from_id'];
		$to_id = $req['to_id'];
		$messageList = $this->Message->query("SELECT *
										FROM messages
										WHERE from_id = '$from_id' AND to_id = '$to_id'
										UNION
										SELECT *
										FROM messages
										WHERE to_id = '$from_id' AND from_id = '$to_id'");

		// $conditions = array(
		// 	'from_id' => 1,//$req['from_id'],
		// 	'to_id' => 2//$req['to_id']
		// );
		// $messageList = $this->Message->find('all', array('conditions' => $conditions));
		// $this->_log(array_column($messageList, 'Message'));
		// $this->_log(array_column($messageList, 0));
		
		// exit();
		if ($messageList)
			return json_encode(array_column($messageList, 0));
		else
			return json_encode($result['error'] = 'empty');

	}

	public function getMessageDB () {

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

	/**
	*	update last login time...
	*/
	public function updateLastLoginTime () {
		date_default_timezone_set('Asia/Manila');
		$this->autoRender = false;

		$this->Users->id = $this->Users->field('id', array('id' => $this->request->data['userID']));
		if ($this->Users->id) {
			$this->Users->saveField('last_login_time', date("Y-m-d H:i:s"));
			$this->Users->saveField('status', 1);
		}
	}

	/**
	*	update status...
	*/
	public function updateLogoutStatus () {
		$this->autoRender = false;

		$this->Users->id = $this->Users->field('id', array('id' => $this->request->data['userID']));
		if ($this->Users->id) {
			$this->Users->saveField('status', 0);
			$this->logout();
		}
	}
}
<?php

use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
	public function indexAction()
	{
		// force session to be opened
		if( ! $this->session->has("ip")) $this->response->redirect("/index");

		// get list of users
		$users = Users::find();

		// send data to the view
		$this->view->users = $users;
	}

	public function addAction()
	{
	}

	public function addsubmitAction()
	{
		// get variables from POST
		$id = $this->request->get('id');
		$ip = $this->request->get('ip');
		$text = $this->request->get('text');
		$inserted = $this->request->get('inserted');

		// validate no fields are empty
		if(empty($id) || empty($ip) || empty($text)) {
			die("You need to fill of the required fields");
		}

		// update the user in the DB
		$user = Users::findFirst($id);
		$user->id = $id;
		$user->ip = $ip;
		if( ! empty($text)) $user->text= $text;
		$user->save();

		// redirect to user list
		$this->response->redirect('/users');
	}

		// redirect to user list
		$this->response->redirect('/users');
	}
}
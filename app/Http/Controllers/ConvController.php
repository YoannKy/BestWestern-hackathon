<?php

namespace App\Http\Controllers;
use Cartalyst\Sentinel\Users\IlluminateUserRepository;
use Illuminate\Http\Request;
use Sentinel;
use stdClass;
use TBMsg;
use Session;

class ConvController extends Controller {

	/** @var Cartalyst\Sentinel\Users\IlluminateUserRepository */
	protected $userRepository;

	public function __construct() {
		// Dependency Injection
		$this->userRepository = app()->make('sentinel.users');
	}

	public function index() {
		$user = Sentinel::getUser();
		$convs = TBMsg::getUserConversations($user->id);
		return view('Conv.index', ['convs' => $convs]);
	}

	public function show($convId) {
		$user = Sentinel::getUser();
		$conv = TBMsg::getConversationMessages($convId, $user->id);

		$history = [];
		$getNumOfParticipants = $conv->getNumOfParticipants();
		$participants = $conv->getAllParticipants();
		$messages = $conv->getAllMessages();
		foreach ($messages as $message) {
			$msg = new stdClass();
			$msg->content = $message->getContent();
			$msg->senderId = $message->getSender();
			$msg->status = $message->getStatus();
			$msg->created = $message->getCreated();
			TBMsg::markMessageAsRead($message->getId(),$user->id);
			array_push($history, $msg);
		}
		$id = Sentinel::getUser()->id;
		$unread = TBMsg::getNumOfUnreadMsgs($id);
		Session::put('conv', $unread);
		return view('Conv.show', ['messages' => $history, 'convId' => $convId]);
	}

	public function add(Request $request, $convId) {
		$user = Sentinel::getUser();
		$userId = $user->id;
		$conv = TBMsg::addMessageToConversation($convId, $userId, $request->input('message'));
		return redirect('/convs/' . $convId);
	}

	public function create($userId) {
		$user = Sentinel::getUser();
		$conv = TBMsg::createConversation(array($user->id, $userId));
		return redirect('/convs/' . $conv['convId']);
	}


}

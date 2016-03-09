<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Sentinel;
use stdClass;
use TBMsg;

class ConvController extends Controller {

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
			array_push($history, $msg);
		}
		return view('Conv.show', ['messages' => $history, 'convId' => $convId]);
	}

	public function add(Request $request, $convId) {
		$user = Sentinel::getUser();
		$userId = $user->id;
		$conv = TBMsg::addMessageToConversation($convId, $userId, $request->input('message'));
		return redirect('/convs/' . $convId);
	}
}

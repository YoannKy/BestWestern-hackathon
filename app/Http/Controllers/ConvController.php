<?php

namespace App\Http\Controllers;
use App\Models\Hostel;
use App\Models\User;
use Cartalyst\Sentinel\Users\IlluminateUserRepository;
use Illuminate\Http\Request;
use Sentinel;
use Session;
use stdClass;
use TBMsg;

class ConvController extends Controller {

	/** @var Cartalyst\Sentinel\Users\IlluminateUserRepository */
	protected $userRepository;

	public function __construct() {
		// Dependency Injection
		//$this->userRepository = app()->make('sentinel.users');
		$this->userRepository = User::all();
	}

	public function index() {
		$user = Sentinel::getUser();
		$cities = Hostel::getHostels();
		$convs = TBMsg::getUserConversations($user->id);
		$participants = [];
		$participant = "";
		foreach ($convs as $conv) {
			$participants = array_merge($participants, $conv->getAllParticipants());
			//making sure each user appears once
			$participants = array_unique($participants);
			$participant = User::whereIn('id', $participants)->where('id', '!=', $user->id)->first();
		}
		$hostel = Hostel::getHostel(null);
		$city = "";
		if (isset($hostel[0]) && isset($hostel[0]->city)) {
			$city = $hostel[0]->city;
		}
		return view('Conv.index', ['convs' => $convs, 'user' => $participant, 'cities' => $cities, 'cityDefault' => $city]);
	}

	public function show($convId) {
		$user = Sentinel::getUser();
		$conv = TBMsg::getConversationMessages($convId, $user->id);
		$participants = [];
		$participants = array_merge($participants, $conv->getAllParticipants());
		//making sure each user appears once
		$participants = array_unique($participants);
		$participant = User::whereIn('id', $participants)->where('id', '!=', $user->id)->first();
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
			TBMsg::markMessageAsRead($message->getId(), $user->id);
			array_push($history, $msg);
		}
		$id = Sentinel::getUser()->id;
		$unread = TBMsg::getNumOfUnreadMsgs($id);
		Session::put('conv', $unread);
		return view('Conv.show', ['messages' => $history, 'convId' => $convId, 'participant' => $participant]);
	}

	public function add(Request $request, $convId) {
		$user = Sentinel::getUser();
		$userId = $user->id;
		if ($user->ambassador) {
			$user->reward++;
			$user->save();
		}
		$conv = TBMsg::addMessageToConversation($convId, $userId, $request->input('message'));
		return redirect('/convs/' . $convId);
	}

	public function create($userId) {
		$user = Sentinel::getUser();
		if (!$user) {
			Session::put('id_user', $userId);
			return redirect('/prospect/login');
		}
		$conv = TBMsg::createConversation(array($user->id, $userId));
		return redirect('/convs/' . $conv['convId']);
	}

}

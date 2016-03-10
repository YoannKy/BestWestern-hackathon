
@extends('Centaur::layout')
@section('title', 'Messages')
@section('content')
<div class="row">
<div id="content" class="discussion">
    <div class="part">
        <div class="discuss">
            <div class="container-input">
            {{ Form::open(array('url' => 'convs/'.$convId.'/add')) }}
				{{Form::text('message',null,array('required'=>'required'))}}
				{{Form::hidden('id_conv',$convId)}}
				{{Form::submit('Envoyer')}}
			{{ Form::close() }}
			</div>
             @foreach($messages as $message)
				 @if(Sentinel::getUser()->id == $message->senderId)
				 	<div class="message receveur">
                		<div class="container">
                			{{$message->content}}
                		</div>
			            <div class="date">
		                	{{$message->created}}
			            </div>
                	</div>
				 @else
				 	 <div class="message destinataire">
                		<div class="container">
                			{{$message->content}}
                		</div>
		                <div class="date">
		                	{{$message->created}}
		                </div>
                	</div>
				 @endif
			@endforeach
        </div>
    </div>
    <div class="part">
        <div class="container-hotel">
            <div class="top">
                <div class="left"></div>
                <div class="right">
                    <div class="title">
                        BEST WESTERN PLUS
                        <br>
                        Hotel de la baie
                    </div>
                    <div class="details">
                        45 rue du Chemin
                        <br>
                        50170 Mont-Saint-Michel
                    </div>
                </div>
            </div>
        </div>
        <div class="container-destinaire">
            <div class="top">
                <div class="parts image">
                    <img src="{{asset('/img/choix_membre/photo.png')}}" alt="">
                </div>
                <div class="parts nom">{{$participant->first_name}} <br> {{$participant->last_name}}</div>
                <div class="parts mail">{{$participant->email}}</div>
                <Bordeaux>
                <div class="parts ville">
                    <img src="{{asset('/img/choix_membre/map.png')}}" height="15" alt="">
                    Lille
                </div>
            </div>
            <div class="bottom">
                <span>Mon-Saint-Michel</span>
                <span>Paris</span>
                <span>Strasbourg</span>
                <span>Marseille</span>
                <span>Bordeaux</span>
            </div>
        </div>
    </div>
</div>
@stop

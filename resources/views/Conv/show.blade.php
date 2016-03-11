
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
            <div class="top hotel-top">
                <div class="left"></div>
                <div class="right">
                    <div class="title">
                        BEST WESTERN
                        <br>
                        <div class="name"></div>
                    </div>
                    <div class="details">
                        <div class="address"></div>
                        <div class="zipCode"></div>
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
                <Br>
                <div class="parts ville">
                    <img src="{{asset('/img/choix_membre/map.png')}}" height="15" alt="">
                    Lille
                </div>
            </div>
            <div class="bottom">
                <?php $citiesHostels = array();?>
                @if(count($participant->hostels)===0)

                @else
                    @foreach($participant->hostels as $hostels)
                        @if(in_array($hostels->city, $citiesHostels) == false)
                            <span>{{$hostels->city}}</span>
                            <?php $citiesHostels[] = $hostels->city?>
                        @endif
                    @endforeach
                    @foreach($participant->hostels as $hostels)
                        <span>{{$hostels->name}}</span>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
    <script>
        var hostel = localStorage.getItem('hostel');
        var city = localStorage.getItem('city');
        var address = localStorage.getItem('address').split(' - ');

        if(localStorage.getItem('hostel') != "") {
            $(".name").text(hostel);
            if(address != "undefined") {
                $(".address").text(address[0]);
                $(".zipCode").text(address[1]);
            }
        } else {
            $('.title').text(city);
            $('.left').removeClass('left');
            $('.details').removeClass('details');
            $('.hotel-top').css("background-color","#FFFFFF");
        }

    </script>

@stop

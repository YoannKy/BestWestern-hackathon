@extends('Centaur::layout')
@section('title', 'Dashboard')

@section('content')
<div class="row">
<h2>Liste des conversations</h2>
<ul>

 <div id="content" class="choix-membre" style="background-color: transparent;">
       <div class="people">
@foreach($convs as $index => $conv)
            <div class="part">
                <div class="in">
                    <div class="top">
                        <div class="photo">
                            <img src="{{asset('img/choix_membre/photo.png')}}" alt="">
                        </div>
                        <div class="nom">
                             {{$user->first_name}}
                            <br>
                            {{$user->last_name}}
                         </div>
                        <div class="ville">
                            <img src="{{asset('img/choix_membre/map.png')}}" height="15" alt="">
                            {{$user->address}}
                        </div>
                         <?php $citiesHostels = array();?>
                    <div class="villes">
                      @if(count($user->hostels)===0)

                      @else
                        @foreach($user->hostels as $hostels)
                            @if(in_array($hostels->city, $citiesHostels) == false)
                            <span>{{$hostels->city}}</span>
                                <?php $citiesHostels[] = $hostels->city?>
                            @endif
                        @endforeach
                        @foreach($user->hostels as $hostels)
                            <span>{{$hostels->name}}</span>
                        @endforeach
                        @endif
                    </div>
                    </div>
                </div>
				<a class="lien" href="convs/{{$conv->getId()}}">
                    Poursuivre la conversation
                </a>
            </div>
            @endforeach
        </div>
    </div>
</ul>
</div>
@stop

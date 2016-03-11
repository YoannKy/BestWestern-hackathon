@extends('Centaur::layout')

@section('title', 'Profil')

@section('content')
<div id="content" class="compte">
    <div class="title">
        VOTRE PROFIL REWARDS
    </div>
    <div class="informations">
        <div class="part left">
            <div class="top">
                <div class="parts image">
                    <img src="{{asset('img/discussion/photo_personne.png')}}" alt="">
                </div>
                <div class="parts nom">{{$user->first_name}} <br> {{$user->last_name}}</div>
                <div class="parts ville">
                    <img src="{{asset('img/choix_membre/map.png')}}" height="15" alt="">
                    {{$user->address}}
                </div>
            </div>
            @if(count($user->hostels)===0)
            @else
            <div class="bottom">

                @foreach($user->hostels as $hostels)
                    @if(in_array($hostels->city, $citiesHostels) == false)
                    <span>{{$hostels->city}}</span>
                        <?php $citiesHostels[] = $hostels->city?>
                    @endif
                @endforeach
                @foreach($user->hostels as $hostels)
                    <span>{{$hostels->name}}</span>
                @endforeach
                </div>
             @endif

        </div>
        <div class="part right">
            <div class="title-part">
                VOS POINTS REWARDS :
            </div>
            <div class="bottom">
                <div class="left">
                    <img src="{{asset('img/compte/billet.png')}}" alt="">
                </div>
                <div class="right">
                    <div class="points">
                        {{$user->reward}}<span>pts</span>
                    </div>
                    <a class="bouton">
                        Utilisez vos points Reward
                    </a>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($lastConv))
    <div class="conv-lots">
        <div class="part">
            <div class="convers">
                <div class="top">
                    <div class="nb-message">
                        Votre dernière conversation
                    </div>
                    <div class="contenu">
                        <div class="left">
                            <div class="etat">
                                Aucun nouveau message
                            </div>
                            <div class="apercu">
                                <div class="guillemet_on"></div>
                                {{$lastConv->lastMessage->getContent()}}
                                <div class="guillemet_off"></div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="nom">
                                {{$lastConv->participant->pseudo}}
                            </div>
                            <div class="ville">
                                Ville : Mont-Saint-Michel
                            </div>
                            <div class="nb-message-total">
                                <span>{{$lastConv->countMessages}}</span> messages
                            </div>
                        </div>
                    </div>
                    <a class="lien" href="/convs/{{$lastConv->id}}">
                        VOIR LA DISCUSSION COMPLETE
                    </a>
                </div>
                <div class="bottom">
                    @foreach($convs as $index => $conv)
                    @if($index == 0)
                    <div class="parts left">
                        <div class="nb-message non">
                            Aucun nouveau message
                        </div>
                        <div class="contenu">
                            <div class="right">
                                <div class="nom">
                                    {{$conv->participant->login}}
                                </div>
                                <div class="ville">
                                    Ville : Paris
                                </div>
                                <div class="nb-message-total">
                                    <span>{{$conv->countMessages}}</span> messages
                                </div>
                            </div>
                        </div>
                        <a class="lien" href="/convs/{{$conv->id}}">
                            VOIR LA DISCUSSION COMPLETE
                        </a>
                    </div>
                    @else
                    <div class="parts">
                        <div class="nb-message oui">
                           {{$conv->unread}} nouveaux messages
                        </div>
                        <div class="contenu">
                            <div class="right">
                                <div class="nom">
                                    {{$conv->participant->pseudo}}
                                </div>
                                <div class="ville">
                                    Ville : Marseille
                                </div>
                                <div class="nb-message-total">
                                    <span>{{$conv->countMessages}}</span> messages
                                </div>
                            </div>
                        </div>
                        <a class="lien" href="/convs/{{$conv->id}}">
                            VOIR LA DISCUSSION COMPLETE
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="part">
            <div class="lots">
                <div class="title">
                    Les points Rewards
                </div>
                <div class="container">
                    <div class="line">
                        <span>30</span>pts - un séjour d'une journée offert
                    </div>
                    <div class="line">
                        <span>60</span>pts - un séjour de 3 jours offert
                    </div>
                    <div class="line">
                        <span>90</span>pts - une semaine offerte
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@stop
@extends('Centaur::layout')

@section('title', 'Profil')

@section('content')
<div id="content" class="compte_visiteur">
    <div class="title">
        VOTRE PROFIL : {{$user->first_name}}
    </div>
    @if(!empty($lastConv))
    <div class="container">
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
                                Ville : {{$lastConv->participant->address}}
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
                                    Ville : {{$conv->participant->address}}
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
                            1 nouveau message
                        </div>
                        <div class="contenu">
                            <div class="right">
                                <div class="nom">
                                   {{$conv->participant->login}}
                                </div>
                                <div class="ville">
                                    Ville : {{$conv->participant->address}}
                                </div>
                                <div class="nb-message-total">
                                    <span>{{$conv->countMessages}}</span> messages
                                </div>
                            </div>
                        </div>
                        <a class="lien" href="">
                            VOIR LA DISCUSSION COMPLETE
                        </a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@stop
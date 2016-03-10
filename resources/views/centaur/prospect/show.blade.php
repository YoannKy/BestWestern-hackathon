@extends('Centaur::layout')

@section('title', 'Edit Role')

@section('content')
<div id="content" class="compte_visiteur">
    <div class="title">
        VOTRE PROFIL : Benj75
    </div>
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
                                Merci pour ces informations ...
                                <div class="guillemet_off"></div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="nom">
                                Benja75
                            </div>
                            <div class="ville">
                                Ville : Mont-Saint-Michel
                            </div>
                            <div class="nb-message-total">
                                <span>15</span> messages
                            </div>
                        </div>
                    </div>
                    <a class="lien" href="">
                        VOIR LA DISCUSSION COMPLETE
                    </a>
                </div>
                <div class="bottom">
                    <div class="parts left">
                        <div class="nb-message non">
                            Aucun nouveau message
                        </div>
                        <div class="contenu">
                            <div class="right">
                                <div class="nom">
                                    Jacques
                                </div>
                                <div class="ville">
                                    Ville : Paris
                                </div>
                                <div class="nb-message-total">
                                    <span>3</span> messages
                                </div>
                            </div>
                        </div>
                        <a class="lien" href="">
                            VOIR LA DISCUSSION COMPLETE
                        </a>
                    </div>
                    <div class="parts">
                        <div class="nb-message oui">
                            1 nouveau message
                        </div>
                        <div class="contenu">
                            <div class="right">
                                <div class="nom">
                                    Test12
                                </div>
                                <div class="ville">
                                    Ville : Marseille
                                </div>
                                <div class="nb-message-total">
                                    <span>7</span> messages
                                </div>
                            </div>
                        </div>
                        <a class="lien" href="">
                            VOIR LA DISCUSSION COMPLETE
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
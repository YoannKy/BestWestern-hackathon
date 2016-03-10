@extends('Centaur::layout')

@section('title', 'Dashboard')

@section('content')
    <div id="content" class="accueil">
        <img src="img/accueil/ban_1.jpg" alt="">
        <div class="ban-dial">
          <form class="part" action="{{route('ambassadors')}}" method="GET">
                <div class="text">
                    <img src="img/accueil/pouces.png" alt="">
                    <br>
                    Et si un membre vous aidait
                    <br/>
                    à choisir votre destination?
                    <br>
                    <img src="img/accueil/bulles.png" alt="">
                    <p class="small">Nombre de messages echangés sur la plateforme: {{$count}}</p>

                    <div class="exemple">
                        <img src="img/choix_membre/photo.png" alt="">
                        <div class="guillemet_on"></div>
                        <div class="paroles">
                            Je vous conseille cet hôtel au coeur du Mont-Saint-Michel.
                            Simplement parfait !
                        </div>
                        <div class="guillemet_off"></div>
                    </div>
                </div>
                <input type="submit" class="bouton" value="Contacter un membre">
            </form>
            <div class="part photo"></div>
        </div>
        <img src="img/accueil/ban_2.jpg" alt="">
        <img src="img/accueil/ban_3.jpg" alt="">
    </div>
@stop
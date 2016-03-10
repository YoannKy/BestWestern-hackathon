@extends('Centaur::layout')
@section('title', 'Choix membre')
@section('content')
  <div id="content" class="choix-membre">
        <div class="filters">
            <div class="part">
                <div class="title">
                    Choisissez une ville
                </div>

                <select id="city">
                    @foreach($cities as $city)
                    <option>{{$city['city']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="part">
                <div class="title">
                    Choisissez un hôtel
                </div>
                <select>
                    <option>Ville 1</option>
                    <option>Ville 2</option>
                    <option>Ville 3</option>
                    <option>Ville 4</option>
                </select>
            </div>
        </div>
        <div class="people">
        @foreach($users as $index => $user)
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
                    </div>
                    <div class="villes">
                        <span>Mon-Saint-Michel</span>
                        <span>Paris</span>
                        <span>Strasbourg</span>
                        <span>Marseille</span>
                        <span>Bordeaux</span>
                    </div>
                </div>
                <a class="lien" href="convs/{{$user->id}}/create">
                    Contacter {{$user->first_name}}
                </a>
            </div>
            @endforeach
        </div>
    </div>
  <script>
      $( "select" )
              .change(function () {
                  var city = $( "select#city option:selected").text();
                  var ambassador = $('.people .part');
                  ambassador.each(function(index){
                      var count = 0;
                      var hasNotVisited = false;
                      var cities = $(this).find('.villes span');
                            cities.each(function(){
                            if($(this).html() === city) {
                                count += 1;
                            }
                      });
                      if(count === 0){
                          $(this).hide();
                      } else {
                          $(this).show();
                      }
                  });
              });
                  //$( ".part" ).remove();

  </script>
@stop
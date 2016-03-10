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
                    <option selected="selected"></option>
                    @foreach($cities as $city)
                    <option value="{{$city['city']}}">{{$city['city']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="part">
                <div class="title">
                    Choisissez un hôtel
                </div>
                <select id="hostel">
                    <option selected="selected"></option>
                    @foreach($cities as $city)
                        <option value="{{$city['name']}}">{{$city['name']}} - {{$city['city']}}</option>

                    @endforeach
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
                    <?php $citiesHostels = array(); ?>
                    <div class="villes">
                        @foreach($user->hostels as $hostels)
                            @if(in_array($hostels->city, $citiesHostels) == false)
                            <span>{{$hostels->city}}</span>
                                <?php $citiesHostels[] = $hostels->city ?>
                            @endif
                        @endforeach
                        @foreach($user->hostels as $hostels)
                            <span>{{$hostels->name}}</span>
                        @endforeach
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
      function setOption(){
          $('option[value="{{$name}}"]').attr('selected','selected');
          $('option[value="{{$cityDefault}}"]').attr('selected','selected');
          var hostel = $( "select#hostel option:selected").text();
          var ambassador = $('.people .part');
          ambassador.each(function(index){
              var count = 0;
              var hasNotVisited = false;
              var cities = $(this).find('.villes span');
              cities.each(function(){
                  if($(this).html() === hostel.split(' - ')[0]) {
                      count += 1;
                  }
              });
              if(count === 0){
                  $(this).hide();
              } else {
                  $(this).show();
              }
          });
      }

      $( "#city" )
              .change(function () {
                  var city = $( "select#city option:selected").text();
                  $("#hostel").val('');
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
                  var hostels = $('#hostel option');
                  hostels.each(function(index){
                      var count = 0;
                      var hasNotVisited = false;
                      if($(this).text().indexOf("- "+city) == -1) {
                          $(this).hide();
                      }else {
                          $(this).show();
                      }
                  });
              });
      $( "#hostel" )
              .change(function () {
                  var hostel = $( "select#hostel option:selected").text();
                  var ambassador = $('.people .part');
                  ambassador.each(function(index){
                      var count = 0;
                      var hasNotVisited = false;
                      var cities = $(this).find('.villes span');
                      cities.each(function(){
                          if($(this).html() === hostel.split(' - ')[0]) {
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
      @if($name != "" && $cityDefault != "")
        <?php
            echo 'setOption();';
        ?>
      @endif
  </script>

@stop
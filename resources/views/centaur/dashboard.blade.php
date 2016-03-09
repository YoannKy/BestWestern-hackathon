@extends('Centaur::layout')

@section('title', 'Dashboard')

@section('content')
    <div id="content" class="accueil">
        <img src="img/accueil/ban_1.jpg" alt="">
        <div class="ban-dial">
         <form accept-charset="UTF-8" role="form" class="part" method="post" action="{{ route('auth.login.attempt') }}">
            <div class="text">
                    <img src="{{asset('img/accueil/pouces.png')}}" alt="">
                    <br>
                    Et si un membre vous aidait
                    <br/>
                    à choisir votre destination?
                    <br>
                    <img src="{{asset('img/accueil/bulles.png')}}" alt="">
                     <div class="container-input">
                        <input class="pseudo" placeholder="Votre pseudo..." name="pseudo" type="text" value="{{ old('pseudo') }}">
                    </div>
                    <div class="container-input">
                        <input class=" email" placeholder="Votre email..." name="email" type="text" value="{{ old('email') }}">
                    </div>
                    <div class="container-input">
                        <input class="password" placeholder="Votre mot de passe..." name="password" type="password" value="">
                    </div>
                     <div class="checkbox">
                  <!--       <label>
                            <input name="remember" type="checkbox" value="true" {{ old('remember') == 'true' ? 'checked' : ''}}> Se souvenir de moi
                        </label> -->
                    </div>
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                   </div>
                    <input class="bouton" type="submit" value="Contacter un membre">
                    <p style="margin-top:5px; margin-bottom:0"><a href="{{ route('auth.password.request.form') }}" type="submit">Forgot your password?</a></p>

                </form>
            <div class="part photo"></div>
        </div>
        <img src="img/accueil/ban_2.jpg" alt="">
        <img src="img/accueil/ban_3.jpg" alt="">
    </div>
@stop
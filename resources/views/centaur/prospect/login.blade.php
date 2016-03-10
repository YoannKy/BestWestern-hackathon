@extends('Centaur::layout')

@section('title', 'Login')

@section('content')

<form id="content" accept-charset="UTF-8" role="form" class="connexion" method="post" action="{{route('auth.login.prospect.attempt')}}">
    <div class="formulaire">
        <div class="container-input">
            <input class="pseudo" placeholder="Votre pseudo..." name="pseudo" type="text" value="">
         </div>
        <div class="container-input">
            <input class=" email" placeholder="Votre email..." name="email" type="text" value="">
        </div>
        <div class="container-input">
            <input class="password" placeholder="Votre mot de passe..." name="password" type="password" value="">
        </div>
         <div class="checkbox">
            <label>
                <input name="create" id="create_account" type="checkbox" value="true" > Créer un compte
            </label>
        </div>
        <input name="_token" value="V4jPd6UQfJTKyXl5dQIFz6Xv5YZDmUQRzRVM0ixG" type="hidden">
        <input class="bouton" type="submit" value="Connexion">
    </div>
</form>
<script type="text/javascript">
        $('#create_account').on('change',function(){
        if($(this).is(':checked')){
            $('form#content').attr('action',"{{route('auth.register.prospect.attempt')}}");
            $('.bouton').val('Inscription');
        } else {
            $('form#content').attr('action',"{{route('auth.login.prospect.attempt')}}");
            $('.bouton').val('Connexion');
        }
    });
</script>
@stop
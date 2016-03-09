<?
@extends('Centaur::layout')
@section('title', 'Dashboard')

@section('content')
<div class="row">
<h2>Liste des conversations</h2>
<ul>
@foreach($convs as $index => $conv)
	<li><a href="convs/{{$conv->getId()}}">conversation {{$index}}</a></li>
@endforeach

	@foreach($users as $index => $user)
		<li><a href="convs/{{$user->id}}/create">Parler avec l'utilisateur  {{$user->email}}</a></li>
	@endforeach

</ul>
</div>
@stop

@extends('layouts.security')

@section('content')
<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Activez votre compte</h2>
            <p>
                Un e-mail vous a été envoyé. Merci d'activer votre compte
            </p>
            <a href="{{ route('verification.send') }}">Renvoyer un email d'activation</a>
        </div>
    </div>
</div>
@endsection

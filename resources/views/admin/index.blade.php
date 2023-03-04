@extends('admin.layouts.admin')
@section('title', 'Gestion whitelist')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header">
            @if($user_created == 1)
                <div style="text-align: center; color: green;">
                    <strong>Confirmé !</strong> Vous avez ajouté <strong>{{ $added_username }} </strong> à la whitelist.
                </div>
            @endif
                @if($error == 1)
                    <div style="text-align: center; color: red;">
                        <strong>Erreur !</strong> Cet utilisateur n'existe pas ou est déjà dans la whitelist.
                    </div>
                @endif
            <h2>Liste des utilisateurs whitelist :</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Whitelist un utilisateur
            </button>

        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Par</th>
                    <th scope="col">À</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $iterator)
                    <tr>
                        <th scope="row">{{ $iterator->id }}</th>
                        <td>{{ $iterator->target_id }}</td>
                        <td>{{ $iterator->author_id }}</td>
                        <td>{{ $iterator->created_at }}</td>
                            <td><button class="btn btn-outline-danger" onclick="location.href = '/admin/playerapi/unwhitelist/{{ $iterator->target_idAsID }}'">UnWhitelist</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
{{--    @include('playerapi.admin._create', ['route' => route('playerapi.admin._create', ['user' => "3"])])--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Whitelist un utilisateur</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 align-items-center" method="GET" action="/admin/playerapi/whitelist">
                        <div>
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Nom d'utilisateur</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="inputUsername" name="username" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                            <span id="passwordHelpInline" class="form-text">
                              Celui du site et sans aucune fautes.
                            </span>
                            </div>
                        </div>
                        <div>
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">ID Discord</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="inputUsername" name="discordID" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
                            <span id="passwordHelpInline" class="form-text">
                              Clic droit > copier l'identifiant
                            </span>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-outline-success" value="Valider">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
@endsection


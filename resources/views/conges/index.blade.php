@extends('layouts.app')

@section('title', 'Liste des conges')

@section('content')
<h2>Liste des Congés</h2>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Employé</th>
            <th>Date</th>
            <th>Motif</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($conges as $conge)
            <tr>
                <td>{{ $conge->user->name ?? 'Inconnu' }}</td>
                <td>{{ \Carbon\Carbon::parse($conge->date)->format('d/m/Y') }}</td>
                <td>{{ $conge->motif }}</td>
                <td>
                    @if ($conge->status === 'en_cours')
                        <span class="badge bg-info">En cours</span>
                    @elseif ($conge->status === 'en_attente')
                        <span class="badge bg-secondary">En attente</span>
                    @elseif ($conge->status === 'refuse')
                        <span class="badge bg-danger">Refusé</span>
                    @else
                        <span class="badge bg-light text-dark">Inconnu</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Aucune conge enregistrée.</td></tr>
        @endforelse
    </tbody>
</table>

<h4>Ajouter un congé</h4>
<form action="{{ route('conges.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label>Employé :</label>
        <input type="text" id="user_search" class="form-control" placeholder="Tapez le nom ou email de l'employé" required>
        <input type="hidden" name="user_id" id="user_id">
    </div>
    <div class="mb-2">
        <label>Date de congé:</label>
        <input type="date" name="date_conge" class="form-control">
    </div>
    <div class="mb-2">
        <label>Motif:</label>
        <input type="text" name="motif" class="form-control">
    </div>
    <button class="btn btn-primary">Enregistrer</button>
</form>
<script>
$(document).ready(function() {
    $('#user_search').on('input', function() {
        let query = $(this).val();

        if(query.length < 2) {
            $('#user_list').hide();
            return;
        }

        $.ajax({
            url: "{{ route('users.autocomplete') }}",
            type: 'GET',
            data: { term: query },
            success: function(data) {
                let html = '';
                if(data.length > 0) {
                    data.forEach(function(user) {
                        html += `<button type="button" class="list-group-item list-group-item-action" data-id="${user.id}" data-label="${user.label}">${user.label}</button>`;
                    });
                } else {
                    html = '<div class="list-group-item">Aucun résultat</div>';
                }
                $('#user_list').html(html).show();
            }
        });
    });

    $('#user_list').on('click', 'button', function() {
        $('#user_id').val($(this).data('id'));
        $('#user_search').val($(this).data('label'));
        $('#user_list').hide();
    });

    $(document).click(function(e) {
        if (!$(e.target).closest('#user_search, #user_list').length) {
            $('#user_list').hide();
        }
    });
});
</script>
@endsection

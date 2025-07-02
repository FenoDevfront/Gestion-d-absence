@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nouveau retard</h1>
    <form action="{{ route('retards.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="employee_id">Employé</label>
            <input type="text" id="employee_name" class="form-control" placeholder="Nom de l'employé">
            <input type="hidden" id="employee_id" name="employee_id">
        </div>
        <div class="form-group">
            <label for="date_retard">Date</label>
            <input type="date" name="date_retard" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="duree">Durée (minutes)</label>
            <input type="number" name="duree" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="motif">Motif</label>
            <textarea name="motif" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
$(function() {
    $("#employee_name").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('users.autocomplete') }}",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            $('#employee_id').val(ui.item.id);
        }
    });
});
</script>
@endsection

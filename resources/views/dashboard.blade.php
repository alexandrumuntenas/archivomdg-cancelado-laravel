@extends('adminlte::page')

@section('title', 'Próximos eventos')

@section('content_header')
    <h1>Próximos eventos</h1>
@stop

@section('content')
    <div class="card">
        <ul class="list-group list-group-flush" id="eventos">
        </ul>
    </div>
@stop

@section('js')
    <script>
        $.ajax({
            url: '{{ route('obtenerEventosDelUsuario') }}',
            type: 'GET',
            dataType: 'json',
            success: function(eventos) {
                if (eventos.length > 0) {
                    eventos.forEach(function(evento) {
                        $('#eventos').append(
                            `<button class="list-group-item text-left" eventoid="${evento.id}">${evento.nombre}</button>`
                        );
                    });
                } else {
                    $('#eventos').append(
                        `<li class="list-group-item">No hay eventos próximos</li>`
                    );
                }
            }
        });

        $('#eventos').on('click', 'button', function() {
            window.location.href = `{{ route('verEvento') }}/${$(this).attr('eventoid')}`;
        });
    </script>
@stop

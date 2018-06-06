@extends('app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>Pokemons</h1>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <th>#</th>
                    <th>Sprite</th>
                    <th>Name</th>
                    <th>Base Experience</th>
                    <th>Height</th>
                    <th>Weight</th>
                    </thead>
                    <tbody>
                    @foreach( $pokemons as $index => $pokemon)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td><img src="{{ $pokemon->sprite }}"></td>
                            <td title="ratio: {{ round($pokemon->height / $pokemon->weight, 3) }}">{{ $pokemon->pokemon->name }}</td>
                            <td>{{ $pokemon->base_experience }}</td>
                            <td>{{ $pokemon->height }}</td>
                            <td>{{ $pokemon->weight }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center">
                {{ $pokemons->links() }}
            </div>


            @include('pokemons.king')


        </div>
    </div>

@stop
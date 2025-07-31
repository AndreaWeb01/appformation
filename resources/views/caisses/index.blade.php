@extends('layouts.template')

@section('content')

<div class="container">
    <h1>Gestion de Caisse</h1>

    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">Solde actuel en caisse</h5>
        </div>
        <div class="card-body">
            <p>Montant initial: {{ $caisse->montant_initial }} F CFA</p>
            <p>Total des entrées: {{ $caisse->totalEntrees() }} F CFA</p>
            <p>Total des dépenses: {{ $caisse->totalDepenses() }} F CFA</p>
            {{-- <p>Total des versement {{ $caisse->totalVersements() }} F CFA</p> --}}
            <hr>
            <h4>Solde actuel: {{ $caisse->soldeCaisse() }} F CFA</h4>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Détail des transactions</h5>
        </div>
        <div class="card-body">
            <h6>Entrées:</h6>
            <ul>
                @foreach($caisse->entrees as $entree)
                    <li>{{ $entree->montant }} F CFA - {{ $entree->description }}</li>
                @endforeach
            </ul>

            <h6>Dépenses:</h6>
            <ul>
                @foreach($caisse->depenses as $depense)
                    <li>{{ $depense->montant }} F CFA - {{ $depense->description }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
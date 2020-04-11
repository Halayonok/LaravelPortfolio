<div class="form-group">
    <div class="card card-place shadow-none">
        <div class="card-body py-1 px-2">
            @if (isset($place))
                <p class="card-title m-0"><small>Текущее:</small> <b>{{ $place->name }}</b></p>
                <p class="card-text" style="font-size: 11px;">
                    <b>Адрес:</b> {{ $place->address }}<br>
                    <b>Широта:</b> {{ $place->latitude }}<br>
                    <b>Долгота:</b> {{ $place->longitude }}
                </p>
            @else
                <p class="card-title m-0"><small>Текущее:</small> <b class="red-text">не задано</b></p>
            @endif
        </div>
    </div>
</div>

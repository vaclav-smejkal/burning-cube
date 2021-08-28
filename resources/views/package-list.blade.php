<div id="packages">
    <h2 class="title">
        Balíčky
    </h2>
    <div class="grid-packages">
        @foreach ($packages as $package)
            <div class="package">
                <div class="subtitle">{{ $package->name }}</div>
                <div class="price">{{ $package->price }} Kč</div>
                <a href="#" class="btn btn-primary">Zobrazit více</a>
                <div class="desc">{{ $package->comment }}</div>
            </div>
        @endforeach
    </div>
</div>

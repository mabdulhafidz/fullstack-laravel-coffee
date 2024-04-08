<div>
    <h1>Categories</h1>
    @foreach ($categories as $category)
        <div class="category">
            <p>{{ $category['name'] }}</p>
            <p>{{ $category['description'] }}</p>
            @isset($category['image'])
                @if (!empty($category['image']))
                    <img src="{{ asset('storage/'.$category['image']) }}" alt="{{ $category['name'] }}">
                @else
                    <img src="{{ asset('path/to/placeholder-image.jpg') }}" alt="Placeholder Image">
                @endif
            @endisset
        </div>
    @endforeach
</div>

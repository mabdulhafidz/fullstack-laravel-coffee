<!DOCTYPE html>
<html>
<head>
    <title>Categories PDF</title>
    <style>
        .category {
            margin-bottom: 20px;
        }
        .category img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div>
        <h1>Categories</h1>
            @foreach ($category as $c)
                <div class="category">
                    <p>{{ $c['name'] }}</p>
                    <p>{{ $c['description'] }}</p>
                    @isset($c['image'])
                        @if (!empty($c['image']))
                            <img src="{{ asset('storage/'.$c['image']) }}" alt="{{ $c['name'] }}">
                        @else
                            <img src="{{ asset('path/to/placeholder-image.jpg') }}" alt="Placeholder Image">
                        @endif
                    @endisset
                </div>
            @endforeach
    
    </div>
</body>
</html>

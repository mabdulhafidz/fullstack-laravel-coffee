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
        @if(!empty($categories))
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
        @else
            <h1>No categories found.</h1>
        @endif
    </div>
</body>
</html>

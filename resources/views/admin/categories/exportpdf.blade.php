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
    <h1>Categories</h1>
    @foreach ($categories as $category)
        <div class="category">
            <h2>{{ $category->name }}</h2>
            <p>{{ $category->description }}</p>
            @if($category->image)
                <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}">
            @endif
        </div>
    @endforeach
</body>
</html>

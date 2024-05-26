<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Addbook</title>
    <link href="/css/main.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="{{ route('book.index') }}" class="logo"><img src="{{ asset('img/logo.png') }}" alt="Get Booked Logo"></a>
        </div>
        <nav class="navbar">
            <a href="{{ route('book.index') }}">Home</a>
            <a href="{{ route('book.create') }}">Add Book</a>
            <a href="{{ route('rent.index') }}">Rented Books</a>
        </nav>
    </header>

    <main>
        <div class="container">
                <h1>Edit Book</h1>
                @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
                @endif

            <form method="POST" action="{{ route('book.update', ['book' => $book]) }}">
                @csrf
                @method('put')
                <div class="input">
                    <input type="text" name="title" placeholder="Title" value="{{ $book->title }}">
                </div>
                <div class="input">
                    <input type="text" name="author" placeholder="Author" value="{{ $book->author }}">
                </div>
                    {{-- <input type="submit" value="Update"> --}}
                    <button type="submit" class="btn">Update</button>
            </form>
        </div>
    </main>

    <footer>

    </footer>
</body>
</html>

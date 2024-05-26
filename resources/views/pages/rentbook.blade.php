<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rent Book</title>
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
                <h1>Rent Book</h1>
            <div>
                <form method="POST" action="{{ route('rent.store') }}">
                    @csrf
                    @method('post')
                    <div class="input">
                        <select name="book_id" id="book_id">
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input">
                        <input type="text" name="name" id="name" placeholder="Name">
                    </div>
                    <div class="input">
                        <select name="role" id="role">
                            <option value="teacher">Teacher</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <div class="input">
                        <input type="text" name="rent_date" id="rent_date" value="{{ date('Y-m-d') }}" readonly>
                    </div>
                    <div>
                        <button type="submit" class="btn">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <!-- Your footer content goes here -->
    </footer>
</body>
</html>

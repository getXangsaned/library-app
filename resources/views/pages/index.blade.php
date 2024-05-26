<!-- resources/views/books/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Get Booked!</title>
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

    <main class="indexcontainer">
        <div>
            <div>
                <h1>Recently Added</h1>
            </div>
            <div>
                @if(session()->has('success'))
                <div>
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <div>
                <form method="GET" action="{{ route('book.search') }}" class="search-bar">
                    <input type="text" name="query" placeholder="Search for a book..." value="{{ request()->input('query') }}">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Rent Book</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td class="button">
                                <a href="{{ route('rent.create', ['book' => $book->id]) }}">Rent</a>
                            </td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td class="button">
                                <a href="{{ route('book.edit', ['book' => $book->id]) }}">Edit</a>
                            </td>
                            <td class="button">
                                <form method="post" action="{{ route('book.delete', ['book' => $book->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </main>

    <footer>

    </footer>
</body>
</html>

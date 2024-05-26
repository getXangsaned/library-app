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

    <main class ="indexcontainer">
        <div>
            <div>
                <h2>Books Rented</h2>
            </div>
            <div>
                @if(session()->has('success'))
                <div>
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <div>
                <form method="GET" action="{{ route('rent.search') }}" class="search-bar">
                    <input type="text" name="query" placeholder="Search for a book rented" value="{{ request()->input('query') }}">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Renter's Name</th>
                        <th>Role</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Rent Date</th>
                        <th>Fine Amount</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($rents as $rent)
                        <tr>
                            <td>{{ $rent->id }}</td>
                            <td>{{ $rent->name }}</td>
                            <td>{{ $rent->role }}</td>
                            <td>{{ optional($rent->book)->title }}</td>
                            <td>{{ optional($rent->book)->author }}</td>
                            <td>{{ $rent->rent_date }}</td>
                            <td>{{ $rent->fine_amount ?? 'No fine' }}</td>
                            <td>
                                @if ($rent->is_returned)
                                    <button disabled>Returned</button>
                                @elseif ($rent->fine_amount)
                                    <form method="POST" action="{{ route('rent.pay', ['rent_id' => $rent->id]) }}">
                                        @csrf
                                        <button type="submit">Pay</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('rent.return', ['rent_id' => $rent->id]) }}">
                                        @csrf
                                        <button type="submit">Return</button>
                                    </form>
                                @endif
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

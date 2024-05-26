<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrower;
use Carbon\Carbon;

class RentController extends Controller
{
    public function rentindex()
    {
        $rents = Borrower::all();
        return view('pages.rentindex', ['rents' => $rents]);
    }

    public function create()
    {
        $books = Book::all();
        return view('pages.rentbook', ['books' => $books]);
    }

    public function store(Request $request)
    {
        // Validate request data
        $data = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'book_id' => 'required',
        ]);

        // Check the role and set the maximum book limit
        $maxBooks = $data['role'] === 'teacher' ? 6 : 3;

        // Check if the user has already rented the maximum allowed books
        $rentedBooksCount = Borrower::where('name', $data['name'])->count();
        if ($rentedBooksCount >= $maxBooks) {
            return redirect()->back()->with('error', 'You have reached the maximum limit for renting books.');
        }

        // Set the rent date to the current date and time
        $data['rent_date'] = now();

        // Create a new rental record
        Borrower::create($data);

        return redirect(route('rent.index'))->with('success', 'Book Rented Successfully');
    }

    public function calculateFine(Request $request)
    {
        // Retrieve rental record
        $rental = Borrower::find($request->rent_id);

        // Calculate the difference in days between rent date and current date
        $rentDate = Carbon::parse($rental->rent_date);
        $currentDate = Carbon::now();
        $daysDifference = $currentDate->diffInDays($rentDate);

        // Check if the book is overdue (more than 5 days)
        if ($daysDifference > 5) {
            // Apply the fine of ₱5 for each day overdue
            $fineAmount = ($daysDifference - 5) * 5;

            // Update the rental record with the fine amount and return status
            $rental->fine_amount = $fineAmount;
            $rental->is_returned = false;
            $rental->save();

            return redirect()->back()->with('error', 'You have returned the book after the due date. A fine of ₱' . $fineAmount . ' has been applied.');
        }

        return redirect()->back()->with('success', 'Book returned successfully.');
    }

    public function return(Request $request, $rent_id)
    {
        // Retrieve the rental record
        $rental = Borrower::find($rent_id);

        // Check if the rental record exists
        if (!$rental) {
            return redirect()->back()->with('error', 'Rental record not found.');
        }

        // Delete the rental record
        $rental->delete();

        return redirect(route('rent.index'))->with('success', 'Book returned successfully.');
    }
}

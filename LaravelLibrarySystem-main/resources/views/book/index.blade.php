@extends('layouts.app')
@section('content')

    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="admin-heading">All Books</h2>
                </div>
                <div class="offset-md-7 col-md-2">
                    <a class="add-new" href="{{ route('book.create') }}">Add Book</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form method="GET" action="">
                        <div class="row">
                        <div class="form-group mx-2 row">
                            <label for="bookName" class = "col">Book Name:</label>
                            <input type="text" class = "col form-control" id="bookName" name="bookName" value="{{ request('bookName') }}" autocomplete="off">
                        </div>
                        <div class="form-group mx-2 row">
                            <label for="authorName" class = "col">Author:</label>
                            <input type="text" class = "col form-control" id="authorName" name="authorName" value="{{ request('authorName') }}" autocomplete="off">
                        </div>
                        </div>
                      
                        <div class="row">
                        <div class="form-group mx-2 row">
                            <label for="publisher" class = "col">Publisher:</label>
                            <input type="text" class = "form-control col" id="publisher" name="publisher" value="{{ request('publisher') }}" autocomplete="off">
                        </div>
                        <div class="form-group mx-2 row">
                            <label for="status" class = "col">Status:</label>
                            <select id="status" class = "form-control col" name="status">
                                <option value="">All</option>
                                <option value="Y" {{ request('status') == 'Y' ? 'selected' : '' }}>Available</option>
                                <option value="N" {{ request('status') == 'N' ? 'selected' : '' }}>Issued</option>
                            </select>
                            <button type="submit" class="btn btn-primary mx-2">Filter</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="message"></div>
                    <table class="content-table">
                        <thead>
                            <th>S.No</th>
                            <th>Book Name</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
 

    @forelse ($books as $book)
        
                        <tr>
                            <td class="id">{{ $book->id }}</td>
                            <td>{{ $book->name }}</td>
                            <td>{{ $book->category->name }}</td>
                            <td>{{ $book->auther->name }}</td>
                            <td>{{ $book->publisher->name }}</td>
                            <td>
                                @if ($book->status == 'Y')
                                    <span class='badge badge-success'>Available</span>
                                @else
                                    <span class='badge badge-danger'>Issued</span>
                                @endif
                            </td>
                            <td class="edit">
                                <a href="{{ route('book.edit', $book) }}" class="btn btn-success">Edit</a>
                            </td>
                            <td class="delete">
                                <form action="{{ route('book.destroy', $book) }}" method="post"
                                    class="form-hidden">
                                    <button class="btn btn-danger delete-book">Delete</button>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                
    @empty
        <tr>
            <td colspan="8">No Books Found</td>
        </tr>
    @endforelse
                        </tbody>
                    </table>
                    
                    {{ $books->appends(request()->query())->links('vendor/pagination/bootstrap-4') }}
                    
                </div>
            </div>
        </div>
    </div>
@endsection

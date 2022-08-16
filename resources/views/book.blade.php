<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('List of Book') }}
      </h2>
  </x-slot>

  <div class="py-12">
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right mb-2">
                    {{-- <a class="btn btn-success" href="{{ route('books.create') }}"> Create Book</a> --}}
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Book Authors</th>
                    <th>Book Publisher</th>
                    <th>Published Year</th>
                    <th>ISBN</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->authors }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->published }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>
                            {{-- <form action="{{ route('books.destroy',$book->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $books->links() !!}
    </div>
  </div>
</x-app-layout>

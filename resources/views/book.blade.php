<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('List of Book') }}
      </h2>
  </x-slot>

  <script>
    $(document).ready(function(){
      $("#published").datepicker({
        minViewMode: 2,
         format: 'yyyy'
      });   
    })
  </script>

  <div class="py-12">
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right mb-2">
                  @can('manage book')
                  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#createBook">Add Book</button>
                  @endcan
                </div>
            </div>
        </div>

        {{-- Modal to create book --}}
        <div class="modal fade" id="createBook" tabindex="-1" role="dialog" aria-labelledby="createBook"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Create Book</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form role="form" method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-body mx-3">
                  <div class="md-form mb-5">
                    <label class="control-label">Book Name</label>
                    <input type="text" id="orangeForm-name" class="form-control validate" name="name">
                  </div>
                  <div class="md-form mb-5">
                    <label class="control-label">Book Authors</label>
                    <input type="text" id="orangeForm-email" class="form-control validate" name="authors">
                  </div>
                  <div class="md-form mb-5">
                    <label class="control-label">Book Publisher</label>
                    <input type="text" id="orangeForm-email" class="form-control validate" name="publisher">
                  </div>
                  <div class="md-form mb-5">
                    <label class="control-label">Published Year</label>
                    <input type="text" class="date-own form-control" name="published" id="published"/>
                  </div>
                  <div class="md-form mb-5">
                    <label class="control-label">ISBN</label>
                    <input type="text" class="form-control validate" name="isbn"/>
                  </div>
        
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button class="btn btn-deep-orange" type="submit">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        {{-- Modal to edit book --}}
        <div class="modal fade" id="editBook" tabindex="-1" role="dialog" aria-labelledby="editBook"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Edit Book</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form method="POST" action="/book" id="editForm">
                {{ csrf_field() }}
                @method('PUT')
                <div class="modal-body mx-3">
                  <div class="md-form mb-5">
                    <label class="control-label">Book Name</label>
                    <input type="text" id="name" class="form-control validate" name="name">
                  </div>
                  <div class="md-form mb-5">
                    <label class="control-label">Book Authors</label>
                    <input type="text" id="authors" class="form-control validate" name="authors">
                  </div>
                  <div class="md-form mb-5">
                    <label class="control-label">Book Publisher</label>
                    <input type="text" id="publisher" class="form-control validate" name="publisher">
                  </div>
                  <div class="md-form mb-5">
                    <label class="control-label">Published Year</label>
                    <input type="text" class="date-own form-control" name="published" id="published"/>
                  </div>
                  <div class="md-form mb-5">
                    <label class="control-label">ISBN</label>
                    <input type="text" id="isbn" class="form-control validate" name="isbn"/>
                  </div>
                  <div class="md-form mb-5">
                    <label class="control-label">Status</label>
                    <select name="status" id="status" class="form-control validate">
                      <option value="Available">Available</option>
                      <option value="Rented">Rented</option>
                      <option value="Broken">Broken</option>
                    </select>
                  </div>
        
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button class="btn btn-deep-orange" type="submit">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered" id="books">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Book Authors</th>
                    <th>Book Publisher</th>
                    <th>Published Year</th>
                    <th>ISBN</th>
                    <th>Status</th>
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
                        <td>{{ $book->status }}</td>
                        <td>
                            @can('manage book')
                            <form action="{{ route('book.destroy',$book->id) }}" method="Post">
                                <button type="button" class="btn btn-primary btn-lg edit" data-toggle="modal" data-target="#editBook">Edit</button>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $books->links() !!}
    </div>
  </div>

  <script>
    $(document).ready(function () {
      var table = $('#books').DataTable()

      table.on('click', '.edit', function () {
        $tr = $(this).closest('tr')
        if ($($tr).hasClass('child')) {
          $tr = $tr.prev('.parent')
        }

        var data = table.row($tr).data()
        
        $('#name').val(data[1])
        $('#authors').val(data[2])
        $('#publisher').val(data[3])
        $('#isbn').val(data[5])

        $('#editForm').attr('action', '/book/'+data[0])
      })
    })
  </script>
</x-app-layout>

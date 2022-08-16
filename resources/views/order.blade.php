<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('List of Order') }}
      </h2>
  </x-slot>

  <div class="py-12">
    <div class="container mt-2">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered" id="books">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book ID</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->book_id }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @if($order->status == 'Confirm')        
                            <form action="{{ route('order.return',$order->id) }}" method="Post">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-primary">Return</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $orders->links() !!}
    </div>
  </div>
</x-app-layout>

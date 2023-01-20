@extends('layouts.app')

<style>
    .flow{

width: 355px;
height: 410px;
overflow: auto;
}
</style>

@section('content')
    <div class="container">
        <div class="row">
            @if(Session::get('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ Session::get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <div class="user_category">
                            <h4>Category</h4>
                            <a href="{{ url('home') }}" class="btn btn-outline-secondary">All BOOK</a>
                            @foreach ($category as $row)
                                <div class="mt-2">
                                    <a href="{{ route('display', $row->id) }}"
                                        class="btn btn-outline-secondary">{{ $row->name }}</a>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="col-md-9">
                        <h2 class="category-title">

                            All Book
                        </h2>
                        <div class="row">

                            @foreach ($books as $row)
                                <div class="col-md-6 mt-1">
                                    <div class="card" style="width: 16rem;">
                                        <img class="card-img-top img-fluid"
                                            src="{{ asset('storage/images/' . $row->avatar) }}" alt="Card image cap">

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $row->name }}</h5>
                                            <div class="card-text">Category: {{ $row->category }}</div>
                                            <div class="card-text mb-2">Auther: {{ $row->author }}</div>
                                            <a href="{{route('add-cart', [$row->id])}}" class="btn btn-outline-dark">
                                                Book Rent
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-4">
                <div class="row">
                <div class="col-md-12">
                    <h2 class="category-title">Rented Book</h2>
                </div>

                @foreach ($order_one as $row)



                    <div class="col-md-12">
                        <div>
                            <div class="card mb-3" style="max-width: 520px;">
                                <div class="row g-0">
                                    <div class="col-md-6">
                                        <img src="{{ asset('storage/images/' . $row->avatar) }}" class="img-fluid rounded-start"
                                            alt="...">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $row->name }}</h5>

                                            <div>
                                                <a href="{{ route('pdf_display', $row->id) }}" class="btn btn-outline-dark">Read</a>
                                                <a href="{{ route('leave',$row->ord_id) }}" class="btn btn-outline-danger">Leave</a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    @endforeach
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <h2 class="category-title">Rented Book History</h2>
                       <div class="flow">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Book Name</th>

                                    <th scope="col">Leave Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>

                                @foreach ($history as $row)
                                <tr>
                                    <td>{{ $i++; }}</td>
                                    <td>{{$row->bookname }}</td>
                                    <td>{{$row->date }}</td>

                                </tr>
                                @endforeach



                            </tbody>
                        </table>
                       </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

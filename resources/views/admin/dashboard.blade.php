@include('admin.include.header')

<h1 class="mt-5" style="text-align: center">Hey ! Admin</h1>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header"><span style="font-size:150% "><i class="bi bi-book"></i> Book </span></div>
                <div class="card-body text-dark">
                    <div class="card-title"><span class="badge badge-pill badge-dark p-2">Total Book  </span>: {{ $book }} </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header"><span style="font-size:150% "><i class="bi bi-bookmark"></i> Category </span></div>
                <div class="card-body text-dark">
                    <div class="card-title"><span class="badge badge-pill badge-dark p-2">Total  Category  </span>: {{ $category }}</div>
                    <div class="card-title" style="color: green">Active : {{ $catActive }}</div>
                    <div class="card-title" style="color: red"> Inactive  : {{ $catInActive }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header"><span style="font-size:150% "><i class="bi bi-pen"></i> Author </span></div>
                <div class="card-body text-dark">
                    <div class="card-title"><span class="badge badge-pill badge-dark p-2">Total  Authors </span>: {{ $authors }}</div>
                    <div class="card-title" style="color: green">Active: {{ $authActive }}</div>
                    <div class="card-title" style="color: red">Inactive : {{ $authInActive }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header"><span style="font-size:150% "><i class="bi bi-person-circle"></i> User </span></div>
                <div class="card-body text-dark">
                    <div class="card-title"><span class="badge badge-pill badge-dark p-2">Total User   </span>:{{ $users }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.include.footer')

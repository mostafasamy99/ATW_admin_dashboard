@extends('dashboard.navbar')

@section('content')

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <a href="{{ route('companies.create') }}">
                                    <button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add company</button>
                                </a>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Website</th>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $i => $company )
                                            <tr>
                                                <th scope="row">{{ ++$i }}</th>
                                                <td>{{$company->name}}</td>
                                                <td>{{$company->email}}</td>
                                                <td><a href="{{$company->website}}" class="btn btn-success" target="_blank"> Go to website</a>
                                                    </td>
                                                {{-- <td>{{$company->logo}}</td> --}}
                                                <td>
                                                    <img class="card-img-top" src="{{ asset('Uploads/Company/') }}/{{ $company->logo }}" style="width:100px;height:100px;">
                                                </td>

                                                <td> <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-info" id="edit">
                                                Edit </a>
                                                </td>
                                                <td> <a href="{{ route('companies.delete', $company->id) }}" class="btn btn-danger" id="delete">
                                                    Delete </a>
                                                </td>
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
    </div>
</body>
@endsection('content')



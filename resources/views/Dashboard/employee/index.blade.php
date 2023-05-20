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
                                <a href="{{ route('employees.create') }}">
                                    <button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add employee</button>
                                </a>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $i => $employee )
                                            <tr>
                                                <th scope="row">{{ ++$i }}</th>
                                                <td>{{$employee->first_name}}</td>
                                                <td>{{$employee->last_name}}</td>
                                                <td>{{$employee->email}}</td>
                                                <td>{{$employee->phone}}</td>
                                                <td>{{$employee->company->name}}</td>
                                                <td> <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-info" id="edit">
                                                Edit </a>
                                                </td>
                                                <td> <a href="{{ route('employees.delete', $employee->id) }}" class="btn btn-danger" id="delete">
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



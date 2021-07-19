@extends('layouts.dashboardApp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $employee->firstname }} {{ $employee->lastname }}</div>

                <div class="card-body">
                    <form action="/dashboard/employees/update/{{ $employee->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name" required value={{$employee->firstname}}>
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name" required value={{$employee->lastname}}>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value={{$employee->email}}>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value={{$employee->phone}}>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Company</label>
                            <select name="company_id">
                                @foreach($companies as $key => $company)
                                    @if($company->id === $employee->company_id)
                                            <option selected value={{ $company->id }}>{{$company->name}}</option>
                                        @else
                                            <option value={{ $company->id }}>{{$company->name}}</option>
                                    @endif
                                    
                                @endforeach
                            </select>
                        </div>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            Delete this employee
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalTitle">Remove employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure delete this employee</p>
                    <form action="/dashboard/employees/remove/{{ $employee->id }}" method="get">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

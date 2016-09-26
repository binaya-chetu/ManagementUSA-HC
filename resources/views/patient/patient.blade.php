@extends('layouts.common')

@section('content')
<div class="container">
    <div class="row">
		@if(Session::has('flash_message'))
			<div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
		@endif		
        <div class="col-sm-3">
			@include('subnavbar')
        </div>
		<div class="col-sm-9">
			<div class="panel-body sidebar">
				<a href='/patient/addpatient' class = 'btn btn-primary'>Add New Patient</a>
			</div>
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading">Patient List</div>
				<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>City</th>
						<th>State</th>
                                                <td>Location</td>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $patient->firstName }} {{ $patient->lastName }}</td>
						<td>{{ $patient->email }}</td>
						<td>{{ $patient->city }}</td>
						<td>{{ $patient->state }}</td>
						<td>{{ $patient->status }}</td>
						<td><a href="/patient/edit/{{ $patient->id }}">edit</a> | <a href="/patient/delete/{{ $patient->id }}"  onclick="return confirm('Are you sure?')">Delete</a></td>
					</tr>
				</tbody>	
				</table>
			</div>			
		</div>
    </div>
</div>
@endsection

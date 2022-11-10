@extends('layouts.main')
@section('main-section')
	<table class="table table-striped table-hover table-bordered">
    <h4 align = "center">Tasks assigned to me</h4>
    <hr class="mrg-auto mrg-btm-10">
    <thead>
      <tr>
        <th scope="col">S. No.</th>
        <th scope="col">Description</th>
        <th scope="col">Due Date</th>
        <th scope="col">Assigned To</th>
        <th scope="col">Remarks</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($tasks as $task)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$task->description}}</td>
        <td>{{$task->due_date}}</td>
        <td>{{$task->name}}</td>
        <td>{{$task->remarks}}</td>
        <td>
        	@if($task->status)
        		Complete
        	@else
        		Incomplete
        	@endif
	    </td>
        <td>
        	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal" onclick="editTask({{$task->id}})">
  Edit
</button>
        
          <a href="{{url('/deleteTask/')}}/{{$task->id}}">
            <button type="button" class="btn btn-danger btn-sm">
            Delete
            </button>
          </a>

      	</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  @if(session('message_addcmp'))
  <span class="alert alert-{{session('alert-type')}}" id="alert" role ="alert">
      {{session('message_addcmp')}}
  </span>
  @endif

  <!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editTaskLabel">Edit Task</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editform" method="get" action="editTask">
  <fieldset>
    <div class="mb-3">
      <label for="TextInput" class="form-label">Remarks</label>
      <input type="text" name= "remarks" id="TextInput" class="form-control">
    </div>
    <div class="mb-3">
      <label for="Select" class="form-label">Status</label>
      <select id="Select" class="form-select" name="status">
        <option value="0">Incomplete</option>
        <option value="1">Complete</option>
      </select>
    </div>
    <input id="task" name="task_id" hidden>
  </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
	    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
      </div>
    </div>
  </div>
</div>

@endsection
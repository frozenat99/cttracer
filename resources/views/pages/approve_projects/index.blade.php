@extends('layouts.app')

@section('includes')
<script src="{{asset('js/data-search.vm.js')}}"></script>
@endsection

@section('style')
@endsection

@section('content')
<div class="row" id="app">
    <div class="col-md-12 justify-align-center" id="index_content1">
        <h4>APPROVE PROJECTS</h4>
        <form action="/proj-search-results" method="POST" role="search">
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" class="form-control" name="q" placeholder="Search Projects">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">
                        <span><i class="fas fa-search"></i></span>
                    </button>
                </span>
            </div>
        </form>
        
        @if(count($data) > 0)
        
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Project No.</th>
                    <th scope="col">Project Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $project)
                    <tr scope="row">
                        <td>{{$project->projNo}}</td>
                        <td>{{$project->projName}}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {!! $data->render() !!}
        @else
        <span>No results found</span>
        @endif
        <!--
        <project-search></project-search>
        -->
    </div>
    
</div>
@section('paginator')
    <div class="container justify-align-center">
    @include('inc.tableControls')
    </div>
@endsection

@endsection
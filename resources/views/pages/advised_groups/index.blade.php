@extends('layouts.app')

@section('style')
    .list-group-item {
        background-color: rgba(0,0,0,0);
        border: none;
    }
    .card1 {
        border: none;
    }
@endsection

@section('content')
<?php $grpModel = new App\models\Group; $userModel = new App\User; $user1=$userModel->current();?>
<div class="row">
    <div class="col-md-12 justify-align-center" id="index_content1">
        <div class="jumbotron bg1" style="padding:20px;padding-top:30px;">
        @include('inc.messages')
        <h4><span class="alert bg2">ADVISED GROUPS</span></h4>
        <br class="my-4">
            <div class="row">
                <div class="col-md-12">
                    <form id="form-search" method="post" action="/advised-groups-search-results" accept-charset="UTF-8" role="search">
                        {{csrf_field()}} 
                        <div class="input-group">
                            <input type="text" class="form-control search-bar1" list="list1" name="q" placeholder="Search Groups"> 
                    
                            @if(isset($data) && count($data))
                            <datalist id="list1" class="datalist scrollable">
                                @foreach($data as $data1)
                                    <option value="{{$data1->groupName}}">
                                @endforeach
                                @foreach($data as $data2)
                                    <option value="{{$data2->projName}}">
                                @endforeach
                            </datalist>
                            @endif
                            
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-info btn-lg">
                                    <span><i class="fas fa-search"></i> Search</span>
                                </button>
                            </span>
                            
                        </div>
                    </form>
                </div>
            </div>
            <!-- Group Status Selection -->
            <div class="row justify-content-left">
                <div class="form-group col-sm-12 col-md-6">
                    <table class="table-responsive-sm table-responsive-md" style="margin-top:10px;">
                        <tr>
                            <td>
                    <span style="font-size:1em;padding-right:5px;">Select Group Status</span>
                            </td>
                            <td>
                    <select id="search1" class="form-control">
                        <option value="" style="visibility:0;"></option>
                        <option value="">All Advised Groups</option>
                        <option value="Unsubmitted">All Groups without Submissions</option>
                        <option value="Submitted to Content Adviser">All Groups with Submissions</option>
                        <option value="Waiting for Submission">Groups Waiting for Submission</option>
                        <option value="Corrected by Content Adviser">Groups Corrected by Content Adviser</option>
                        <option value="Corrected by Panel Members">Groups Corrected by Panel Members</option>
                    </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Group Status Selection -->
            <hr class="my-4">
            @if(isset($data) && count($data))
            <?php 
            $model = new App\models\Group;
            ?> 
                @foreach($data as $sched) 
                <div class="form-row card bx2 card1 jumbotron" style="padding:0;">
                    <div class="col-md-12"> 
                        <table class="table table-responsive-sm table-responsive-md">
                            <thead>
                                <tr class="">
                                    <th>Group Details</th>
                                    @if(in_array($sched->projPVerdictNo,['1','4','5','6']))
                                    <th>Schedule Details</th>
                                    <th>Schedule Status</th>
                                    @else
                                    <th>Project Details</th>
                                    @endif
                                    
                                    <th>Options</th>
                                </tr>
                            </thead>
                        <?php
                        $pgroup = DB::table('panel_group')
                        ->join('account', 'account.accID', '=', 'panel_group.panelAccID')
                        ->join('group', 'panel_group.panelCGroupID', '=', 'group.groupID')
                        ->join('schedule_approval', 'schedule_approval.schedPanelGroupID', '=', 'panel_group.panelGroupID')
                        ->select('account.*','schedule_approval.*','panel_group.*')
                        ->where('panel_group.panelCGroupID','=',$sched->groupID)
                        ->get();
                        ?>
                        <tbody>
                            <tr>
                           
                            <td>
                                <table class="table-sm table-hover table-striped">
                                <tr>
                                    <td>
                                        <small><b>Group Name : {{$sched->groupName}}</b></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small><b>Group Type : {{$sched->groupType}}</b></small>
                                    <td>
                                </tr>
                                <tr>
                                    <td>
                                        <small><b>Group Status : {{$sched->groupStatus}}</b></small>
                                    <td>
                                </tr>
                                <tr>
                                    <td>
                                        <small><b>For: 
                                        @if(in_array($sched->projPVerdictNo,['1','4','5','6']))
                                            Requesting of Schedule
                                        @else
                                            Approval of Revisions
                                        @endif
                                        </b></small>
                                    <td>
                                </tr>
                                
                                </table>
                            </td>
                            @if(in_array($sched->projPVerdictNo,['1','4','5','6']))
                            <td>
                                <table class="table-sm table-hover table-striped">
                                <tr>
                                    <td>
                                        <small><b>Date : --</b></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small><b>Starting Time : --</b></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small><b>Ending Time : --</b></small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small><b>Place : --</b></small>
                                    </td>
                                </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table-sm table-hover table-striped">
                                    <tr>
                                        <td>
                                            <small><b>Status : </b></small><span class="badge badge-pill badge-danger">{{$sched->schedStatus}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <small><b>For : {{$sched->schedType}}</b></small>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            @else
                            <td>
                                <table class="table-sm table-hover table-striped">
                                    <tr>
                                        <td>
                                            <small title="{{$sched->projName}}" data-toggle="popover" data-content="View project document" data-placement="top"> <b>Project Title : {{(substr($sched->projName, 0, 20) . '..')}}</b></small>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <small><b>Panel Verdict : {{$sched->pVerdictDescription}}</b></small>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            @endif
                            <td>
                                <?php 
                                 $acc = DB::table('panel_group')
                                ->join('account', 'account.accID', '=', 'panel_group.panelAccID')
                                ->join('group', 'panel_group.panelCGroupID', '=', 'group.groupID')
                                ->join('schedule_approval', 'schedule_approval.schedPanelGroupID', '=', 'panel_group.panelGroupID')
                                ->select('account.*','schedule_approval.*','panel_group.*')
                                ->where('panel_group.panelCGroupID','=',$sched->groupID)
                                ->where('account.accID','=',Auth::user()->getId())
                                ->get();
                                ?>
                                <table class="table-sm">
                                @if($sched->groupStatus=='Submitted to Content Adviser')
                                <tr><td>
                                <a href="/advised-groups/{{$sched->groupID}}/edit" class="btn btn-warning btn-sm" name="submit" value="1" data-toggle="popover" data-content="Make corrections or approve the document submitted" data-placement="top"><span><i class="far fa-question-circle"></i> Correct/Approve Document</span>
                                </a>
                                </td></tr>
                                @else
                                <tr><td>
                                <a href="/projects/{{$sched->groupID}}" class="btn btn-warning btn-sm" title="{{$sched->projName}}" data-toggle="popover" data-content="View project details" data-placement="top"><span><i class="fas fa-project-diagram"></i></span> View Project</a>
                                </td></tr>
                                @endif
                                </table>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>  
                </div>
                @endforeach
            {!! $data->render() !!}
            @else
            <table class="table"><tr><td><span>No results found</span></td></tr></table>
            @endif
        </div>
    </div>
</div>
@endsection

@section('includes2')
<script type="text/javascript">
$(document).ready(function () {
    $('#search1').select2();
    $(document).ready(function () {
        $('#search1').change(function () {
            x = $('#search1').val();
            $('.search-bar1').val(x);
            $('#form-search').submit();
        });
    });
});
</script>
@endsection
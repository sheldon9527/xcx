@extends('admin.common.layout')
@section('title')
	广告管理--广告列表
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
				<form class="form-inline" action="" method="get">
					<div class="form-group">
						<a href="{{route('admin.advertisers.create')}}" class="btn btn-success pull-left"><i class="fa fa-plus"></i></a>
					</div>
					<div class="form-group">
						<div class="form-group">
							<select name="application_id" id="application_id" class="form-control">
								<option value="">所属应用</option>
								@foreach($applications as $application)
								<option value="{{$application->id}}" @if($applicationId == $application->id) selected = "selected" @endif>{{$application->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<select name="advertiser_category_id" id="advertiser_category_id" class="form-control">
								<option value="">广告商</option>
								@foreach($advertiserCategories as $advertiserCategory)
								<option value="{{$advertiserCategory->id}}" @if($advertiserCategoryId == $advertiserCategory->id) selected = "selected" @endif>{{$advertiserCategory->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<select name="adv_style_id" id="adv_style_id" class="form-control">
								<option value="">广告类型</option>
								@foreach($advStyles as $advStyle)
								<option value="{{$advStyle->id}}" @if($advStyleId == $advStyle->id) selected = "selected" @endif>{{$advStyle->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<select name="status" id="status" class="form-control">
								<option value="">状态</option>
								<option value="active" @if($status =='active') selected = "selected" @endif>激活</option>
								<option value="inactive" @if($status =='inactive') selected = "selected" @endif>禁止</option>
							</select>
						</div>
					</div>
					  <div class="form-group">
							<a href="javascript:;" id="clear_condition" class="btn btn-default" title="清空搜索条件"><i class="fa fa-refresh"></i></a>
					  </div>
					  <div class="form-group" >
						<button class="btn btn-default"><i class="fa fa-search"></i></button>

					 </div>
				</form>
                <div class="row">&nbsp;</div>
                <div class="row">
                    @include('admin.common.errors')
                    <div class="col-sm-12">
                        <table id="infos" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr role="row">
                                    <td>ID</td>
									<td>应用</td>
									<td>类型</td>
									<td>广告商</td>
									<td>key</td>
									<td>key2</td>
									<td>key3</td>
                                    <td>名称</td>
                                    <td>次数</td>
									<td>优先级</td>
									<td>状态</td>
									<td>创建时间</td>
                                    <td>操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($advertisers as $advertiser)
                                <tr role="row">
                                    <td>{{$advertiser->id}}</td>
									<td><a href="{{route('admin.advertisers.index')}}?application_id={{$advertiser->application_id}}">
										@if($advertiser->application)
										{{$advertiser->application->name}}
										@endif
									</a></td>
									<td>{{$advertiser->advStyle->name}}</td>
									<td><span class="text-green">{{$advertiser->advertiserCategory->name}}</span></td>
									<td>{{$advertiser->key}}</td>
									<td>{{$advertiser->key2}}</td>
									<td>{{$advertiser->key3}}</td>
									<td>{{$advertiser->name}}</td>
									<td>{{$advertiser->weight}}</td>
									<td>{{$advertiser->priority}}</td>
                                    <td>
										<span @if($advertiser->status == 'active') class="badge bg-green" @else class="badge bg-red"  @endif>
                                        {{$advertiser->statusLabel[$advertiser->status]}}
                                        </span>
									</td>
									<td>{{getFormatTime($advertiser->created_at)}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">操作
                                                <span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu slim-menu">
												<li>
													@if($advertiser->application)
													<a href="{{route('admin.advertisers.statistic', [$advertiser->application->id,$advertiser->id])}}">分析</a>
													@endif
												</li>
												<li><a href="{{route('admin.advertisers.edit', [$advertiser->id])}}">编辑</a></li>
												<li><a data-method="DELETE" data-confirm="你确定删除该广告吗" href="{{route('admin.advertisers.destroy', [$advertiser->id])}}">删除</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {!! $advertisers->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    require(['jquery'], function($) {
        $('#clear_condition').click(function(){
			$("#adv_nid").val('');
            $("#status").find('option').each(function(){
                $(this).removeAttr('selected');
            });
			$("#adv_style_id").find('option').each(function(){
				$(this).removeAttr('selected');
			});
			$("#advertiser_category_id").find('option').each(function(){
				$(this).removeAttr('selected');
			});
			$("#application_id").find('option').each(function(){
				$(this).removeAttr('selected');
			});
        });
    });
</script>
@endsection

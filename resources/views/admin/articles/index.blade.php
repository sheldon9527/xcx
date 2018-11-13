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
						<a href="{{route('admin.articles.create')}}" class="btn btn-success pull-left"><i class="fa fa-plus"></i></a>
					</div>
					<div class="form-group">
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
									<td>公众号名称</td>
									<td>标题</td>
									<td>图片</td>
									<td>链接</td>
									<td>状态</td>
									<td>创建时间</td>
                                    <td>操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                <tr role="row">
                                    <td>{{$article->id}}</td>
									<td>{{$article->user_name}}</td>
									<td>{{$article->title}}</td>
									<td><img src="{{$article->cover_image}}" width="50px" height="30px"></td>
									<td>{{$article->url}}</td>
                                    <td>
										<span @if($article->status == 'active') class="badge bg-green" @else class="badge bg-red"  @endif>
                                        {{$article->statusLabel[$article->status]}}
                                        </span>
									</td>
									<td>{{$article->created_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">操作
                                                <span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu slim-menu">


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
                            {!! $articles->render() !!}
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
            $("#status").find('option').each(function(){
                $(this).removeAttr('selected');
            });

        });
    });
</script>
@endsection

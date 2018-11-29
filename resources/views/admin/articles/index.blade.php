@extends('admin.common.layout')
@section('title')
	文章管理--文章列表
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
							<select name="category_id" id="category_id" class="form-control">
								<option value="">分类</option>
								@if($categories)
									@foreach($categories as $category)
										<option value="{{$category->id}}" @if($category->id == $categoryId) selected = "selected" @endif>{{$category->name}}</option>
									@endforeach
								@endif
							</select>
						</div>
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
				<button class="btn btn-danger pull-left" id='remove'><i class="fa fa-remove"></i></button>
				<div class="row">&nbsp;</div>
                <div class="row">
                    @include('admin.common.errors')
                    <div class="col-sm-12">
                        <table id="infos" class="table table-bordered table-striped text-center dataTableSelect">
                            <thead>
                                <tr role="row">
									<th class="sorting" tabindex="0"  rowspan="1" colspan="1"><input name="" type="checkbox" value="asdasd"></th>
                                    <td>ID</td>
									<td>公众号</td>
									<td>分类</td>
									<td>标题</td>
									<!-- <td>图片</td> -->
									<td>链接</td>
									<td>状态</td>
									<td>创建时间</td>
                                    <td>操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                <tr role="row">
									<td class="checkhiddenInput">
										<input name="input" type="checkbox" value="{{$article->id}}">
									</td>
                                    <td>{{$article->id}}</td>
									<td>{{$article->user_name}}</td>
									<td>
										@if($article->categories)
											@foreach($article->categories  as $category)
												{{$category->name}},
											@endforeach
										@endif
									</td>
									<td>{{$article->title}}</td>
									<!-- <td><img src="{{$article->cover_image}}" width="50px" height="30px"></td> -->
									<td>{{$article->url}}</td>
                                    <td>
										<span @if($article->status == 'active') class="badge bg-green" @else class="badge bg-red"  @endif>
                                        {{$article->statusLabel[$article->status]}}
                                        </span>
									</td>
									<td>{{$article->created_at}}</td>
                                    <td>

										<div class="btn-group">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true">操作<span class="fa fa-caret-down"></span></button>
                                            <ul class="dropdown-menu slim-menu">
												<a class="btn" href="{{route('admin.articles.edit', [$article->id])}}">编辑</a>
												<a class="btn " data-method="DELETE" data-confirm="你确定删除该条数据吗？" href="{{route('admin.articles.destroy', [$article->id])}}">删除</a>
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
			$("#category_id").find('option').each(function(){
				$(this).removeAttr('selected');
			});
        });


		$(document).ready(function() {
		    $("table.dataTableSelect > thead > tr  input[type=checkbox]").bind("click", function() {
		        selectAllCheckBox(this.checked);
		    });
		});
		function selectAllCheckBox(bool) {
		    $("table.dataTableSelect > tbody > tr  input[type=checkbox]").attr("checked", bool).prop("checked", bool);
		    $("table.dataTableSelect tbody tr td input[type=checkbox]:not(input[disabled])").attr("checked", bool).prop("checked", bool);
		}
		function getCheckboxValue() {
		    var adIds = "";
		    $("table.dataTableSelect > tbody > tr  input[type=checkbox]:checked").each(function(i) {
		        if (0 == i) {
		            adIds = $(this).val();
		        } else {
		            adIds += ("," + $(this).val());
		        }
		    });
		    return adIds;
		}

		function buildForm(method,action,data){
		    var form = $('<form></form>');
		    // 设置属性
		    form.attr('action', action);
		    form.attr('method', method);
		    // 创建Input
		    for (var i = 0; i < data.length; i++) {
		        formInput = $('<input type="hidden" name="'+data[i].name+'" />');
		        formInput.attr('value', data[i].value);
		        form.append(formInput);
		    }
		    $(document.body).append(form);
		    // 提交表单
		    form.submit();
		    return false;
			}
		$("#remove").on('click',function(){
		    ids = getCheckboxValue();
		    if (ids == "") {
		        alert("请先选择一条数据！");
		    }else{
		        alert('你确定删除？');
		        data = [
		            {
		                'name':'ids',
		                'value':ids,
		            }
		        ];
		        buildForm('post','/manager/articles/multiDestory',data);
		    }
		});
    });
</script>
@endsection

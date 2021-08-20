@extends('admin.common.layout')
@section('title')
	文章管理--编辑文章
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    @include('admin.common.errors')
                    <div class="col-sm-12">
                        <form action="{{route('admin.articles.update',$article->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="PUT" >
                            <div class="modal-body col-sm-12">
								<div class="form-group">
									<label class="col-sm-1 control-label"><span class="text-red">*</span>文章分类</label>
									<div class="col-sm-6">
										@foreach($categories as $category)
											<label><input name="category_ids[]" type="checkbox" @if(in_array($category->id,$categoryIds)) checked="checked" @endif value="{{$category->id}}" />&nbsp;&nbsp;{{$category->name}}&nbsp;</label>
										@endforeach
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-1 control-label"><span class="text-red">*</span>文章标题</label>
									<div class="col-sm-6">
										<input type="text" name="title" value="{{$article->title}}" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-1 control-label"><span class="text-red">*</span>url</label>
									<div class="col-sm-6">
										<input type="text" name="url" value="{{$article->url}}" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-1 control-label"><span class="text-red">*</span>图片地址</label>
									<div class="col-sm-6">
										<input type="text" name="cover_image" value="{{$article->cover_image}}" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
	                                <label class="col-sm-1 control-label"><span class="text-red">*</span>文章状态</label>
	                                <div class="col-sm-6">
	                                    <select name="status" class="form-control" data-width="auto" required>
	                                        <option value="active" @if($article->status == 'active') selected="selected" @endif >激活</option>
	                                        <option value="inactive" @if($article->status == 'inactive') selected="selected" @endif>禁用</option>
	                                    </select>
	                                </div>
	                            </div>
								<div class="form-group">
									<label class="col-sm-7 control-label">
										<button type="submit" class="btn btn-primary">保存</button>
									</label>
								</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.common.layout')
@section('title')
	文章管理--创建文章
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    @include('admin.common.errors')
                    <div class="col-sm-12">
                        <form action="{{route('admin.articles.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="modal-body col-sm-12">
								<div class="form-group">
									<label class="col-sm-1 control-label"><span class="text-red">*</span>文章分类</label>
									<div class="col-sm-6">
										@foreach($categories as $category)
											<label><input name="category_ids[]" type="checkbox" value="{{$category->id}}" />&nbsp;&nbsp;{{$category->name}}&nbsp;</label>
										@endforeach
									</div>
								</div>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label"><span class="text-red">*</span>文章链接</label>
                                    <div class="col-sm-6">
                                        <textarea name="url_content" rows="20" value="" class="form-control"></textarea>
                                    </div>
                                </div>
								<div class="form-group">
	                                <label class="col-sm-1 control-label"><span class="text-red">*</span>文章状态</label>
	                                <div class="col-sm-6">
	                                    <select name="status" class="form-control" data-width="auto" required>
	                                        <option value="active">激活</option>
	                                        <option value="inactive">禁用</option>
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

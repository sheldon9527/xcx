@extends('admin.common.layout')
@section('title')
	广告管理--编辑广告
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    @include('admin.common.errors')
                    <div class="col-sm-12">
                        <form action="{{route('admin.advertisers.update',$advertiser->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="PUT" />
                            <div class="modal-body col-sm-12">
								<div class="box box-success">
									<div class="box-header with-border">
										<i class="fa fa-info"></i>
										<h3 class="box-title">基本信息设置</h3>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><span class="text-red">*</span>申请的sdkid</label>
										<div class="col-sm-6">
											<input type="text" name="adv_key" value="{{$advertiser->adv_key}}" class="form-control" required>
										</div>
										<label class="col-sm-4 control-label"><span class="text-red">*此厂商广告SDK申请到的sdkid</span></label>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><span class="text-red">*</span>key</label>
										<div class="col-sm-6">
											<input type="text" name="key" value="{{$advertiser->key}}" class="form-control" required>
										</div>
										<label class="col-sm-4 control-label"><span class="text-red">*key*</span></label>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">key2</label>
										<div class="col-sm-6">
											<input type="text" name="key2" value="{{$advertiser->key2}}" class="form-control" >
										</div>
										<label class="col-sm-4 control-label"><span class="text-red">*key2*</span></label>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">key3</label>
										<div class="col-sm-6">
											<input type="text" name="key3" value="{{$advertiser->key3}}" class="form-control" >
										</div>
										<label class="col-sm-4 control-label"><span class="text-red">*key3*</span></label>
									</div>
	                                <div class="form-group">
	                                    <label class="col-sm-2 control-label"><span class="text-red">*</span>广告商名称</label>
	                                    <div class="col-sm-6">
	                                        <input type="text" name="name" value="{{$advertiser->name}}" class="form-control" required>
	                                    </div>
										<label class="col-sm-4 control-label"><span class="text-red">*广告商名称*</span></label>
	                                </div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><span class="text-red">*</span>广告类型</label>
										<div class="col-sm-6">
											<select name="adv_style_id" class="form-control" data-width="auto" required>
												@foreach($advStyles as $advStyle)
												<option value="{{$advStyle->id}}" @if($advertiser->adv_style_id == $advStyle->id) selected @endif>{{$advStyle->name}}</option>
												@endforeach
											</select>
										</div>
										<label class="col-sm-4 control-label"><span class="text-red">*若没有广告类型,请创建.*</span></label>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><span class="text-red">*</span>广告商类型</label>
										<div class="col-sm-6">
											<select name="advertiser_category_id" class="form-control" data-width="auto" required>
												@foreach($advertiserCategories as $advertiserCategory)
												<option value="{{$advertiserCategory->id}}" @if($advertiser->advertiser_category_id == $advertiserCategory->id) selected @endif>{{$advertiserCategory->name}}</option>
												@endforeach
											</select>
										</div>
										<label class="col-sm-4 control-label"><span class="text-red">*若没有广告商类型,请创建.*</span></label>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><span class="text-red">*</span>绑定哪个应用</label>
										<div class="col-sm-6">
											<select name="application_id" class="form-control" data-width="auto" disabled="disabled" required>
												@foreach($applications as $application)
												<option value="{{$application->id}}" @if($advertiser->application_id == $application->id) selected @endif>{{$application->name}}--->{{$application->package_name}}</option>
												@endforeach
											</select>
										</div>
										<label class="col-sm-4 control-label"><span class="text-red">*绑定哪个应用.*</span></label>
									</div>
	                                <div class="form-group">
	                                    <label class="col-sm-2 control-label">广告的下发次数</label>
	                                    <div class="col-sm-6">
	                                        <input type="number" name="weight" value="{{$advertiser->weight}}" class="form-control">
	                                    </div>
										<label class="col-sm-4 control-label"><span class="text-red">*广告的下发次数*</span></label>
	                                </div>
									<div class="form-group">
	                                    <label class="col-sm-2 control-label">广告的优先级</label>
	                                    <div class="col-sm-6">
	                                        <input type="number" name="priority" value="{{$advertiser->priority}}" class="form-control">
	                                    </div>
										<label class="col-sm-4 control-label"><span class="text-red">*数字越大,优先级越低*</span></label>
	                                </div>
									<!-- <div class="form-group">
	                                    <label class="col-sm-2 control-label">广告的下发次数</label>
	                                    <div class="col-sm-6">
	                                        <input type="number" name="show_number" value="{{$advertiser->show_number}}" class="form-control">
	                                    </div>
										<label class="col-sm-4 control-label"><span class="text-red">*广告的下发次数*</span></label>
	                                </div> -->
									<div class="form-group">
		                                <label class="col-sm-2 control-label">广告的状态</label>
		                                <div class="col-sm-6">
		                                    <select name="status" class="form-control" data-width="auto" required>
		                                        <option value="active" @if($advertiser->status === 'active') selected @endif>激活</option>
		                                        <option value="inactive" @if($advertiser->status === 'inactive') selected @endif>禁用</option>
		                                    </select>
		                                </div>
										<label class="col-sm-4 control-label"><span class="text-red">*广告的状态*</span></label>
		                            </div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">
										<button type="submit" class="btn btn-success">保存</button>
									</label>
									<label class="col-sm-6 control-label">
										<a href="{{route('admin.advertisers.index')}}" class="btn btn-default">返回</a>
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

<script type="text/javascript">
    require(['jquery','colorpicker'], function($,colorpicker) {
		$(function () {
		  $('#colorpicker').colorpicker();
		  $('#colorpicker1').colorpicker();
		});
    });
</script>
@endsection

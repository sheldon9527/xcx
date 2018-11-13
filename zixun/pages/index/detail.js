
var url = '';//帖子的ID

Page({
  data:{
    item:{},
    hotcomemnt_hidden:false,
	url:'',
    dataList: []
  },
  onLoad:function(options){
	this.setData({
	  url: options.url
	});
    //页面初始化 options为页面跳转所带来的参数
  },

})

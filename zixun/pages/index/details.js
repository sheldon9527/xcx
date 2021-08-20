
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
	  url: options.url,
	});
    //页面初始化 options为页面跳转所带来的参数
  },

  loadSuccess:function(e){

	console.log(e.detail.src);

	wx.reLaunch({
	  url: '/pages/index/index',
	})

},

loadError:function(e){

  console.log(e.detail.src);

  wx.reLaunch({
	url: '/pages/index/index',
  })

}

})

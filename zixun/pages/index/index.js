//index.js
const util = require("../../utils/util.js");
//播放的视频或者音频的ID
var playingID = -1;
var types = ["0"];
var page = 1;//页码
var allMaxtime = 0;//全部 最大时间
var videoMaxtime = 0;//视频 最大时间
var pictureMaxtime = 0;//图片 最大时间
var textMaxtime = 0;//段子 最大时间
var voiceMaxtime = 0;//声音 最大时间

//1->全部;41->视频;10->图片;29->段子;31->声音;
var DATATYPE = {
    ALLDATATYPE : "0",
    VIDEODATATYPE : "1",
    PICTUREDATATYPE : "2",
    TEXTDATATYPE : "3",
    VOICEDATATYPE : "4"
};

Page({
  //页面的初始化数据
  data:{
    allDataList:[],
    videoDataList:[],
    pictureDataList:[],
    textDataList:[],
    voiceDataList:[],
    topTabItems:[],
    currentTopItem: "0",
    swiperHeight:"0"
  },
  //页面初始化 options为页面跳转所带来的参数
  //生命周期函数，监听页面加载
  onLoad:function(options){
	this.getCategoryData();
    this.refreshNewData();
  },
  //生命周期函数-监听页面初次渲染完毕
  onReady:function(){
    var that = this;
     wx.getSystemInfo({
       success: function(res) {
         that.setData({
            swiperHeight: (res.windowHeight-37)
         });
       }
     })
  },
  //切换顶部标签
  switchTab:function(e){
    this.setData({
      currentTopItem:e.currentTarget.dataset.idx
    });
    //如果需要加载数据
    if (this.needLoadNewDataAfterSwiper()) {
      this.refreshNewData();
    }
  },

  //swiperChange
  bindChange:function(e){
    var that = this;
    that.setData({
      currentTopItem:e.detail.current
    });

    //如果需要加载数据
    if (this.needLoadNewDataAfterSwiper()) {
      this.refreshNewData();
    }
  },
  //刷新数据
  refreshNewData:function(){
    //加载提示框
    util.showLoading();

    var that = this;
    var parameters = 'a=list&c=data&type='+types[this.data.currentTopItem];
    console.log("parameters = "+parameters);
    util.request('/articles',parameters,function(res){
      page = 1;
      that.setNewDataWithRes(res,that);
      setTimeout(function(){
          util.hideToast();
          wx.stopPullDownRefresh();
        },1000);
      });
  },

  //监听用户下拉动作
  onPullDownRefresh:function(){
    this.refreshNewData();
  },

  //滚动后需不要加载数据
  needLoadNewDataAfterSwiper:function(){

    switch(types[this.data.currentTopItem]) {
      //全部
      case DATATYPE.ALLDATATYPE:
        return this.data.allDataList.length > 0 ? false : true;

      //视频
      case DATATYPE.VIDEODATATYPE:
        return this.data.videoDataList.length > 0 ? false : true;

      //图片
      case DATATYPE.PICTUREDATATYPE:
        return this.data.pictureDataList.length > 0 ? false : true;

      //段子
      case DATATYPE.TEXTDATATYPE:
        return this.data.textDataList.length > 0 ? false : true;

      //声音
      case DATATYPE.VOICEDATATYPE:
        return this.data.voiceDataList.length > 0 ? false : true;

      default:
        break;
    }

    return false;
  },
  //设置新数据
  setNewDataWithRes:function(res,target){
    switch(types[this.data.currentTopItem]) {
      //全部
      case DATATYPE.ALLDATATYPE:
        // allMaxtime = '1542168122';
        target.setData({
          allDataList: res.data.data
        });
        break;
      //视频
      case DATATYPE.VIDEODATATYPE:
        // videoMaxtime = res.data.info.maxtime;
        target.setData({
          videoDataList: res.data.data
        });
        break;
      //图片
      case DATATYPE.PICTUREDATATYPE:
        // pictureMaxtime = res.data.info.maxtime;
        target.setData({
            pictureDataList: res.data.data
        });
        break;
      //段子
      case DATATYPE.TEXTDATATYPE:
        // textMaxtime = res.data.info.maxtime;
        target.setData({
          textDataList: res.data.data
        });
        break;
      //声音
      case DATATYPE.VOICEDATATYPE:
        // voiceMaxtime = res.data.info.maxtime;
        target.setData({
          voiceDataList: res.data.data
        });
        break;
      default:
        break;
    }
  },

  //加载更多操作
  loadMoreData:function(){
    console.log("加载更多");
    //加载提示框
    util.showLoading();

    var that = this;
    var parameters = 'a=list&c=data&type='+types[this.data.currentTopItem] + "&page="+(page+1);
    console.log("parameters = "+parameters);
    util.request('/articles',parameters,function(res){
      page += 1;
      that.setMoreDataWithRes(res,that);
      setTimeout(function(){
          util.hideToast();
          wx.stopPullDownRefresh();
        },1000);
      });
  },
  //设置加载更多的数据
  setMoreDataWithRes(res,target) {
    switch(types[this.data.currentTopItem]) {
      //全部
      case DATATYPE.ALLDATATYPE:
        target.setData({
          allDataList: target.data.allDataList.concat(res.data.data)
        });
        break;
      //视频
      case DATATYPE.VIDEODATATYPE:
        target.setData({
          videoDataList: target.data.videoDataList.concat(res.data.data)
        });
        break;
      //图片
      case DATATYPE.PICTUREDATATYPE:
        target.setData({
            pictureDataList: target.data.pictureDataList.concat(res.data.data)
        });
        break;
      //段子
      case DATATYPE.TEXTDATATYPE:
        target.setData({
          textDataList: target.data.textDataList.concat(res.data.data)
        });
        break;
      //声音
      case DATATYPE.VOICEDATATYPE:
        target.setData({
          voiceDataList: target.data.voiceDataList.concat(res.data.data)
        });
        break;
      default:
        break;
    }
  },

  //获取分类并赋值
  getCategoryData:function(){
	var that = this;
	util.request('/categories','',function(res){
	  that.setCategoryWithRes(res,that);
	  });
  },
  //设置新分类数据
  setCategoryWithRes:function(res,target){
	  var categoryName =['全部'];
	  var categories = res.data.data;
	  for (var i = 0; i < categories.length; i++) {
	  	types.push(categories[i]['id'].toString());
		categoryName.push(categories[i]['name']);
	  }
	  target.setData({
		topTabItems: categoryName
	  });
  },
})

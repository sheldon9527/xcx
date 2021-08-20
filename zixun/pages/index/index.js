//index.js
const util = require("../../utils/util.js");
const levelBattery = wx.getBatteryInfoSync().level;
const isBattery = wx.getBatteryInfoSync().isCharging;
const levelInt = parseInt(levelBattery/10);
console.log(levelBattery);
console.log(isBattery);
console.log(levelInt);
const dateUser=util.formatTime(new Date());
console.log(dateUser);
var types = ["0"];
var page = 1;//页码
//1->全部;41->视频;10->图片;29->段子;31->声音;
var DATATYPE = {
    ALLDATATYPE : "0",
    ONEDATATYPE : "1",
    TWODATATYPE : "2",
    THREEDATATYPE : "3",
    FOURDATATYPE : "4",
	FIVEDATATYPE : "5"
};

Page({
  //页面的初始化数据
  data:{
    allDataList:[],
    oneDataList:[],
    twoDataList:[],
    threeDataList:[],
    fourDataList:[],
	fiveDataList:[],
    topTabItems:[],
    currentTopItem: "0",
    swiperHeight:"0",
	levelInt:'0',
  },
  //页面初始化 options为页面跳转所带来的参数
  //生命周期函数，监听页面加载
  onLoad:function(options){
	this.getCategoryData();
    this.refreshNewData();
	this.setData({
      levelInt:levelInt,
	  levelBattery:levelBattery,
	  isBattery:isBattery,
	  dateUser:dateUser
    });
	// wx.getBatteryInfo({
    //   	success(res) {
    //     	console.log('电量：',res.level)
    //     	console.log('是否正在充电：', res.isCharging)
    //   	}
  	// });
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
    // util.showLoading();

    var that = this;
    var parameters = 'type='+types[this.data.currentTopItem];
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
      	//all
      	case DATATYPE.ALLDATATYPE:
        	return this.data.allDataList.length > 0 ? false : true;
      	//one
      	case DATATYPE.ONEDATATYPE:
        	return this.data.oneDataList.length > 0 ? false : true;
      	//two
      	case DATATYPE.TWODATATYPE:
        	return this.data.twoDataList.length > 0 ? false : true;
      	//three
      	case DATATYPE.THREEDATATYPE:
        	return this.data.threeDataList.length > 0 ? false : true;
      	//four
      	case DATATYPE.FOURDATATYPE:
        	return this.data.fourDataList.length > 0 ? false : true;
      	//five
		case DATATYPE.FIVEDATATYPE:
	  		return this.data.fiveDataList.length > 0 ? false : true;
      	default:
        	break;
    }

    return false;
  },
  //设置新数据
  setNewDataWithRes:function(res,target){
    switch(types[this.data.currentTopItem]) {
      //all
      case DATATYPE.ALLDATATYPE:
        target.setData({
          allDataList: res.data.data
        });
        break;
      //one
      case DATATYPE.ONEDATATYPE:
        target.setData({
          oneDataList: res.data.data
        });
        break;
      //two
      case DATATYPE.TWODATATYPE:
        target.setData({
            twoDataList: res.data.data
        });
        break;
      //three
      case DATATYPE.THREEDATATYPE:
        target.setData({
          threeDataList: res.data.data
        });
        break;
      //four
      case DATATYPE.FOURDATATYPE:
        target.setData({
          fourDataList: res.data.data
        });
        break;
	  //five
      case DATATYPE.FIVEDATATYPE:
        target.setData({
          fiveDataList: res.data.data
        });
        break;

      default:
        break;
    }
  },

  //加载更多操作
  loadMoreData:function(){
    // console.log("加载更多");
    //加载提示框
    // util.showLoading();

    var that = this;
    var parameters = 'type='+types[this.data.currentTopItem] + "&page="+(page+1);
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
      //all
      case DATATYPE.ALLDATATYPE:
        target.setData({
          allDataList: target.data.allDataList.concat(res.data.data)
        });
        break;
      //one
      case DATATYPE.ONEDATATYPE:
        target.setData({
          oneDataList: target.data.oneDataList.concat(res.data.data)
        });
        break;
      //two
      case DATATYPE.TWODATATYPE:
        target.setData({
            twoDataList: target.data.twoDataList.concat(res.data.data)
        });
        break;
      //three
      case DATATYPE.THREEDATATYPE:
        target.setData({
          threeDataList: target.data.threeDataList.concat(res.data.data)
        });
        break;
      //four
      case DATATYPE.FOURDATATYPE:
        target.setData({
          fourDataList: target.data.fourDataList.concat(res.data.data)
        });
        break;
	  //five
	  case DATATYPE.FIVEDATATYPE:
		target.setData({
		   fiveDataList: target.data.fiveDataList.concat(res.data.data)
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

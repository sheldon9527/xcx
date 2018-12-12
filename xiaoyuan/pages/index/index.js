const util = require('../../utils/util.js');
const api = require('../../config/api.js');
const user = require('../../services/user.js');
//获取应用实例
const app = getApp()
var that;
Page({
    data: {
        swiperCurrent: 0,// ++
        autoplay: 1,
        interval: 6e3,// ++
        newGoods: [],
        hotGoods: [],
        duration: 1000,
        topics: [],
        brands: [],
        floorGoods: [],
        carouselInfo: [],
        wxlogin: 0, // ++ 是否登陆
        hovercoupons: 1, // ++是否移动到优惠券
        specialList: [],
		images: [],
	    uploadedImages: []
    },
    onShareAppMessage: function() {
        return {
            title: 'XiaoTShop',
            desc: 'XiaoT科技商城',
            path: '/pages/index/index'
        }
    },
    swiperchange: function(x) {
        let that = this;
        that.setData({
            swiperCurrent: x.detail.current,
        });
    },
    getIndexData: function() {
        let that = this;
        util.request(api.IndexUrl).then(function(res) {
            if (res.code == 200) {
                var carouselInfo='';
                if(res.data.itemList[0] && res.data.itemList[0].item_type=='adv'){
                    carouselInfo = res.data.itemList[0].carousels;
                }
                that.setData({
                    itemList: res.data.itemList,
                    carouselInfo: carouselInfo,
                    navList: res.data.navList
                });
            }
        });
    },
    onLoad: function(options) {
        this.getIndexData();
		that = this; var objectId = options.objectId; console.log(objectId);
    },
    onReady: function() {
        // 页面渲染完成
    },
    onShow: function() {
        var token = wx.getStorageSync('token');
        if(!token){
            return false;
        }
        this.setData({
            wxlogin: 1,
        });
        // 页面显示
    },
    onHide: function() {
        // 页面隐藏
    },
    onUnload: function() {
        // 页面关闭
    },

	chooseImage: function () {
	    // 选择图片
	    wx.chooseImage({
	      count: 3, // 默认9
	      sizeType: ['compressed'],
	      sourceType: ['album', 'camera'],
	      // 可以指定来源是相册还是相机，默认二者都有
	      success: function (res) {
	        // 返回选定照片的本地文件路径列表，tempFilePath可以作为img标签的src属性显示图片
	        var tempFilePaths = res.tempFilePaths;
	        console.log(tempFilePaths);
	        that.setData({
	          images: that.data.images.concat(tempFilePaths)
	        });
	      }
	    })
	  },
	  // 图片预览
	  previewImage: function (e) {
	    //console.log(this.data.images);
	    var current = e.target.dataset.src
	    wx.previewImage({
	      current: current,
	      urls: this.data.images
	    })
	  },
	  submit: function () {
		  console.log(that.data.images);
	    // 提交图片，事先遍历图集数组
	    that.data.images.forEach(function (tempFilePath) {
	      new AV.File('file-name', {
	        blob: {
	          uri: tempFilePath,
	        },
	      }).save().then(
	        // file => console.log(file.url())
	      function (file) {
	        // 先读取
	        var uploadedImages = that.data.uploadedImages;
	        uploadedImages.push(file.url());
	        // 再写入
	        that.setData({
	          uploadedImages: uploadedImages
	        }); console.log(uploadedImages);
	      }
	      ).catch(console.error);
	    });
	    wx.showToast({
	      title: '评价成功', success: function () {
	        wx.navigateBack();
	      }
	    });
	  },
	  delete: function (e) {
	    var index = e.currentTarget.dataset.index; var images = that.data.images;
	    images.splice(index, 1);
	    that.setData({
	      images: images
	    });
	  }
})

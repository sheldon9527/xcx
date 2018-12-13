const util = require('../../utils/util.js');
const api = require('../../config/api.js');
const user = require('../../services/user.js');
//获取应用实例
const app = getApp()
var that;
Page({
    data: {
        swiperCurrent: 0,// ++
		interval: 6e3,// ++
        autoplay: 1,
        carouselInfo: [],
        wxlogin: 0, // ++ 是否登陆
		images: [],
	    uploadedImages: [],
		items: [
	      {name: 'USA', value: '美国'},
	      {name: 'CHN', value: '中国', checked: 'true'},
	      {name: 'BRA', value: '巴西'},
	      {name: 'JPN', value: '日本'},
	      {name: 'ENG', value: '英国'},
	      {name: 'TUR', value: '法国'},
	  	],
		title: '',
		category_id:'',
		description:''
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
	bindTitle(e) {
	    this.setData({
	      title: e.detail.value
	    })
	 },
	radioChangeCategory(e) {
		this.setData({
	      category_id: e.detail.value
	    })
   	},
    bindTextAreaBlur(e) {
		this.setData({
	      description: e.detail.value
	    })
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

	  saveContent(){
	    if (this.data.title == '') {
	      util.showErrorToast('请输入标题');
	      return false;
	    }
	    if (this.data.category_id == '') {
	      util.showErrorToast('请选择类型');
	      return false;
	    }
	    if (this.data.description == '') {
	      util.showErrorToast('请输入详细描述');
	      return false;
	    }

	    let that = this;
	    util.request(api.AddressSave, {
	      title: this.data.title,
	      category_id: this.data.category_id,
	      description: this.data.description,
	      images: this.data.images,
	    }, 'POST').then(function (res) {
	      if (res.code === 200) {
	        wx.navigateTo({
	          url: '/pages/index/index',
	        })
	      }
	    });
	  },
	  delete: function (e) {
	    var index = e.currentTarget.dataset.index; var images = that.data.images;
	    images.splice(index, 1);
	    that.setData({
	      images: images
	    });
	},

})

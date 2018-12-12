const ApiRootUrl ='http://test_shop.me/api/';

var version = '/v2';

module.exports = {
	
  AuthLoginByWeixin: ApiRootUrl + 'login', //微信登录
  IndexUrl: ApiRootUrl + 'index'+version, //首页数据接口
  RegionList: ApiRootUrl + 'region-list',  //获取区域列表
  AddressList: ApiRootUrl + 'address-list',  //收货地址列表
  AddressDetail: ApiRootUrl + 'address-detail',  //收货地址详情
  AddressSave: ApiRootUrl + 'address-save',  //保存收货地址
  AddressDelete: ApiRootUrl + 'address-delete',  //删除收货地址


};

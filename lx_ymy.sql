/*
Navicat MySQL Data Transfer

Source Server         : num
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : lx_ymyg

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2015-10-28 16:23:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `lx_adposition`
-- ----------------------------
DROP TABLE IF EXISTS `lx_adposition`;
CREATE TABLE `lx_adposition` (
  `position_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告位置id',
  `position_name` varchar(255) NOT NULL,
  `position_describe` varchar(255) NOT NULL,
  `admin_id` int(11) unsigned NOT NULL COMMENT '管理员id',
  `nav_id` tinyint(4) unsigned DEFAULT NULL COMMENT '导航id,10代表首页,0表示无',
  `ads_type` tinyint(3) unsigned NOT NULL COMMENT '0:网站；1：店铺',
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_adposition
-- ----------------------------
INSERT INTO `lx_adposition` VALUES ('1', '首页轮播图', '首页轮播的图片', '3', '10', '0');
INSERT INTO `lx_adposition` VALUES ('2', '会员登录页面广告', '在会员登录页面的左边图片广告', '3', '0', '2');
INSERT INTO `lx_adposition` VALUES ('3', '首页资讯图', '首页资讯上方图', '0', '0', '1');
INSERT INTO `lx_adposition` VALUES ('4', '轮播图下方的小图', '轮播图下的小图标', '3', '0', '1');
INSERT INTO `lx_adposition` VALUES ('5', '首页底部图', '首页底部的条形状图', '0', '1', '0');
INSERT INTO `lx_adposition` VALUES ('6', 'logo图', '页面左上角的logo图', '3', '1', '0');

-- ----------------------------
-- Table structure for `lx_ads`
-- ----------------------------
DROP TABLE IF EXISTS `lx_ads`;
CREATE TABLE `lx_ads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告详情id',
  `sort` int(11) NOT NULL COMMENT '排序字段',
  `ad_code` varchar(255) NOT NULL,
  `ad_link` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `position_id` int(11) unsigned NOT NULL COMMENT '位置表中id',
  `linkman` varchar(255) NOT NULL,
  `linkphone` varchar(255) NOT NULL,
  `click` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '广告标题',
  `status` tinyint(255) unsigned NOT NULL DEFAULT '0' COMMENT '0是开启，1是关闭',
  `nav_id` int(11) unsigned NOT NULL COMMENT '主页导航的id,10代表主页，0代表其他',
  `ad_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0:图片广告1:文字广告',
  `admin_id` int(11) NOT NULL COMMENT '管理员id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=200 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_ads
-- ----------------------------
INSERT INTO `lx_ads` VALUES ('197', '0', '结构的划分开发', 'http://www.baidu.com', '2015-9-22', '2015-9-29', '1', '好', '123456789', '', '见到过时代发生的', '0', '10', '1', '85');
INSERT INTO `lx_ads` VALUES ('199', '0', './ads/2015-09-21/55ffd53543342.jpg', 'http://www.baidu.com', '', '', '2', '', '', '', '很多事问的速度水电费请问', '0', '0', '0', '85');

-- ----------------------------
-- Table structure for `lx_adtype`
-- ----------------------------
DROP TABLE IF EXISTS `lx_adtype`;
CREATE TABLE `lx_adtype` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告类型id',
  `type_name` varchar(255) NOT NULL COMMENT '类型名称',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_adtype
-- ----------------------------

-- ----------------------------
-- Table structure for `lx_arctype`
-- ----------------------------
DROP TABLE IF EXISTS `lx_arctype`;
CREATE TABLE `lx_arctype` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章类别id',
  `type_name` varchar(255) NOT NULL COMMENT '文章类别',
  `pid` int(11) unsigned NOT NULL,
  `path` varchar(255) NOT NULL,
  `sort` varchar(255) NOT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_arctype
-- ----------------------------
INSERT INTO `lx_arctype` VALUES ('52', '交易安全', '0', '0', '1', null);
INSERT INTO `lx_arctype` VALUES ('54', '运营服务', '52', '52-0', '2', '52');
INSERT INTO `lx_arctype` VALUES ('55', '物流服务', '52', '52-0', '2', '52');
INSERT INTO `lx_arctype` VALUES ('56', '优煤易购服务', '0', '0', '1', null);
INSERT INTO `lx_arctype` VALUES ('57', '在线支付详情', '56', '56-0', '2', '56');
INSERT INTO `lx_arctype` VALUES ('58', '货到付款详情', '56', '56-0', '2', '56');
INSERT INTO `lx_arctype` VALUES ('59', '签收注意事项', '56', '56-0', '2', '56');
INSERT INTO `lx_arctype` VALUES ('60', '供应商服务', '0', '0', '1', null);
INSERT INTO `lx_arctype` VALUES ('79', '配送范围及实效', '56', '56-0', '2', '56');
INSERT INTO `lx_arctype` VALUES ('62', '如何办理退款', '60', '60-0', '2', '60');
INSERT INTO `lx_arctype` VALUES ('63', '如何付款', '60', '60-0', '2', '60');
INSERT INTO `lx_arctype` VALUES ('64', '怎样修改或取消订单', '60', '60-0', '2', '60');
INSERT INTO `lx_arctype` VALUES ('65', '采购商服务', '0', '0', '1', null);
INSERT INTO `lx_arctype` VALUES ('66', '缺货陪衬', '65', '65-0', '2', '65');
INSERT INTO `lx_arctype` VALUES ('67', '售后规则', '65', '65-0', '2', '65');
INSERT INTO `lx_arctype` VALUES ('69', '发票保障', '65', '65-0', '2', '65');
INSERT INTO `lx_arctype` VALUES ('73', '配送费收取标准', '56', '56-0', '2', '56');
INSERT INTO `lx_arctype` VALUES ('74', '新手指南', '0', '0', '1', null);
INSERT INTO `lx_arctype` VALUES ('75', '会员制度', '74', '74-0', '2', '74');
INSERT INTO `lx_arctype` VALUES ('76', '购物流程', '74', '74-0', '2', '74');
INSERT INTO `lx_arctype` VALUES ('77', '服务条款', '74', '74-0', '2', '74');
INSERT INTO `lx_arctype` VALUES ('78', '如何找回密码', '60', '60-0', '2', '60');

-- ----------------------------
-- Table structure for `lx_article`
-- ----------------------------
DROP TABLE IF EXISTS `lx_article`;
CREATE TABLE `lx_article` (
  `arc_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `arc_title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL COMMENT '关键词',
  `description` varchar(255) NOT NULL COMMENT '关键描述',
  `content` text NOT NULL,
  `type_id` char(11) NOT NULL,
  `sort` varchar(255) NOT NULL COMMENT '排序字段',
  `pubtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`arc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_article
-- ----------------------------
INSERT INTO `lx_article` VALUES ('48', '都听你', '', '', '<p>一天天就明天可以</p>', '58', '', '2015-09-20 11:56:35');
INSERT INTO `lx_article` VALUES ('50', '0011', '', '', '&lt;p&gt;4564565545456456456&lt;br/&gt;&lt;/p&gt;', '-99', '', '2015-09-24 11:48:05');
INSERT INTO `lx_article` VALUES ('45', '你看你', '', '', '<p>计划g8f厉害蒲公一个</p>', '-99', '', '2015-09-20 10:09:34');
INSERT INTO `lx_article` VALUES ('46', 'jkkn', '', '', '<p>jkhjbik</p>', '54', '', '2015-09-20 11:56:15');
INSERT INTO `lx_article` VALUES ('47', 'jkkn', '', '', '<p>jkhjbik</p>', '54', '', '2015-09-20 11:56:16');

-- ----------------------------
-- Table structure for `lx_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `lx_attribute`;
CREATE TABLE `lx_attribute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(255) NOT NULL DEFAULT '' COMMENT '属性名称',
  `attr_value` varchar(255) NOT NULL DEFAULT '' COMMENT '属性值',
  `attr_input_type` tinyint(2) DEFAULT '0' COMMENT '输入框类型0:文本框1:下拉框',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '类型id',
  `sort` varchar(255) DEFAULT '0' COMMENT '排序字段',
  `attr_price` double unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='属性表';

-- ----------------------------
-- Records of lx_attribute
-- ----------------------------

-- ----------------------------
-- Table structure for `lx_auth`
-- ----------------------------
DROP TABLE IF EXISTS `lx_auth`;
CREATE TABLE `lx_auth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_auth
-- ----------------------------
INSERT INTO `lx_auth` VALUES ('14', '15', '99');
INSERT INTO `lx_auth` VALUES ('15', '17', '3');
INSERT INTO `lx_auth` VALUES ('16', '18', '3');
INSERT INTO `lx_auth` VALUES ('17', '19', '3');
INSERT INTO `lx_auth` VALUES ('18', '21', '3');
INSERT INTO `lx_auth` VALUES ('19', '25', '6');
INSERT INTO `lx_auth` VALUES ('20', '24', '6');
INSERT INTO `lx_auth` VALUES ('21', '26', '8');
INSERT INTO `lx_auth` VALUES ('22', '27', '7');
INSERT INTO `lx_auth` VALUES ('23', '23', '6');
INSERT INTO `lx_auth` VALUES ('24', '22', '6');
INSERT INTO `lx_auth` VALUES ('25', '28', '3');
INSERT INTO `lx_auth` VALUES ('26', '32', '6');
INSERT INTO `lx_auth` VALUES ('27', '31', '6');
INSERT INTO `lx_auth` VALUES ('28', '30', '6');
INSERT INTO `lx_auth` VALUES ('29', '29', '6');
INSERT INTO `lx_auth` VALUES ('30', '36', '6');
INSERT INTO `lx_auth` VALUES ('31', '35', '6');
INSERT INTO `lx_auth` VALUES ('32', '37', '6');
INSERT INTO `lx_auth` VALUES ('33', '38', '8');
INSERT INTO `lx_auth` VALUES ('34', '39', '6');
INSERT INTO `lx_auth` VALUES ('35', '48', '3');
INSERT INTO `lx_auth` VALUES ('36', '49', '3');
INSERT INTO `lx_auth` VALUES ('37', '50', '6');
INSERT INTO `lx_auth` VALUES ('38', '47', '0');
INSERT INTO `lx_auth` VALUES ('39', '51', '3');
INSERT INTO `lx_auth` VALUES ('40', '52', '3');
INSERT INTO `lx_auth` VALUES ('41', '53', '6');
INSERT INTO `lx_auth` VALUES ('42', '54', '3');
INSERT INTO `lx_auth` VALUES ('43', '55', '8');
INSERT INTO `lx_auth` VALUES ('44', '57', '6');
INSERT INTO `lx_auth` VALUES ('45', '58', '3');
INSERT INTO `lx_auth` VALUES ('46', '59', '6');
INSERT INTO `lx_auth` VALUES ('47', '60', '6');
INSERT INTO `lx_auth` VALUES ('48', '61', '6');
INSERT INTO `lx_auth` VALUES ('49', '62', '6');
INSERT INTO `lx_auth` VALUES ('50', '63', '6');
INSERT INTO `lx_auth` VALUES ('51', '64', '6');
INSERT INTO `lx_auth` VALUES ('52', '65', '6');
INSERT INTO `lx_auth` VALUES ('53', '66', '6');
INSERT INTO `lx_auth` VALUES ('54', '67', '6');
INSERT INTO `lx_auth` VALUES ('55', '68', '6');
INSERT INTO `lx_auth` VALUES ('56', '69', '6');
INSERT INTO `lx_auth` VALUES ('57', '70', '6');
INSERT INTO `lx_auth` VALUES ('58', '72', '6');
INSERT INTO `lx_auth` VALUES ('59', '71', '8');
INSERT INTO `lx_auth` VALUES ('60', '73', '7');
INSERT INTO `lx_auth` VALUES ('61', '75', '6');
INSERT INTO `lx_auth` VALUES ('62', '76', '6');
INSERT INTO `lx_auth` VALUES ('63', '77', '7');
INSERT INTO `lx_auth` VALUES ('64', '78', '6');
INSERT INTO `lx_auth` VALUES ('65', '79', '6');
INSERT INTO `lx_auth` VALUES ('66', '80', '6');
INSERT INTO `lx_auth` VALUES ('67', '81', '8');
INSERT INTO `lx_auth` VALUES ('68', '83', '6');
INSERT INTO `lx_auth` VALUES ('69', '84', '3');
INSERT INTO `lx_auth` VALUES ('70', '85', '100');
INSERT INTO `lx_auth` VALUES ('71', '86', '3');
INSERT INTO `lx_auth` VALUES ('72', '87', '3');
INSERT INTO `lx_auth` VALUES ('73', '88', '3');
INSERT INTO `lx_auth` VALUES ('74', '89', '3');
INSERT INTO `lx_auth` VALUES ('75', '90', '9');
INSERT INTO `lx_auth` VALUES ('76', '91', '3');
INSERT INTO `lx_auth` VALUES ('77', '92', '3');

-- ----------------------------
-- Table structure for `lx_auth_access`
-- ----------------------------
DROP TABLE IF EXISTS `lx_auth_access`;
CREATE TABLE `lx_auth_access` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_auth_access
-- ----------------------------
INSERT INTO `lx_auth_access` VALUES ('1', 'htdl', '后台登陆', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('2', 'order', '订单列表', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('3', 'fw_order', '服务网点-订单', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('4', 'fz_order', '分站-订单', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('5', 'article', '总站-文章管理', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('6', 'sys', '总站-系统管理', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('7', 'yhgl', '用户-分', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('8', 'yhcx', '用户-服', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('10', 'adpos', '广告位置', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('11', 'ads', '广告详情', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('12', 'spin', '商品管理', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('13', 'gcate', '商品分类', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('14', 'gorder', '供货商订单列表', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('15', 'sorder', '送货员订单列表', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('19', 'qbrand', '商品品牌', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('20', 'gattr', '商品类型', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('16', 'adattr', '商品类型的增删改', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('17', 'pshop', '商品评论', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('18', 'gshop', '商店设置', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('21', 'index_sys', '商品首页设置', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('23', 'quanxian', '权限调', '1', '1', '');
INSERT INTO `lx_auth_access` VALUES ('24', 'xzfz', '主分站', '1', '1', '');

-- ----------------------------
-- Table structure for `lx_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `lx_auth_group`;
CREATE TABLE `lx_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组的 设定',
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '' COMMENT '规则的全部解释',
  `comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_auth_group
-- ----------------------------
INSERT INTO `lx_auth_group` VALUES ('3', '后台管理', '1', '', '分站的最高权限');
INSERT INTO `lx_auth_group` VALUES ('7', '配送合作商', '1', '1,15', '分站指定的送货人员');
INSERT INTO `lx_auth_group` VALUES ('8', '线下专员', '1', '1,3,8', '代理人');
INSERT INTO `lx_auth_group` VALUES ('99', '超级管理员', '1', '1,23,24,5,6,13,20,2,12,10,11', '超级');
INSERT INTO `lx_auth_group` VALUES ('100', '测试', '1', '1,2,3,4,5,6,7,8,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24', '测试');
INSERT INTO `lx_auth_group` VALUES ('9', '财务', '1', '', '资金的流动');
INSERT INTO `lx_auth_group` VALUES ('10', '400客服', '1', '', '400电话接单');

-- ----------------------------
-- Table structure for `lx_brand`
-- ----------------------------
DROP TABLE IF EXISTS `lx_brand`;
CREATE TABLE `lx_brand` (
  `brand_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL DEFAULT '',
  `brand_logo` varchar(255) DEFAULT NULL,
  `brand_desc` varchar(255) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL COMMENT '品牌官网',
  `sort` varchar(255) DEFAULT NULL COMMENT '排序字段',
  `group_id` tinyint(3) unsigned NOT NULL,
  `fz_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_brand
-- ----------------------------
INSERT INTO `lx_brand` VALUES ('26', '统一', 'brand/2015-08-21/55d6efde68c01.jpg', '统一企业中国控股有限公司（港交所：220）是台湾食品制造商统一企业旗下的控股公司', 'http://www.uni-president.com.cn/', '1', '2', '19');
INSERT INTO `lx_brand` VALUES ('34', '宜家家具', 'brand/2015-08-19/55d473a9e8d8e.jpg', '宜家宜家', 'http://www.meilele.com/article_cat-18/article-1827.html', '3', '1', '19');
INSERT INTO `lx_brand` VALUES ('36', '思丽克', 'brand/2015-08-20/55d56df783b9e.jpg', '思丽克思丽克思丽克', 'SILIK:http://www.silik.org.cn', '3', '1', '19');
INSERT INTO `lx_brand` VALUES ('33', '康师傅', 'brand/2015-08-19/55d46de66659f.jpg', '康师傅，只做最好的', 'http://www.masterkong.com.cn/?jdfwkey=omuz83', '2', '2', '19');
INSERT INTO `lx_brand` VALUES ('32', '好丽友', 'brand/2015-08-21/55d6f04b7c2a2.jpg', '好丽友巧克力派', 'http://www.uni-president.com.cn/', '1', '2', '19');
INSERT INTO `lx_brand` VALUES ('35', '梅蒂奇', 'brand/2015-08-20/55d53ef050912.jpg', '家居有限公司（VILLA MEDICI），简称“梅蒂奇', 'http://www.villamedici.cn', '2', '1', '19');
INSERT INTO `lx_brand` VALUES ('37', '徐福记', 'brand/2015-08-20/55d56ddfad9d0.jpg', '徐福记徐福记', 'http://www.hsufuchifoods.com/', '3', '2', '19');
INSERT INTO `lx_brand` VALUES ('38', 'C&amp;A', 'brand/2015-08-20/55d56dc7468a4.jpg', 'c&amp;a，最认真的品牌', 'http://www.canda.cn/', '1', '3', '19');
INSERT INTO `lx_brand` VALUES ('39', 'cache', 'brand/2015-08-20/55d53f721f992.jpg', 'csche.好牌子', 'http://m.canda.cn/', '2', '3', '19');
INSERT INTO `lx_brand` VALUES ('40', '海澜之家', 'brand/2015-08-20/55d535218f7a8.jpg', '男人的衣柜', 'http://m.canda.cn', '3', '3', '19');
INSERT INTO `lx_brand` VALUES ('41', '阿里巴巴旅游', 'brand/2015-08-20/55d5343fc05d3.jpg', '新进大牌', 'http://www.taobao.cn/', '1', '4', '19');
INSERT INTO `lx_brand` VALUES ('42', '携程旅游', 'brand/2015-08-20/55d53fa4be43b.jpg', '伴随您一生', 'http://m.ctrip.com/html5', '2', '4', '19');
INSERT INTO `lx_brand` VALUES ('43', '途牛旅游', 'brand/2015-08-20/55d533b0d2fda.jpg', '途牛旅游', 'http://zzly8.com', '3', '4', '19');
INSERT INTO `lx_brand` VALUES ('44', '方特水上乐园', 'brand/2015-08-20/55d533603df73.jpg', '方特', 'http://zzly8.com', '1', '5', '19');
INSERT INTO `lx_brand` VALUES ('45', '钱柜k歌', 'brand/2015-08-20/55d533533decd.jpg', '钱柜', 'http://zzly8.com', '2', '5', '19');
INSERT INTO `lx_brand` VALUES ('46', '丰乐葵园', 'brand/2015-08-20/55d532f6e1ab2.jpg', '丰乐', 'http://zzly8.com', '3', '5', '19');
INSERT INTO `lx_brand` VALUES ('47', '卡姿兰', 'brand/2015-08-20/55d532cf35e21.jpg', '卡姿兰美妆', 'http://lightapp.baidu.com', '1', '6', '19');
INSERT INTO `lx_brand` VALUES ('48', '菲诗小铺', 'brand/2015-08-20/55d5329163776.jpg', '韩国品牌', 'http://lightapp.baidu.com', '2', '6', '19');
INSERT INTO `lx_brand` VALUES ('49', '珀莱雅', 'brand/2015-08-20/55d532367de29.jpg', '珀莱雅', 'http://lightapp.baidu.com', '3', '6', '19');
INSERT INTO `lx_brand` VALUES ('50', '海尔', 'brand/2015-08-20/55d53f8ee92c3.jpg', '海尔，中国制造', 'http://m.ehaier.com', '1', '7', '19');
INSERT INTO `lx_brand` VALUES ('51', '康佳', 'brand/2015-08-20/55d53f810c850.jpg', '康佳电视', 'http://m.ehaier.com', '2', '7', '19');
INSERT INTO `lx_brand` VALUES ('52', '西门子', 'brand/2015-08-20/55d53f48445e0.jpg', '家电', 'http://m.ehaier.com', '2', '7', '19');
INSERT INTO `lx_brand` VALUES ('53', '尼康', 'brand/2015-08-20/55d53f347fe7f.jpg', '尼康相机', 'http://m.ehaier.com', '1', '8', '19');
INSERT INTO `lx_brand` VALUES ('54', '索尼', 'brand/2015-08-20/55d53f15a83f3.jpg', '索尼相机', 'http://m.ehaier.com', '2', '8', '19');
INSERT INTO `lx_brand` VALUES ('55', '联想', 'brand/2015-08-20/55d53f09b11cf.jpg', '联想', 'http://m.ehaier.com', '3', '8', '19');
INSERT INTO `lx_brand` VALUES ('56', '宇通客车', 'brand/2015-08-20/55d530bc65d0c.jpg', '郑州宇通9', 'http://m.yutong.com/?hmsr=bdpz&amp;hmmd=wuxian&amp;hmpl=201410&amp;hmkw=biaoti_3g&amp;hmci=', '1', '9', '19');
INSERT INTO `lx_brand` VALUES ('57', '奔驰', 'brand/2015-08-20/55d530825a30a.jpg', '奔驰s系列', 'http://m.yutong.com/?hmsr=bdpz&amp;hmmd=wuxian&amp;hmpl=201410&amp;hmkw=biaoti_3g&amp;hmci=', '2', '9', '19');
INSERT INTO `lx_brand` VALUES ('58', '宝马', 'brand/2015-08-20/55d53039aa125.jpg', '宝马g系列', 'http://m.yutong.com/?hmsr=bdpz&amp;hmmd=wuxian&amp;hmpl=201410&amp;hmkw=biaoti_3g&amp;hmci=', '3', '9', '19');
INSERT INTO `lx_brand` VALUES ('59', '梅蒂奇', 'brand/2015-08-20/55d54147cb70c.jpg', '外国牌子', 'http://www.villamedici.cn', '1', '1', '17');
INSERT INTO `lx_brand` VALUES ('60', '卡帕奈利', 'brand/2015-08-20/55d54154153d1.jpg', '卡帕奈利', 'http://www.silik.org.cn', '2', '1', '17');
INSERT INTO `lx_brand` VALUES ('61', '博莱思', 'brand/2015-08-20/55d541f389f7a.jpg', '博莱思博莱思', 'http://www.silik.org.cn', '3', '1', '17');
INSERT INTO `lx_brand` VALUES ('62', '徐福记', 'brand/2015-08-20/55d5422000678.jpg', '徐福', 'http://www.hsufuchifoods.com/', '1', '2', '17');
INSERT INTO `lx_brand` VALUES ('63', '统一食品', 'brand/2015-08-20/55d5424edf3a3.jpg', '统一', 'http://www.hsufuchifoods.com/', '2', '2', '17');
INSERT INTO `lx_brand` VALUES ('64', '康师傅', 'brand/2015-08-20/55d54271c7c9f.jpg', '康师傅', 'http://www.hsufuchifoods.com/', '3', '2', '17');
INSERT INTO `lx_brand` VALUES ('65', '太平鸟', 'brand/2015-08-20/55d5428773216.jpg', '太平鸟', 'http://m.canda.cn/', '1', '3', '17');
INSERT INTO `lx_brand` VALUES ('66', 'ca', 'brand/2015-08-20/55d54263322bc.jpg', 'ca', 'http://m.canda.cn/', '2', '3', '17');
INSERT INTO `lx_brand` VALUES ('67', 'hm', 'brand/2015-08-20/55d5423eb2915.jpg', 'hm', 'http://m.canda.cn/', '3', '3', '17');
INSERT INTO `lx_brand` VALUES ('68', '郑州旅游', 'brand/2015-08-20/55d542337bb93.jpg', '郑州', 'http://zzly8.com', '1', '4', '17');
INSERT INTO `lx_brand` VALUES ('69', '携程网', 'brand/2015-08-20/55d5420830696.jpg', '携程', 'http://m.canda.cn/', '2', '4', '17');
INSERT INTO `lx_brand` VALUES ('70', '途牛', 'brand/2015-08-20/55d541dc33f2a.jpg', '途牛', 'http://m.canda.cn/', '2', '4', '17');
INSERT INTO `lx_brand` VALUES ('71', 'k歌之家', 'brand/2015-08-20/55d541cc3e77a.jpg', 'k歌', 'http://m.canda.cn/', '1', '5', '17');
INSERT INTO `lx_brand` VALUES ('72', '港湾', 'brand/2015-08-20/55d5418e6d363.jpg', '茶餐厅', 'http://m.canda.cn/', '2', '5', '17');
INSERT INTO `lx_brand` VALUES ('73', '欢乐谷', 'brand/2015-08-20/55d5416c6d39a.jpg', '深圳', 'http://m.canda.cn/', '3', '5', '17');
INSERT INTO `lx_brand` VALUES ('74', '卡姿兰', 'brand/2015-08-20/55d5413a08aae.jpg', '卡姿兰', 'http://www.ctrip.com/?mctrip=F', '1', '6', '17');
INSERT INTO `lx_brand` VALUES ('75', '菲诗小铺', 'brand/2015-08-20/55d5412cdb2d7.jpg', '菲诗小铺', 'http://www.ctrip.com/?mctrip=F', '2', '6', '17');
INSERT INTO `lx_brand` VALUES ('76', '兰亭', 'brand/2015-08-20/55d5411b805bd.jpg', '兰亭', 'http://www.ctrip.com', '3', '6', '17');
INSERT INTO `lx_brand` VALUES ('77', '海尔', 'brand/2015-08-20/55d540dce0689.jpg', '海尔', 'http://m.ehaier.com', '1', '7', '17');
INSERT INTO `lx_brand` VALUES ('78', '康佳', 'brand/2015-08-20/55d540d04eb98.jpg', '康佳电视', 'http://m.ehaier.com', '2', '7', '17');
INSERT INTO `lx_brand` VALUES ('79', '西门子', 'brand/2015-08-20/55d540bd15924.jpg', '西门子家电', 'http://m.ehaier.com', '2', '7', '17');
INSERT INTO `lx_brand` VALUES ('80', '索尼', 'brand/2015-08-20/55d540af5b343.jpg', '相机', 'http://m.ehaier.com', '1', '8', '17');
INSERT INTO `lx_brand` VALUES ('81', '联想', 'brand/2015-08-20/55d540a1c43d3.jpg', '', 'http://m.ehaier.com', '2', '7', '17');
INSERT INTO `lx_brand` VALUES ('82', '三星', 'brand/2015-08-20/55d54096f0470.jpg', '三星', 'http://m.ehaier.com', '2', '8', '17');
INSERT INTO `lx_brand` VALUES ('83', '宇通客车', 'brand/2015-08-20/55d5408944361.jpg', '宇通', 'http://m.ehaier.com', '1', '9', '17');
INSERT INTO `lx_brand` VALUES ('84', '玛莎拉蒂', 'brand/2015-08-20/55d5407b9d605.jpg', '玛莎拉蒂总裁', 'http://m.ehaier.com', '2', '9', '17');
INSERT INTO `lx_brand` VALUES ('85', '保时捷', 'brand/2015-08-20/55d5403e2bb99.jpg', '保时捷', 'http://m.ehaier.com', '3', '9', '17');
INSERT INTO `lx_brand` VALUES ('86', '小米', 'brand/2015-08-20/55d57275ee516.jpg', '小米手机', 'http://www.mi.com/index.html', '23', '8', '19');
INSERT INTO `lx_brand` VALUES ('87', '华为', 'brand/2015-08-20/55d572a0e6d2a.jpg', '华为手机', 'http://huawei.com', '6', '8', '19');
INSERT INTO `lx_brand` VALUES ('88', '魅族', 'brand/2015-08-20/55d572df93186.jpg', '魅族手机', 'http://www.meizu.com/?refcode=baidu_pinzuan&amp;utm_source=baidupz&amp;utm_medium=cpc&amp;utm_term=meizu_baidupz_aee4956b7a44c8ac_20150817', '7', '8', '19');
INSERT INTO `lx_brand` VALUES ('89', ' 卫群', 'brand/2015-08-26/55dd170d0669e.jpg', '精纯食用盐400g/袋', 'http://wsq.cccuu.com/', '品质纯正好滋味，优质井矿盐', '2', '48');
INSERT INTO `lx_brand` VALUES ('90', '阿依莲', 'brand/2015-08-28/55dfce9d65478.jpg', '或多或少', 'http://www.meizu.com', '1232', '3', '52');
INSERT INTO `lx_brand` VALUES ('91', '诚信果业', 'brand/2015-08-28/55dffa773c10c.jpg', 'ghhh', 'http://www.uni-president.com.cn/', '13', '2', '54');
INSERT INTO `lx_brand` VALUES ('92', '亚宝', 'brand/2015-08-28/55e00b6dc7856.jpg', 'sds', 'http://m.ctrip.com/html5', '999', '1', '54');
INSERT INTO `lx_brand` VALUES ('93', 'yyy', 'brand/2015-08-28/55e00b88e24f0.jpg', 'sssss', 'http://www.uni-president.com.cn', '99', '3', '54');
INSERT INTO `lx_brand` VALUES ('104', '奔驰', 'brand/2015-09-01/55e5539bd522c.jpg', '奔驰', 'http://wsq.cccuu.com/', '100', '9', '58');
INSERT INTO `lx_brand` VALUES ('105', '宝马', 'brand/2015-09-01/55e55413a3eb4.jpg', '宝马', 'http://wsq.cccuu.com/', '100', '9', '58');
INSERT INTO `lx_brand` VALUES ('96', '雅宝', 'brand/2015-08-29/55e154a01fd06.jpg', '雅宝家具是一家专业从事中、高档家具设计、生产、销售的全国连锁企业，公司创建于1996年，2001年在香港登记注册为“雅宝国际家具（香港）有限公司”。公司下设家具总厂、沙发厂、餐厅家具厂、床垫厂、板材加工厂、玻璃厂和包装材料厂七大分厂，共有员工1500余人。公司新工厂位于河南省重点产业积聚区——管城区金岱工业园区内，占地面积110余亩，总建筑面积62000平方米。经公司授权的专卖店已达1000余家，分布在全国20多个省份300余座大、中型城市和地区，拥有强大的品牌优势及良好的质量口碑。', 'http://wsq.cccuu.com/', '1000', '1', '58');
INSERT INTO `lx_brand` VALUES ('97', '海之生活馆', 'brand/2015-08-30/55e25a5954c9a.jpg', '海之澜生活馆', 'http://wsq.cccuu.com/index.php/Home/Shop/shop/shop_id/65.html', '1000', '2', '58');
INSERT INTO `lx_brand` VALUES ('103', '爱美肌', 'brand/2015-09-01/55e5245525fc7.jpg', '爱美肌  爱上你的肌肤', 'http://wsq.cccuu.com/index.php/Home/Index/index.html', '99999999', '6', '58');
INSERT INTO `lx_brand` VALUES ('99', '海之澜床垫', 'brand/2015-09-01/55e50ab71cefc.jpg', '海之澜床垫', 'http://wsq.cccuu.com/index.php/Home/Shop/shop/shop_id/65.html', '100', '1', '58');
INSERT INTO `lx_brand` VALUES ('100', '海之澜手机专卖', 'brand/2015-09-01/55e50b999015d.jpg', '海之澜手机专卖', 'http://wsq.cccuu.com/index.php/Home/Shop/shop/shop_id/69.html', '100', '8', '58');
INSERT INTO `lx_brand` VALUES ('101', ' 海之澜家电专卖', 'brand/2015-09-01/55e51b4c8d62c.jpg', ' 海之澜家电专卖', 'http://wsq.cccuu.com/index.php/Home/Shop/shop/shop_id/59.html', '100', '7', '58');
INSERT INTO `lx_brand` VALUES ('102', '瑞倪维尔', 'brand/2015-09-01/55e51fb8aba06.jpg', '瑞倪维尔', 'http://wsq.cccuu.com/index.php/Home/Index/index.html', '100', '6', '58');
INSERT INTO `lx_brand` VALUES ('106', '大众', 'brand/2015-09-01/55e55864af007.jpg', '大众', 'http://wsq.cccuu.com/', '100', '9', '58');
INSERT INTO `lx_brand` VALUES ('107', '奥迪', 'brand/2015-09-01/55e55888f3c79.jpg', '奥迪', 'http://wsq.cccuu.com/', '100', '9', '58');
INSERT INTO `lx_brand` VALUES ('108', '海之澜旅行社', 'brand/2015-09-01/55e559ba3da0c.jpg', '海之澜旅行社', 'http://wsq.cccuu.com/', '100', '4', '58');
INSERT INTO `lx_brand` VALUES ('109', '海之澜娱乐', 'brand/2015-09-01/55e55f985935d.jpg', '海之澜娱乐', 'http://wsq.cccuu.com/', '100', '5', '58');
INSERT INTO `lx_brand` VALUES ('110', '伊利', 'brand/2015-09-01/55e564ae4a349.jpg', '伊利', 'http://wsq.cccuu.com/', '100', '2', '58');
INSERT INTO `lx_brand` VALUES ('111', '蓝月亮', 'brand/2015-09-01/55e56514bcf76.jpg', '蓝月亮', 'http://wsq.cccuu.com/', '100', '6', '58');
INSERT INTO `lx_brand` VALUES ('112', '京润珍珠', 'brand/2015-09-01/55e5658f6d3dc.jpg', '京润珍珠', 'http://wsq.cccuu.com/', '1000', '6', '58');
INSERT INTO `lx_brand` VALUES ('113', '梦舒雅', 'brand/2015-09-01/55e565aeb9a20.jpg', '梦舒雅', 'http://wsq.cccuu.com/', '100', '3', '58');
INSERT INTO `lx_brand` VALUES ('114', '香奈儿', 'brand/2015-09-01/55e56608ccfce.jpg', '香奈儿', 'http://wsq.cccuu.com/', '100', '3', '58');
INSERT INTO `lx_brand` VALUES ('116', '佳乐佳', 'brand/2015-09-04/55e95d4ba2b1b.jpg', '', 'http://wsq.cccuu.com/', '100', '1', '58');
INSERT INTO `lx_brand` VALUES ('117', '测试内容', 'brand/2015-09-07/55ed455bcba36.jpg', '只是测试的内容', 'http://www.baidu.com', '9', '1', '85');
INSERT INTO `lx_brand` VALUES ('118', 'asxsadssd', '', 'asasxasx', 'http://www.baidu.com', '12', '1', '85');
INSERT INTO `lx_brand` VALUES ('119', 'sdfgsdfgdsfgdfg', '', 'sdfasdf', 'http://www.baidu.com', '1', '2', '85');

-- ----------------------------
-- Table structure for `lx_car`
-- ----------------------------
DROP TABLE IF EXISTS `lx_car`;
CREATE TABLE `lx_car` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sp_id` int(10) unsigned DEFAULT NULL COMMENT '商品id',
  `g_price` decimal(10,2) unsigned DEFAULT NULL,
  `num` smallint(3) unsigned DEFAULT NULL,
  `up_id` int(10) unsigned DEFAULT NULL COMMENT '用户id',
  `ghs_id` int(10) unsigned DEFAULT NULL COMMENT '供货商id',
  `c_time` int(11) unsigned DEFAULT NULL,
  `goods_attr_id` int(11) unsigned NOT NULL COMMENT '商品属性id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_car
-- ----------------------------

-- ----------------------------
-- Table structure for `lx_category`
-- ----------------------------
DROP TABLE IF EXISTS `lx_category`;
CREATE TABLE `lx_category` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) DEFAULT NULL COMMENT '分类关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '分类描述',
  `parent_id` int(255) unsigned DEFAULT NULL COMMENT '上级id',
  `sort` varchar(255) DEFAULT NULL COMMENT '排序字段',
  `path` varchar(255) DEFAULT NULL,
  `pid` int(11) unsigned NOT NULL,
  `admin_id` int(11) unsigned NOT NULL,
  `ctype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0:管理员；1：供货商',
  `group_id` tinyint(2) unsigned NOT NULL,
  `rules` char(80) DEFAULT NULL COMMENT '规则的全部解释',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_category
-- ----------------------------
INSERT INTO `lx_category` VALUES ('1', '无烟1号煤', null, null, null, '1', null, '0', '85', '0', '0', '1');
INSERT INTO `lx_category` VALUES ('4', '无烟2号煤', null, null, null, '2', null, '0', '85', '0', '0', '6|1|');

-- ----------------------------
-- Table structure for `lx_collect_goods`
-- ----------------------------
DROP TABLE IF EXISTS `lx_collect_goods`;
CREATE TABLE `lx_collect_goods` (
  `col_goodsid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`col_goodsid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of lx_collect_goods
-- ----------------------------
INSERT INTO `lx_collect_goods` VALUES ('10', '33', '180', '2015-08-25 10:35:27');

-- ----------------------------
-- Table structure for `lx_collect_shop`
-- ----------------------------
DROP TABLE IF EXISTS `lx_collect_shop`;
CREATE TABLE `lx_collect_shop` (
  `col_shopid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`col_shopid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of lx_collect_shop
-- ----------------------------
INSERT INTO `lx_collect_shop` VALUES ('6', '42', '22', '2015-08-24 21:38:38');
INSERT INTO `lx_collect_shop` VALUES ('10', '33', '23', '2015-08-25 15:55:13');
INSERT INTO `lx_collect_shop` VALUES ('8', '33', '30', '2015-08-25 11:21:34');
INSERT INTO `lx_collect_shop` VALUES ('11', '41', '23', '2015-08-26 09:12:45');
INSERT INTO `lx_collect_shop` VALUES ('12', '34', '29', '2015-08-26 09:57:19');
INSERT INTO `lx_collect_shop` VALUES ('13', '34', '22', '2015-08-26 10:22:23');
INSERT INTO `lx_collect_shop` VALUES ('14', '34', '30', '2015-08-26 10:22:33');

-- ----------------------------
-- Table structure for `lx_friend_link`
-- ----------------------------
DROP TABLE IF EXISTS `lx_friend_link`;
CREATE TABLE `lx_friend_link` (
  `link_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '友情链接id',
  `link_name` varchar(255) NOT NULL,
  `link_pic` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL,
  `sort` varchar(255) NOT NULL,
  `pubtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_friend_link
-- ----------------------------
INSERT INTO `lx_friend_link` VALUES ('34', '百度', '', 'http://www.baidu.com', '1', '2015-09-10 09:47:16');

-- ----------------------------
-- Table structure for `lx_gn_group`
-- ----------------------------
DROP TABLE IF EXISTS `lx_gn_group`;
CREATE TABLE `lx_gn_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `ghs_id` int(11) unsigned NOT NULL COMMENT '供货商id',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '排序',
  `group_id` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '对应分组id',
  `admin_id` int(11) unsigned NOT NULL COMMENT '操作人id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_gn_group
-- ----------------------------

-- ----------------------------
-- Table structure for `lx_goods`
-- ----------------------------
DROP TABLE IF EXISTS `lx_goods`;
CREATE TABLE `lx_goods` (
  `goods_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_sn` varchar(255) NOT NULL DEFAULT '' COMMENT '商品编号',
  `cat_id` int(11) unsigned NOT NULL DEFAULT '0',
  `type_id` int(11) unsigned NOT NULL DEFAULT '0',
  `brand_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '供货商id',
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `goods_brief` varchar(255) DEFAULT NULL COMMENT '商品详情',
  `goods_thumb` varchar(255) NOT NULL DEFAULT '',
  `goods_gallery_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '图集id',
  `is_real` tinyint(3) unsigned DEFAULT '0' COMMENT '0：不是1：是虚拟商品',
  `is_on_sale` tinyint(3) unsigned DEFAULT '0' COMMENT '1:出售中0：不出售',
  `is_alone_sale` tinyint(3) unsigned DEFAULT '0' COMMENT '今日新增商品展示  0:否；1：是',
  `is_best` tinyint(3) unsigned DEFAULT '0' COMMENT '楼层商品展示0:否1:是',
  `is_new` smallint(5) unsigned DEFAULT '0' COMMENT '0:最新1：不是最新',
  `is_hot` tinyint(3) unsigned DEFAULT '0' COMMENT '0:热卖1：不热卖',
  `pubtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sort` mediumint(8) unsigned DEFAULT '0' COMMENT '可以让供货商决定排序',
  `goods_desc` text NOT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL COMMENT '操作人id',
  `warn_number` tinyint(3) unsigned NOT NULL,
  `fz_id` int(10) unsigned DEFAULT NULL COMMENT '分站id',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of lx_goods
-- ----------------------------
INSERT INTO `lx_goods` VALUES ('7', '123123', '4', '0', '0', '85', '概念产品2', null, '/public/plugs/pe/001/15-09-23/1442977725902.jpg', '0', '0', '0', '0', '0', '0', '0', '2015-09-23 12:21:44', '5', '&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20150923/1442977672901860.jpg&quot; title=&quot;1442977672901860.jpg&quot; alt=&quot;11.jpg&quot;/&gt;&lt;/p&gt;', '85', '0', '85');
INSERT INTO `lx_goods` VALUES ('8', '1231231', '4', '0', '0', '85', '概念产品3', null, '/public/plugs/pe/001/15-09-23/1442982317366.jpg', '0', '0', '0', '1', '0', '0', '0', '2015-09-24 09:07:44', '1', '&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20150923/1442982278734896.jpg&quot; title=&quot;1442982278734896.jpg&quot; alt=&quot;11.jpg&quot;/&gt;&lt;/p&gt;', '85', '0', '85');
INSERT INTO `lx_goods` VALUES ('9', '13123', '4', '0', '0', '85', '概念产品4', null, '/public/plugs/pe/001/15-09-23/1442982428117.jpg', '0', '0', '0', '0', '0', '0', '0', '2015-09-28 09:10:39', '121', '<p><img src=\"/ueditor/php/upload/image/20150923/1442982395486259.jpg\" title=\"1442982395486259.jpg\" alt=\"11.jpg\"/></p>', '85', '0', '85');
INSERT INTO `lx_goods` VALUES ('10', '123123', '4', '0', '0', '85', '产品概念5', null, '/public/plugs/pe/001/15-09-23/1442982540280.jpg', '0', '0', '0', '0', '0', '0', '0', '2015-09-23 12:29:11', '12', '&lt;p&gt;&lt;img src=&quot;/ueditor/php/upload/image/20150923/1442982510104653.jpg&quot; title=&quot;1442982510104653.jpg&quot; alt=&quot;11.jpg&quot;/&gt;&lt;/p&gt;', '85', '0', '85');
INSERT INTO `lx_goods` VALUES ('11', '156465456', '4', '0', '0', '85', '改版后', null, '/public/plugs/pe/001/15-09-30/1443599958234.jpg', '0', '0', '0', '0', '0', '0', '0', '2015-09-30 15:59:33', '12', '&lt;p&gt;阿道夫&lt;/p&gt;', '85', '0', '85');
INSERT INTO `lx_goods` VALUES ('15', '123123', '1', '0', '0', '85', '123123123', null, '/public/plugs/pe/001/15-09-30/1443604451765.jpg', '0', '0', '0', '0', '0', '0', '0', '2015-10-08 11:30:50', '123', '<p>1<br/></p>', '85', '0', '85');
INSERT INTO `lx_goods` VALUES ('16', '1234654', '4', '0', '0', '85', '放假来测试', null, '/public/plugs/pe/001/15-10-08/1444275704214.jpg', '0', '0', '0', '0', '0', '0', '0', '2015-10-08 14:30:57', '12', '<p>只是测试一下内容的属性。</p>', '85', '0', '85');

-- ----------------------------
-- Table structure for `lx_goods_attr`
-- ----------------------------
DROP TABLE IF EXISTS `lx_goods_attr`;
CREATE TABLE `lx_goods_attr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned NOT NULL DEFAULT '0',
  `attr_id` varchar(255) NOT NULL DEFAULT '0' COMMENT '所有属性的id',
  `attr_value` varchar(255) DEFAULT NULL COMMENT '所有属性的值',
  `type_id` int(11) unsigned NOT NULL,
  `goods_count` int(255) unsigned NOT NULL COMMENT '库存',
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '售价',
  `shop_price` char(255) NOT NULL DEFAULT '0.00' COMMENT '进价',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='商品属性表';

-- ----------------------------
-- Records of lx_goods_attr
-- ----------------------------
INSERT INTO `lx_goods_attr` VALUES ('14', '7', '0', '5|7', '0', '500', '0.00', '5-10=50|10-15=47|15-20=45');
INSERT INTO `lx_goods_attr` VALUES ('15', '7', '0', '4|9', '0', '12', '0.00', '5-10=50|10-15=47|15-20=45');
INSERT INTO `lx_goods_attr` VALUES ('16', '8', '0', '4|8', '0', '234', '0.00', '5-10=50|10-15=47|15-20=45');
INSERT INTO `lx_goods_attr` VALUES ('17', '8', '0', '5|8', '0', '123', '0.00', '5-10=50|10-15=47|15-20=45');
INSERT INTO `lx_goods_attr` VALUES ('18', '9', '0', '5|7', '0', '12', '0.00', '5-10=50|10-15=47|15-20=45');
INSERT INTO `lx_goods_attr` VALUES ('20', '10', '0', '4|9', '0', '23', '0.00', '5-10=50|10-15=47|15-20=45');
INSERT INTO `lx_goods_attr` VALUES ('21', '10', '0', '4|7', '0', '123', '0.00', '5-10=50|10-15=47|15-20=45');
INSERT INTO `lx_goods_attr` VALUES ('22', '11', '0', '4|8', '0', '213', '0.00', '5-10=50|10-15=47|15-20=45');
INSERT INTO `lx_goods_attr` VALUES ('26', '16', '0', '5|8', '0', '19', '0.00', '5-10=50|10-15=47');
INSERT INTO `lx_goods_attr` VALUES ('27', '16', '0', '4|7', '0', '15', '0.00', '5-10=50|10-15=47|15-20=45');
INSERT INTO `lx_goods_attr` VALUES ('51', '16', '0', '5|9', '0', '14', '0.00', '5-10=50|10-15=47|15-20=45');

-- ----------------------------
-- Table structure for `lx_goods_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `lx_goods_attribute`;
CREATE TABLE `lx_goods_attribute` (
  `attr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) unsigned NOT NULL,
  `attr_name` varchar(255) NOT NULL DEFAULT '',
  `attr_input_type` tinyint(2) NOT NULL DEFAULT '0',
  `attr_values` char(200) DEFAULT NULL,
  `sort_order` varchar(200) DEFAULT NULL,
  `provider_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_goods_attribute
-- ----------------------------
INSERT INTO `lx_goods_attribute` VALUES ('88', '27', '机身颜色', '0', '', '2', '15');
INSERT INTO `lx_goods_attribute` VALUES ('93', '28', '安装方式', '0', '', '', '15');
INSERT INTO `lx_goods_attribute` VALUES ('46', '14', '产地', '0', '', '', '17');
INSERT INTO `lx_goods_attribute` VALUES ('47', '14', '产品规格/容量', '0', '', '1', '17');
INSERT INTO `lx_goods_attribute` VALUES ('49', '14', '所属类别', '1', '彩妆\r\n化妆工具\r\n护肤品\r\n香水\r\n', '3', '17');
INSERT INTO `lx_goods_attribute` VALUES ('50', '14', '适合肤质', '0', '', '4', '17');
INSERT INTO `lx_goods_attribute` VALUES ('87', '27', '网络类型', '0', '', '1', '15');
INSERT INTO `lx_goods_attribute` VALUES ('86', '26', 'gaungg', '1', '	\r\ntt\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '1', '15');
INSERT INTO `lx_goods_attribute` VALUES ('54', '15', '像素', '0', '', '', '17');
INSERT INTO `lx_goods_attribute` VALUES ('55', '15', '显示屏类型', '0', '', '', '17');
INSERT INTO `lx_goods_attribute` VALUES ('57', '16', '尺码', '1', 'S\r\nM\r\nL\r\nXL', '2', '17');
INSERT INTO `lx_goods_attribute` VALUES ('58', '17', '颜色分类', '0', '', '', '17');
INSERT INTO `lx_goods_attribute` VALUES ('61', '17', '尺寸', '0', '', '', '17');
INSERT INTO `lx_goods_attribute` VALUES ('62', '18', '颜色分类', '1', '	白色\r\n黑色\r\n', '211', '17');
INSERT INTO `lx_goods_attribute` VALUES ('63', '19', '品牌', '0', '', '', '17');
INSERT INTO `lx_goods_attribute` VALUES ('64', '19', '尺码', '1', '34\r\n35\r\n36\r\n37\r\n38\r\n', '1', '17');
INSERT INTO `lx_goods_attribute` VALUES ('65', '21', '颜色分类', '1', '	白色\r\n红色\r\n黄色\r\n蓝色\r\n', '113', '17');
INSERT INTO `lx_goods_attribute` VALUES ('66', '19', '颜色分类', '1', '红色\r\n白色\r\n米白色\r\n蓝色\r\n', '', '17');
INSERT INTO `lx_goods_attribute` VALUES ('67', '21', '尺码', '1', '	35\r\n36\r\n37\r\n38\r\n39\r\n', '223', '17');
INSERT INTO `lx_goods_attribute` VALUES ('70', '19', '鞋头款式', '1', '方头\r\n尖头\r\n圆头\r\n', '12', '15');
INSERT INTO `lx_goods_attribute` VALUES ('69', '16', '材质', '1', '棉\r\n蚕丝\r\n', '', '15');
INSERT INTO `lx_goods_attribute` VALUES ('71', '19', '后跟高', '1', '中跟\r\n高跟\r\n超高跟\r\n', '', '15');
INSERT INTO `lx_goods_attribute` VALUES ('73', '22', '品牌', '1', '森马\r\n与狼共舞\r\n', '1', '15');
INSERT INTO `lx_goods_attribute` VALUES ('74', '22', '尺码', '1', 'XL\r\n30\r\n31\r\n35	\r\n', '3', '15');
INSERT INTO `lx_goods_attribute` VALUES ('75', '22', '裤长', '1', '长裤\r\n九分裤\r\n短裤\r\n', '', '15');
INSERT INTO `lx_goods_attribute` VALUES ('76', '22', '主要材质', '1', '棉\r\n涤纶\r\n麻	\r\n', '1', '15');
INSERT INTO `lx_goods_attribute` VALUES ('78', '23', '品牌', '0', '', '1', '15');
INSERT INTO `lx_goods_attribute` VALUES ('79', '23', '屏幕尺寸', '0', '', '2', '15');
INSERT INTO `lx_goods_attribute` VALUES ('80', '23', '类型', '0', '', '3', '15');
INSERT INTO `lx_goods_attribute` VALUES ('81', '23', '操作系统', '0', '', '4', '15');
INSERT INTO `lx_goods_attribute` VALUES ('82', '23', '功率', '0', '', '', '15');
INSERT INTO `lx_goods_attribute` VALUES ('83', '24', '品牌', '1', '蜘蛛王\r\n公牛世家', '1', '15');
INSERT INTO `lx_goods_attribute` VALUES ('84', '24', '鞋面材质', '1', '棉布\r\n牛仔布\r\n太空革\r\n', '2', '15');
INSERT INTO `lx_goods_attribute` VALUES ('85', '24', '尺码', '1', '39\r\n38\r\n40\r\n41\r\n', '3', '15');
INSERT INTO `lx_goods_attribute` VALUES ('92', '28', '颜色', '0', '', '', '15');
INSERT INTO `lx_goods_attribute` VALUES ('89', '27', '机身内存', '0', '', '3', '15');
INSERT INTO `lx_goods_attribute` VALUES ('90', '27', '型号', '0', '', '', '15');

-- ----------------------------
-- Table structure for `lx_goods_attr_over`
-- ----------------------------
DROP TABLE IF EXISTS `lx_goods_attr_over`;
CREATE TABLE `lx_goods_attr_over` (
  `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) DEFAULT NULL COMMENT '分类关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '分类描述',
  `parent_id` int(255) unsigned DEFAULT NULL COMMENT '上级id',
  `sort` varchar(255) DEFAULT NULL COMMENT '排序字段',
  `path` varchar(255) DEFAULT NULL,
  `pid` int(11) unsigned NOT NULL,
  `admin_id` int(11) unsigned NOT NULL,
  `ctype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0:管理员；1：供货商',
  `group_id` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_goods_attr_over
-- ----------------------------
INSERT INTO `lx_goods_attr_over` VALUES ('1', '规格', null, null, null, null, null, '0', '85', '0', '0');
INSERT INTO `lx_goods_attr_over` VALUES ('5', '2*4', null, null, '1', null, '1-', '1', '85', '0', '0');
INSERT INTO `lx_goods_attr_over` VALUES ('4', '3*6', null, null, '1', null, '1-', '1', '85', '0', '0');
INSERT INTO `lx_goods_attr_over` VALUES ('6', '质地', null, null, null, null, null, '0', '85', '0', '0');
INSERT INTO `lx_goods_attr_over` VALUES ('7', '硬质的', null, null, '6', null, '6-', '6', '85', '0', '0');
INSERT INTO `lx_goods_attr_over` VALUES ('8', '软质的', null, null, '6', null, '6-', '6', '85', '0', '0');
INSERT INTO `lx_goods_attr_over` VALUES ('9', '中性', null, null, '6', null, '6-', '6', '85', '0', '0');

-- ----------------------------
-- Table structure for `lx_goods_comment`
-- ----------------------------
DROP TABLE IF EXISTS `lx_goods_comment`;
CREATE TABLE `lx_goods_comment` (
  `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '评论者的id',
  `user_name` varchar(255) DEFAULT '匿名用户' COMMENT '用户名',
  `content` text NOT NULL COMMENT '评论内容',
  `comment_rank` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1:一星2:3:三星4:四星5:五星',
  `com_ip` varchar(255) DEFAULT NULL COMMENT '评论者的ip',
  `com_time` timestamp NULL DEFAULT NULL COMMENT '评论时间',
  `parent_id` int(10) unsigned DEFAULT NULL COMMENT '父级id',
  `show_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_goods_comment
-- ----------------------------
INSERT INTO `lx_goods_comment` VALUES ('4', '140', '33', null, '宝贝不错，发货速度挺快的，支持', '4', null, null, '0', null);
INSERT INTO `lx_goods_comment` VALUES ('5', '140', '33', null, '挺好的', '4', null, null, '4', null);
INSERT INTO `lx_goods_comment` VALUES ('6', '140', '33', '淘宝01', '宝贝不错', '4', null, null, '5', null);
INSERT INTO `lx_goods_comment` VALUES ('7', '162', '33', '淘宝01', '挺好喝的', '4', null, null, '0', null);
INSERT INTO `lx_goods_comment` VALUES ('8', '184', '33', '淘宝01', 'gbhnmc', '4', null, null, '0', null);

-- ----------------------------
-- Table structure for `lx_goods_gallery`
-- ----------------------------
DROP TABLE IF EXISTS `lx_goods_gallery`;
CREATE TABLE `lx_goods_gallery` (
  `gallery_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL DEFAULT '',
  `img_title` varchar(255) DEFAULT NULL COMMENT '图片标题',
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='商品图集表';

-- ----------------------------
-- Records of lx_goods_gallery
-- ----------------------------
INSERT INTO `lx_goods_gallery` VALUES ('19', '7', '/public/plugs/pe/001/15-09-23/1442977725902.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('20', '8', '/public/plugs/pe/001/15-09-23/1442982317366.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('21', '9', '/public/plugs/pe/001/15-09-23/1442982428117.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('22', '9', '/public/plugs/pe/001/15-09-23/1442982428166.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('23', '10', '/public/plugs/pe/001/15-09-23/1442982540280.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('24', '9', 'images/2015-09-25/1443152159_11079679585604c11fbcccb.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('25', '11', '/public/plugs/pe/001/15-09-30/1443599958234.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('26', '12', '/public/plugs/pe/001/15-09-30/1443604122124.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('27', '15', '/public/plugs/pe/001/15-09-30/1443604451765.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('28', '16', '/public/plugs/pe/001/15-10-08/1444275704214.jpg', null);
INSERT INTO `lx_goods_gallery` VALUES ('29', '17', '', null);

-- ----------------------------
-- Table structure for `lx_goods_group`
-- ----------------------------
DROP TABLE IF EXISTS `lx_goods_group`;
CREATE TABLE `lx_goods_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '导航分组ID',
  `navtype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_goods_group
-- ----------------------------
INSERT INTO `lx_goods_group` VALUES ('1', '家居');
INSERT INTO `lx_goods_group` VALUES ('2', '食品');
INSERT INTO `lx_goods_group` VALUES ('3', '服装');
INSERT INTO `lx_goods_group` VALUES ('4', '旅游');
INSERT INTO `lx_goods_group` VALUES ('5', '娱乐');
INSERT INTO `lx_goods_group` VALUES ('6', '美妆');
INSERT INTO `lx_goods_group` VALUES ('7', '家电');
INSERT INTO `lx_goods_group` VALUES ('8', '数码');
INSERT INTO `lx_goods_group` VALUES ('9', '交通工具');

-- ----------------------------
-- Table structure for `lx_goods_type`
-- ----------------------------
DROP TABLE IF EXISTS `lx_goods_type`;
CREATE TABLE `lx_goods_type` (
  `type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL DEFAULT '' COMMENT '类型名称',
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='商品类型表';

-- ----------------------------
-- Records of lx_goods_type
-- ----------------------------
INSERT INTO `lx_goods_type` VALUES ('14', '化妆品');
INSERT INTO `lx_goods_type` VALUES ('13', '手机');
INSERT INTO `lx_goods_type` VALUES ('15', '数码产品');
INSERT INTO `lx_goods_type` VALUES ('16', '女装');
INSERT INTO `lx_goods_type` VALUES ('17', '家居');
INSERT INTO `lx_goods_type` VALUES ('18', '笔记本');
INSERT INTO `lx_goods_type` VALUES ('19', '鞋');
INSERT INTO `lx_goods_type` VALUES ('21', '女鞋');
INSERT INTO `lx_goods_type` VALUES ('22', '男装');
INSERT INTO `lx_goods_type` VALUES ('23', '家电');
INSERT INTO `lx_goods_type` VALUES ('24', '男鞋');
INSERT INTO `lx_goods_type` VALUES ('25', '食品');
INSERT INTO `lx_goods_type` VALUES ('26', '包包');
INSERT INTO `lx_goods_type` VALUES ('27', '手机');
INSERT INTO `lx_goods_type` VALUES ('28', '梳妆台');

-- ----------------------------
-- Table structure for `lx_link_goods`
-- ----------------------------
DROP TABLE IF EXISTS `lx_link_goods`;
CREATE TABLE `lx_link_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL,
  `link_goods_id` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_link_goods
-- ----------------------------
INSERT INTO `lx_link_goods` VALUES ('12', '7', '0', '85');
INSERT INTO `lx_link_goods` VALUES ('13', '8', '0', '85');
INSERT INTO `lx_link_goods` VALUES ('14', '9', '0', '85');
INSERT INTO `lx_link_goods` VALUES ('15', '10', '0', '85');
INSERT INTO `lx_link_goods` VALUES ('16', '11', '7', '85');
INSERT INTO `lx_link_goods` VALUES ('17', '11', '8', '85');
INSERT INTO `lx_link_goods` VALUES ('18', '11', '9', '85');
INSERT INTO `lx_link_goods` VALUES ('19', '11', '10', '85');
INSERT INTO `lx_link_goods` VALUES ('20', '12', '8', '85');
INSERT INTO `lx_link_goods` VALUES ('21', '12', '9', '85');
INSERT INTO `lx_link_goods` VALUES ('22', '12', '11', '85');
INSERT INTO `lx_link_goods` VALUES ('23', '15', '0', '85');
INSERT INTO `lx_link_goods` VALUES ('24', '16', '8', '85');
INSERT INTO `lx_link_goods` VALUES ('25', '16', '9', '85');
INSERT INTO `lx_link_goods` VALUES ('26', '16', '10', '85');
INSERT INTO `lx_link_goods` VALUES ('27', '16', '11', '85');
INSERT INTO `lx_link_goods` VALUES ('28', '17', '0', '85');

-- ----------------------------
-- Table structure for `lx_navigation`
-- ----------------------------
DROP TABLE IF EXISTS `lx_navigation`;
CREATE TABLE `lx_navigation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '导航id',
  `nav_name` varchar(255) NOT NULL COMMENT '导航名称',
  `nav_url` varchar(255) NOT NULL,
  `sort` varchar(255) NOT NULL COMMENT '导航排序',
  `type` varchar(255) NOT NULL COMMENT '导航类别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_navigation
-- ----------------------------

-- ----------------------------
-- Table structure for `lx_orderlist`
-- ----------------------------
DROP TABLE IF EXISTS `lx_orderlist`;
CREATE TABLE `lx_orderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordid` varchar(255) DEFAULT NULL,
  `ordfee` float(10,2) DEFAULT '0.00',
  `ordstatus` int(11) DEFAULT '0',
  `payment_trade_no` varchar(255) DEFAULT NULL,
  `payment_trade_status` varchar(255) DEFAULT NULL,
  `payment_notify_id` varchar(255) DEFAULT NULL,
  `payment_notify_time` varchar(255) DEFAULT NULL,
  `payment_buyer_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_orderlist
-- ----------------------------

-- ----------------------------
-- Table structure for `lx_order_goods`
-- ----------------------------
DROP TABLE IF EXISTS `lx_order_goods`;
CREATE TABLE `lx_order_goods` (
  `rec_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `order_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '订单id',
  `goods_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_name` varchar(255) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_sn` varchar(60) NOT NULL DEFAULT '' COMMENT '商品编号',
  `goods_number` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '商品数量',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '售价',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '进价',
  `goods_attr` text NOT NULL COMMENT '商品属性',
  `is_real` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为虚拟商品',
  `goods_attr_id` int(8) unsigned NOT NULL COMMENT '''商品属性id''',
  PRIMARY KEY (`rec_id`),
  KEY `order_id` (`order_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_order_goods
-- ----------------------------
INSERT INTO `lx_order_goods` VALUES ('47', '46', '144', '小米 note', '08200103', '1', '2999.00', '0.00', '', '0', '241');
INSERT INTO `lx_order_goods` VALUES ('48', '46', '144', '小米 note', '08200103', '1', '2999.00', '0.00', '', '0', '239');
INSERT INTO `lx_order_goods` VALUES ('49', '47', '153', '秋季新款男式骷髅印花短袖T恤 纯棉街头潮流', 'CA200156974 ', '2', '99.00', '0.00', '', '0', '263');
INSERT INTO `lx_order_goods` VALUES ('50', '48', '184', '卡姿兰大眼睛睫毛膏', '9745252122', '1', '986.00', '0.00', '', '0', '316');
INSERT INTO `lx_order_goods` VALUES ('51', '49', '170', '统一 微食刻衡百分百果蔬汁', '96586522', '1', '44.00', '0.00', '', '0', '300');
INSERT INTO `lx_order_goods` VALUES ('52', '50', '140', '热卖女式落肩翻边袖百搭短款T恤', 'CAECD114010888', '1', '34.00', '0.00', '', '0', '225');
INSERT INTO `lx_order_goods` VALUES ('53', '51', '169', '小当家干吃面美味持久好吃不贵', '89556225665', '1', '6.00', '0.00', '', '0', '301');
INSERT INTO `lx_order_goods` VALUES ('54', '51', '162', '小茗同学', '58963252', '4', '5.00', '0.00', '', '0', '287');
INSERT INTO `lx_order_goods` VALUES ('55', '52', '171', '海之言250mL夏日特惠', '9852345566', '1', '63.00', '0.00', '', '0', '299');
INSERT INTO `lx_order_goods` VALUES ('56', '52', '162', '小茗同学', '58963252', '1', '5.00', '0.00', '', '0', '287');
INSERT INTO `lx_order_goods` VALUES ('57', '53', '140', '热卖女式落肩翻边袖百搭短款T恤', 'CAECD114010888', '1', '34.00', '0.00', '', '0', '225');
INSERT INTO `lx_order_goods` VALUES ('58', '54', '171', '海之言250mL夏日特惠', '9852345566', '1', '63.00', '0.00', '', '0', '299');
INSERT INTO `lx_order_goods` VALUES ('59', '54', '162', '小茗同学', '58963252', '1', '5.00', '0.00', '', '0', '287');
INSERT INTO `lx_order_goods` VALUES ('60', '55', '142', '红米 Note', '08200102', '1', '799.00', '0.00', '', '0', '230');
INSERT INTO `lx_order_goods` VALUES ('61', '56', '140', '热卖女式落肩翻边袖百搭短款T恤', 'CAECD114010888', '1', '36.00', '0.00', '', '0', '226');
INSERT INTO `lx_order_goods` VALUES ('62', '57', '162', '小茗同学', '58963252', '2', '5.00', '0.00', '', '0', '287');
INSERT INTO `lx_order_goods` VALUES ('63', '57', '171', '海之言250mL夏日特惠', '9852345566', '2', '63.00', '0.00', '', '0', '299');
INSERT INTO `lx_order_goods` VALUES ('64', '58', '140', '热卖女式落肩翻边袖百搭短款T恤', 'CAECD114010888', '1', '36.00', '0.00', '', '0', '226');
INSERT INTO `lx_order_goods` VALUES ('65', '59', '162', '小茗同学', '58963252', '2', '5.00', '0.00', '', '0', '287');
INSERT INTO `lx_order_goods` VALUES ('66', '59', '171', '海之言250mL夏日特惠', '9852345566', '2', '63.00', '0.00', '', '0', '299');
INSERT INTO `lx_order_goods` VALUES ('67', '60', '142', '红米 Note', '08200102', '1', '799.00', '0.00', '', '0', '229');
INSERT INTO `lx_order_goods` VALUES ('68', '61', '209', '洗衣机', '1232356789', '1', '889.00', '0.00', '', '0', '341');
INSERT INTO `lx_order_goods` VALUES ('69', '62', '209', '洗衣机', '1232356789', '1', '889.00', '0.00', '', '0', '341');
INSERT INTO `lx_order_goods` VALUES ('70', '63', '209', '洗衣机', '1232356789', '1', '889.00', '0.00', '', '0', '341');
INSERT INTO `lx_order_goods` VALUES ('71', '64', '209', '洗衣机', '1232356789', '1', '889.00', '0.00', '', '0', '341');
INSERT INTO `lx_order_goods` VALUES ('72', '65', '209', '洗衣机', '1232356789', '1', '889.00', '0.00', '', '0', '341');
INSERT INTO `lx_order_goods` VALUES ('73', '66', '184', '卡姿兰大眼睛睫毛膏', '9745252122', '1', '986.00', '0.00', '', '0', '316');
INSERT INTO `lx_order_goods` VALUES ('74', '67', '171', '海之言250mL夏日特惠', '9852345566', '1', '63.00', '0.00', '', '0', '299');
INSERT INTO `lx_order_goods` VALUES ('75', '67', '164', '统一 小浣熊干脆面香辣蟹味46g 捏碎面点心面', '9658235896', '1', '62.00', '0.00', '', '0', '303');
INSERT INTO `lx_order_goods` VALUES ('76', '68', '144', '小米 note', '08200103', '1', '2999.00', '0.00', '', '0', '238');
INSERT INTO `lx_order_goods` VALUES ('77', '69', '197', '马尔代夫七日游', '123456782', '1', '2345.00', '0.00', '', '0', '329');
INSERT INTO `lx_order_goods` VALUES ('78', '70', '139', '红米 Note2', '08200101', '2', '799.00', '0.00', '', '0', '223');
INSERT INTO `lx_order_goods` VALUES ('79', '71', '178', '宜家大床', '9856555565', '1', '985556.00', '0.00', '', '0', '310');
INSERT INTO `lx_order_goods` VALUES ('80', '72', '138', 'CA2015女式可脱卸牛仔背带裤 纯棉猫须磨白毛边', 'CA200150692', '1', '199.00', '0.00', '', '0', '219');
INSERT INTO `lx_order_goods` VALUES ('81', '73', '142', '红米 Note', '08200102', '1', '799.00', '0.00', '', '0', '230');
INSERT INTO `lx_order_goods` VALUES ('82', '74', '178', '宜家大床', '9856555565', '1', '985556.00', '0.00', '', '0', '310');
INSERT INTO `lx_order_goods` VALUES ('83', '75', '178', '宜家大床', '9856555565', '1', '985556.00', '0.00', '', '0', '310');
INSERT INTO `lx_order_goods` VALUES ('84', '76', '142', '红米 Note', '08200102', '2', '799.00', '0.00', '', '0', '229');
INSERT INTO `lx_order_goods` VALUES ('85', '77', '153', '秋季新款男式骷髅印花短袖T恤 纯棉街头潮流', 'CA200156974 ', '1', '99.00', '0.00', '', '0', '263');
INSERT INTO `lx_order_goods` VALUES ('86', '78', '137', '2015秋装新款女式天丝披肩式风衣挽袖工装外套', 'CA200157963', '1', '499.00', '0.00', '', '0', '216');
INSERT INTO `lx_order_goods` VALUES ('87', '79', '144', '小米 note', '08200103', '2', '2999.00', '0.00', '', '0', '238');
INSERT INTO `lx_order_goods` VALUES ('88', '80', '285', '安慕希', '00000001', '1', '60.00', '0.00', '', '0', '422');

-- ----------------------------
-- Table structure for `lx_order_info`
-- ----------------------------
DROP TABLE IF EXISTS `lx_order_info`;
CREATE TABLE `lx_order_info` (
  `order_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `order_sn` varchar(20) NOT NULL DEFAULT '' COMMENT '订单编号',
  `provider_id` int(11) unsigned NOT NULL COMMENT '供货商id',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `fw_id` int(10) unsigned DEFAULT NULL COMMENT '转交的服务网点id',
  `agency_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '推荐人id',
  `shipping_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '送货人id',
  `order_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0：提交未支付；1，配货中；2，已发货；3，已取消；4，退货中；5，已退货；6：已完成；',
  `shipping_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '物流状态',
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付状态 0:未支付；1：支付；2：退款',
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人',
  `country_p_c` varchar(255) NOT NULL DEFAULT '0' COMMENT '省市区',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '收货地址',
  `tel` varchar(60) NOT NULL DEFAULT '' COMMENT '联系电话',
  `email` varchar(60) NOT NULL DEFAULT '' COMMENT '邮箱',
  `postscript` varchar(255) NOT NULL DEFAULT '' COMMENT '订单备注',
  `pay_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '支付号',
  `pay_name` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '支付方式',
  `goods_amount` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品数量',
  `order_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `confirm_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '确认时间',
  `pay_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '付款时间',
  `cost_fee` decimal(10,2) unsigned NOT NULL COMMENT '成本价',
  `profit` decimal(10,2) unsigned NOT NULL COMMENT '利润',
  `score` varchar(8) DEFAULT NULL COMMENT '积分支付比例',
  `pici_sn` varchar(255) DEFAULT NULL COMMENT '批次订单号',
  `is_comment` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_sn` (`order_sn`),
  KEY `user_id` (`user_id`),
  KEY `order_status` (`order_status`),
  KEY `shipping_status` (`shipping_status`),
  KEY `pay_status` (`pay_status`),
  KEY `shipping_id` (`shipping_id`),
  KEY `pay_id` (`pay_id`),
  KEY `agency_id` (`agency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_order_info
-- ----------------------------
INSERT INTO `lx_order_info` VALUES ('46', 'SN55232020150822934', '23', '34', null, '24', '0', '3', '0', '0', 'ssss123456', '山西省太原市万柏林区', 'fghjkk', '15236817351', '', '告诉卖家您的特殊要求;告诉卖家您的特殊要求;', '0', '0', '2', '5998.00', '1440080635', '0', '0', '5000.00', '998.00', null, 'SN55232020150822734', '0');
INSERT INTO `lx_order_info` VALUES ('47', 'SN31092120150817533', '22', '33', null, '26', '0', '3', '0', '0', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '0', '2', '198.00', '1440148171', '0', '0', '180.00', '18.00', null, 'SN31092120150817233', '0');
INSERT INTO `lx_order_info` VALUES ('48', 'SN31092120150817733', '35', '33', null, '26', '0', '3', '0', '0', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '0', '1', '986.00', '1440148171', '0', '0', '980.00', '6.00', null, 'SN31092120150817233', '0');
INSERT INTO `lx_order_info` VALUES ('49', 'SN36172120150817633', '29', '33', null, '26', '0', '4', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '不想买了', '0', '2', '1', '44.00', '1440148656', '0', '1440148660', '444.00', '0.00', '100', 'SN36172120150817433', '0');
INSERT INTO `lx_order_info` VALUES ('50', 'SN27212120150817233', '22', '33', null, '26', '0', '3', '0', '0', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '0', '1', '34.00', '1440148887', '0', '0', '30.00', '4.00', null, 'SN27212120150817733', '0');
INSERT INTO `lx_order_info` VALUES ('51', 'SN27212120150817933', '29', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;告诉卖家您的特殊要求;', '0', '2', '5', '26.00', '1440148887', '0', '1440150588', '14.00', '12.00', '100', 'SN27212120150817733', '0');
INSERT INTO `lx_order_info` VALUES ('52', 'SN30472120150817233', '29', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;告诉卖家您的特殊要求;', '0', '2', '2', '68.00', '1440150450', '0', '1440150457', '33.00', '35.00', '100', 'SN30472120150817233', '0');
INSERT INTO `lx_order_info` VALUES ('53', 'SN18522120150817733', '22', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '1', '34.00', '1440150738', '0', '1440151966', '30.00', '4.00', '100', 'SN18522120150817933', '0');
INSERT INTO `lx_order_info` VALUES ('54', 'SN18522120150817833', '29', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;告诉卖家您的特殊要求;', '0', '2', '2', '68.00', '1440150738', '0', '1440151914', '33.00', '35.00', '100', 'SN18522120150817933', '0');
INSERT INTO `lx_order_info` VALUES ('55', 'SN53532120150817434', '23', '34', null, '24', '0', '1', '0', '1', 'ssss', '江苏省南通市如东县', 'fghhjjjkkjfff', '15236817351', '', '告诉卖家您的特殊要求;', '0', '2', '1', '799.00', '1440150833', '0', '1440152846', '500.00', '299.00', '100', 'SN53532120150817734', '0');
INSERT INTO `lx_order_info` VALUES ('56', 'SN33222120150818933', '22', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '1', '36.00', '1440152553', '0', '1440152559', '30.00', '6.00', '100', 'SN33222120150818933', '0');
INSERT INTO `lx_order_info` VALUES ('57', 'SN33222120150818833', '29', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;告诉卖家您的特殊要求;', '0', '2', '4', '136.00', '1440152553', '0', '1440152559', '66.00', '70.00', '100', 'SN33222120150818933', '0');
INSERT INTO `lx_order_info` VALUES ('58', 'SN20482220150814933', '22', '33', null, '26', '27', '6', '2', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '1', '36.00', '1440226100', '0', '1440226106', '30.00', '6.00', '100', 'SN20482220150814933', '1');
INSERT INTO `lx_order_info` VALUES ('59', 'SN20482220150814733', '29', '33', null, '26', '27', '6', '2', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;告诉卖家您的特殊要求;', '0', '2', '4', '136.00', '1440226100', '0', '1440226106', '66.00', '70.00', '100', 'SN20482220150814933', '1');
INSERT INTO `lx_order_info` VALUES ('60', 'SN37302220150815733', '23', '33', null, '26', '0', '3', '0', '0', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '0', '1', '799.00', '1440228637', '0', '0', '500.00', '299.00', null, 'SN37302220150815633', '0');
INSERT INTO `lx_order_info` VALUES ('61', 'SN51342420150810941', '22', '41', null, '17', '0', '3', '0', '0', '1223', '河北省邢台市邢台县', '1212232', '15236817351', '', '告诉卖家您的特殊要求;', '0', '0', '1', '889.00', '1440383691', '0', '0', '451.00', '438.00', null, 'SN51342420150810341', '0');
INSERT INTO `lx_order_info` VALUES ('62', 'SN46352420150814133', '22', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '1', '889.00', '1440398146', '0', '1440398151', '451.00', '438.00', '100', 'SN46352420150814233', '0');
INSERT INTO `lx_order_info` VALUES ('63', 'SN55222420150816133', '22', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '1', '889.00', '1440404575', '0', '1440404580', '451.00', '438.00', '100', 'SN55222420150816933', '0');
INSERT INTO `lx_order_info` VALUES ('64', 'SN55342420150816433', '22', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '1', '889.00', '1440405295', '0', '1440405299', '451.00', '438.00', '100', 'SN55342420150816733', '0');
INSERT INTO `lx_order_info` VALUES ('65', 'SN59422420150816733', '22', '33', null, '26', '0', '3', '0', '0', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '0', '1', '889.00', '1440405779', '0', '0', '451.00', '438.00', null, 'SN59422420150816133', '0');
INSERT INTO `lx_order_info` VALUES ('66', 'SN45392420150817633', '35', '33', null, '26', '27', '6', '2', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '1', '986.00', '1440409185', '1440733129', '1440409191', '980.00', '6.00', '100', 'SN45392420150817833', '1');
INSERT INTO `lx_order_info` VALUES ('67', 'SN45392420150817933', '29', '33', null, '26', '0', '3', '0', '0', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;告诉卖家您的特殊要求;', '0', '0', '2', '125.00', '1440409185', '0', '0', '90.00', '35.00', null, 'SN45392420150817833', '0');
INSERT INTO `lx_order_info` VALUES ('68', 'SN17092420150819334', '23', '34', null, '24', '0', '1', '0', '1', 'ssss', '江苏省南通市如东县', 'fghhjjjkkjfff', '15236817351', '', '告诉卖家您的特殊要求;', '0', '2', '1', '2999.00', '1440414557', '0', '1440414563', '2500.00', '499.00', '100', 'SN17092420150819034', '0');
INSERT INTO `lx_order_info` VALUES ('69', 'SN39032420150821942', '22', '42', null, '34', '0', '3', '0', '0', '1234567', '天津市市辖区河西区', '的发发发', '13126589654', '', '沃尔沃惹我;', '0', '0', '1', '2345.00', '1440421419', '0', '0', '1231.00', '1114.00', null, 'SN39032420150821842', '0');
INSERT INTO `lx_order_info` VALUES ('70', 'SN02222420150821042', '23', '42', null, '34', '0', '0', '0', '0', '1234567', '天津市市辖区河西区', '的发发发', '13126589654', '', '大大松;', '0', '0', '2', '1598.00', '1440422522', '0', '0', '1300.00', '298.00', null, 'SN02222420150821842', '0');
INSERT INTO `lx_order_info` VALUES ('71', 'SN04212520150814146', '30', '46', null, '26', '0', '3', '0', '0', '张啸辰', '北京市市辖县延庆县', '213123123123', '18537161646', '', '告诉卖家您的特殊要求;', '0', '0', '1', '985556.00', '1440483664', '0', '0', '6522.00', '979034.00', null, 'SN04212520150814246', '0');
INSERT INTO `lx_order_info` VALUES ('72', 'SN57582520150815533', '22', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '1', '199.00', '1440489537', '0', '1440733114', '190.00', '9.00', '10', 'SN57582520150815633', '0');
INSERT INTO `lx_order_info` VALUES ('73', 'SN22182620150809841', '23', '41', null, '17', '0', '0', '0', '0', '1223', '河北省邢台市邢台县', '1212232', '15236817351', '', '告诉卖家您的特殊要求;', '0', '0', '1', '799.00', '1440551902', '0', '0', '500.00', '299.00', null, 'SN22182620150809141', '0');
INSERT INTO `lx_order_info` VALUES ('74', 'SN08382620150810434', '30', '34', null, '24', '0', '3', '0', '0', 'ssss', '江苏省南通市如东县', 'fghhjjjkkjfff', '15236817351', '', '告诉卖家您的特殊要求;', '0', '0', '1', '985556.00', '1440556688', '0', '0', '6522.00', '979034.00', null, 'SN08382620150810534', '0');
INSERT INTO `lx_order_info` VALUES ('75', 'SN23412620150816046', '30', '46', null, '26', '0', '0', '0', '0', '张啸辰', '北京市市辖县延庆县', '213123123123', '18537161646', '', '告诉卖家您的特殊要求;', '0', '0', '1', '985556.00', '1440578483', '0', '0', '6522.00', '979034.00', null, 'SN23412620150816746', '0');
INSERT INTO `lx_order_info` VALUES ('76', 'SN17362820150811633', '23', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '2', '1598.00', '1440732977', '0', '1440733030', '1000.00', '598.00', '10', 'SN17362820150811533', '0');
INSERT INTO `lx_order_info` VALUES ('77', 'SN52372820150811933', '22', '33', null, '26', '0', '1', '0', '1', '念小七', '河南省郑州市二七区', '建业舞动大楼', '15890052554', '', '告诉卖家您的特殊要求;', '0', '2', '1', '99.00', '1440733072', '0', '1440733077', '90.00', '9.00', '10', 'SN52372820150811933', '0');
INSERT INTO `lx_order_info` VALUES ('78', 'SN12142820150812556', '22', '56', null, '55', '0', '0', '0', '0', '张楠', '河南省新乡市长垣县', 'UUUUU', '13700736120', '', '告诉卖家您的特殊要求;', '0', '0', '1', '499.00', '1440735252', '0', '0', '490.00', '9.00', null, 'SN12142820150812656', '0');
INSERT INTO `lx_order_info` VALUES ('79', 'SN28152920150814133', '23', '33', null, '26', '0', '0', '0', '0', '1234', '辽宁省沈阳市皇姑区', '111', '15890052554', '', '告诉卖家您的特殊要求;', '0', '0', '2', '5998.00', '1440828928', '0', '0', '5000.00', '998.00', null, 'SN28152920150814333', '0');
INSERT INTO `lx_order_info` VALUES ('80', 'SN49540420150908782', '65', '82', null, '81', '0', '0', '0', '0', '张超楠', '河南省新乡市长垣县', '蒲东区罗镇屯西头', '13700731202', '', '告诉卖家您的特殊要求;', '0', '0', '1', '60.00', '1441328089', '0', '0', '52.00', '8.00', null, 'SN49540420150908782', '0');

-- ----------------------------
-- Table structure for `lx_shop_config`
-- ----------------------------
DROP TABLE IF EXISTS `lx_shop_config`;
CREATE TABLE `lx_shop_config` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT,
  `ghs_id` int(11) NOT NULL,
  `shop_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shop_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shop_desc` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `shop_keywords` char(150) COLLATE utf8_unicode_ci NOT NULL,
  `shop_shx` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `shop_detail` char(150) COLLATE utf8_unicode_ci NOT NULL,
  `shop_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shop_qq` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of lx_shop_config
-- ----------------------------
INSERT INTO `lx_shop_config` VALUES ('23', '25', '阿依莲', '做美丽的女人', '为爱美的你打造最美的你', '阿依莲', '江苏省南京市玄武区', '泰康路90号', './link/2015-08-19/55d49652a534f.jpg', '2350794144');
INSERT INTO `lx_shop_config` VALUES ('24', '24', '美丽女装成女神', '女神的选择', '主卖商品各种女生衣服', '女装', '江苏省南京市下关区', '江苏省南京市下关区33街', './link/2015-08-20/55d57d9fc1d7c.png', '15377768882');
INSERT INTO `lx_shop_config` VALUES ('25', '22', 'C&amp;A官方旗舰店', 'C&amp;A官方旗舰店', 'C&amp;A官方旗舰店', 'C&amp;A官方旗舰店', '省份地级市市、县级市', 'C&amp;A官方旗舰店', './link/2015-08-28/55dfd4131d5a6.jpg', '98756546556');
INSERT INTO `lx_shop_config` VALUES ('28', '23', '小米官方旗舰店', '小米正品', '绝对的正品，超低的价格，你值得拥有！', '小米 红米 小米 Note', '省份地级市市、县级市', '上海市浦东新区第六大街55号', './link/2015-08-21/55d6f0d18fa83.jpg', '2394657462');
INSERT INTO `lx_shop_config` VALUES ('27', '29', '海之蓝1', '', '', '', '', '', '', null);
INSERT INTO `lx_shop_config` VALUES ('29', '30', '爱丽思家居店', '爱丽思家居店爱丽思家居店爱丽思家居店', '爱丽思家居店爱丽思家居店爱丽思家居店爱丽思家居店', '爱丽思家居店爱丽思家居店爱丽思家居店爱丽思家居店', '上海市上海市卢湾区', '我是爱丽思家居店', './link/2015-08-21/55d6956401d9e.jpg', '');
INSERT INTO `lx_shop_config` VALUES ('35', '31', '方特欢乐园', '方特欢乐园', '方特欢乐园', '方特欢乐园', '上海市上海市黄浦区', '方特欢乐园', './link/2015-08-21/55d699293e168.jpg', '方特欢乐园');
INSERT INTO `lx_shop_config` VALUES ('31', '32', '途牛旅游', '途牛旅游', '途牛旅游', '途牛旅游', '上海市上海市黄浦区', '途牛旅游', './link/2015-08-21/55d69d47ed0b9.jpg', '');
INSERT INTO `lx_shop_config` VALUES ('32', '35', '海之蓝2', '', '', '', '', '', '', null);
INSERT INTO `lx_shop_config` VALUES ('33', '36', 'gdgdgdg ', 'gsjsgs ', 'djhdd', 'gdjgbdjh', '上海市上海市黄浦区', '6666', './link/2015-08-21/55d6a59d29885.jpg', '8756256354');
INSERT INTO `lx_shop_config` VALUES ('34', '37', 'HAUIHUFH', 'HSAUHDND', 'HSUAHN', 'HUDSHN', '上海市上海市黄浦区', 'HYSDISHDJ', './link/2015-08-21/55d6a7b945ec5.jpg', '9878654655');
INSERT INTO `lx_shop_config` VALUES ('36', '39', '阿里旅游', '阿里旅游', '阿里旅游', '阿里旅游', '上海市上海市黄浦区', '阿里旅游', './link/2015-08-22/55d84fb71032b.jpg', '98792232322');
INSERT INTO `lx_shop_config` VALUES ('37', '50', '', '', '', '', '', '', '', null);
INSERT INTO `lx_shop_config` VALUES ('54', '57', '诚信果业', '诚信果业', 'dd', 'dd', '河南省新乡市长垣县', '风格很关键', './link/2015-08-28/55dffcc73dea6.jpg', '5728274545');
INSERT INTO `lx_shop_config` VALUES ('39', '59', '海之澜官方美妆', ' 韩妆代购     个人护理   专业彩妆   男士护理       ', '  全部正品    假一赔十', '韩妆', '河南省新乡市长垣县', '海之澜官方美妆', './link/2015-08-30/55e265501143b.jpg', '572827454');
INSERT INTO `lx_shop_config` VALUES ('40', '60', '语微曼内衣', '语微曼内衣专卖', '语微曼调整型内衣一定让每个女人穿的舒适，性感，靓丽，让你更加具有女人味！穿起来更加稳固不跑位，调整不束缚，内置按摩设计，收副乳效果更胜一筹！', '语微曼让每个女人更加性感，靓丽，更加具有女人味！', '省份地级市市、县级市', '河南省新乡市长垣县', './link/2015-08-30/55e2552808278.jpg', '2752277418');
INSERT INTO `lx_shop_config` VALUES ('41', '62', '和平里超市', '所有商品，假一赔十，物美价廉，全县最低', '、、、一个电话，免费到家、、、', '超市', '省份地级市市、县级市', '软件开发与销售：电子数码产品批发、零售：国内广告制作与发布：五金、化妆品、日用百货批发、零售：工艺品、化工原料及产品（危险化学品除外）、通讯设备、仪器仪表、机电设备及配件、食品批发、零售', './link/2015-08-29/55e11c0e8ef66.jpg', '1599699030');
INSERT INTO `lx_shop_config` VALUES ('42', '61', '美特斯邦威 ', '美特斯邦威 ', '美特斯邦威', '美特斯邦威 不走寻常路', '河南省新乡市长垣县', '美特斯邦威 不走寻常路', './link/2015-08-29/55e11d61478aa.jpg', '36467351');
INSERT INTO `lx_shop_config` VALUES ('44', '64', '雅宝经典家具', '雅宝经典家居', '雅宝家具是一家专业化的连锁家具企业。雅宝家具一直致力于发展中、高档板式、实木家具设计、生产、销售。下面我们一起来了解一下雅宝家具怎么样及雅宝家具价格情况。', '雅宝家具是一家专业化的连锁家具企业。雅宝家具一直致力于发展中、高档板式、实木家具设计、生产、销售。下面我们一起来了解一下雅宝家具怎么样及雅宝家具价格情况。', '河南省新乡市长垣县', '雅宝家具是一家专业化的连锁家具企业。雅宝家具一直致力于发展中、高档板式、实木家具设计、生产、销售。下面我们一起来了解一下雅宝家具怎么样及雅宝家具价格情况。', './link/2015-08-29/55e16f1a6a66d.jpg', '2934770075');
INSERT INTO `lx_shop_config` VALUES ('43', '63', 'drded', 'dddd', 'gffdff', 'ffff', '河南省新乡市长垣县', 'ffffff', './link/2015-08-29/55e11981d9377.jpg', '572827454');
INSERT INTO `lx_shop_config` VALUES ('45', '65', '海之澜生活馆', '海之澜生活馆', '海之澜生活馆', '海之澜生活馆', '省份地级市市、县级市', '海之澜生活馆', './link/2015-08-29/55e18b9bec048.jpg', '36467351');
INSERT INTO `lx_shop_config` VALUES ('46', '69', '海之澜手机专卖', '手机之家，海量优质选择。—“机”不可失', '主营苹果、三星、华为、小米、魅族、黑莓、OPPO等知名品牌。', '海之澜手机专卖', '省份地级市市、县级市', '价格优惠、品质保障、优秀服务、您的购机首选。', './link/2015-08-30/55e2b55a95f61.jpg', '1250707644');
INSERT INTO `lx_shop_config` VALUES ('47', '70', '', '', '', '', '', '', '', null);
INSERT INTO `lx_shop_config` VALUES ('48', '72', '', '', '', '', '', '', '', null);
INSERT INTO `lx_shop_config` VALUES ('49', '78', '海之澜旅行社', '海之澜旅行社', '海之澜旅行社', '海之澜旅行社', '省份地级市市、县级市', '海之澜旅行社', './link/2015-09-01/55e573ffd4585.jpg', '36467351');
INSERT INTO `lx_shop_config` VALUES ('50', '76', '', '', '', '', '', '', '', null);
INSERT INTO `lx_shop_config` VALUES ('51', '79', '', '', '', '', '', '', '', null);
INSERT INTO `lx_shop_config` VALUES ('52', '80', '', '', '', '', '', '', '', null);
INSERT INTO `lx_shop_config` VALUES ('53', '83', '佳乐佳', '佳乐佳', '佳乐佳', '佳乐佳', '河南省新乡市长垣县', '佳乐佳', './link/2015-09-04/55e96524f173d.jpg', '36467351');

-- ----------------------------
-- Table structure for `lx_sys_config`
-- ----------------------------
DROP TABLE IF EXISTS `lx_sys_config`;
CREATE TABLE `lx_sys_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '系统常量id',
  `config_name` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  `u_id` int(11) NOT NULL,
  `type` enum('开启','关闭') DEFAULT '关闭',
  `h_type` enum('商品','代金卷') DEFAULT NULL,
  `h_title` varchar(200) DEFAULT NULL COMMENT '主要是活动的时候增加的标题',
  `ks` varchar(20) DEFAULT NULL,
  `js` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_sys_config
-- ----------------------------
INSERT INTO `lx_sys_config` VALUES ('1', 'J_M', '16', '85', '关闭', null, null, null, null);
INSERT INTO `lx_sys_config` VALUES ('2', 'SC_H', '20', '85', '关闭', '代金卷', null, null, null);
INSERT INTO `lx_sys_config` VALUES ('3', 'SJ_H', '1', '85', '开启', '代金卷', null, '2015-09-09 21:53', '2015-10-13 17:55');
INSERT INTO `lx_sys_config` VALUES ('4', 'SC_H', '/public/plugs/pe/001/15-09-09/1441794466897.jpg', '85', '关闭', '商品', '送妹子了', null, null);
INSERT INTO `lx_sys_config` VALUES ('8', 'SJ_H', '/public/plugs/pe/001/15-09-09/1441794712612.jpg', '85', '关闭', '商品', '妹子', '2015-09-16 17:53', '2015-09-16 22:55');

-- ----------------------------
-- Table structure for `lx_user`
-- ----------------------------
DROP TABLE IF EXISTS `lx_user`;
CREATE TABLE `lx_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `c_name` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `password` varchar(33) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '省市区街道',
  `jf` varchar(10) DEFAULT '0',
  `dj_jf` varchar(10) DEFAULT '0',
  `yj` varchar(255) DEFAULT '0',
  `dj_yj` varchar(252) DEFAULT '0',
  `grand` varchar(3) DEFAULT NULL,
  `user_up` int(10) DEFAULT NULL,
  `up_id` int(10) DEFAULT NULL,
  `r_time` int(11) DEFAULT NULL,
  `l_time` int(11) DEFAULT NULL,
  `user_addr` varchar(200) DEFAULT NULL COMMENT '详细地址',
  `status` tinyint(2) unsigned DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL COMMENT '图像',
  `nic` varchar(255) DEFAULT NULL COMMENT '昵称',
  `sex` varchar(4) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_user
-- ----------------------------
INSERT INTO `lx_user` VALUES ('15', 'hzl', '小王', 'MDAwMDAwMDAwMICFptuv0H2y', '', '', '', '0', '0', '0', '0', '99', '3', null, '1439945837', '1441423120', null, '1', null, null, null, null, null, null, null);
INSERT INTO `lx_user` VALUES ('84', '郑州测试', null, 'MDAwMDAwMDAwMLOFdax+mrCx', null, null, '945-946', '0', '0', '0', '0', '3', null, null, '1441608919', null, '郑州测试信息', '1', null, null, null, null, '945', '946', null);
INSERT INTO `lx_user` VALUES ('85', '全部', null, 'MDAwMDAwMDAwMK6Mp6mwnH2u', null, null, '', '0', '0', '0', '0', '100', '84', null, '1441608965', '1446019528', null, '1', null, null, null, null, null, null, null);
INSERT INTO `lx_user` VALUES ('89', '全地址测试', null, 'MDAwMDAwMDAwMK+LeKmAy4Cx', null, null, '44-45-47', '0', '0', '0', '0', '3', null, null, '1442212811', null, '测试一下', '1', null, null, null, null, '44', '45', '47');
INSERT INTO `lx_user` VALUES ('90', '管理员测试', null, 'MDAwMDAwMDAwMIW5fK+znYaw', '1@qq.com', '13838087235', '', '0', '0', '0', '0', '9', '85', null, '1445409690', null, null, '1', null, null, null, null, null, null, null);
INSERT INTO `lx_user` VALUES ('91', '测试区域', null, 'MDAwMDAwMDAwMIGEe96Co67c', null, null, '2197-2198-2202', '0', '0', '0', '0', '3', null, null, '1445846764', null, '这里是全部的开始', '1', null, null, null, null, '2197', '2198', '2202');

-- ----------------------------
-- Table structure for `lx_user_addrs`
-- ----------------------------
DROP TABLE IF EXISTS `lx_user_addrs`;
CREATE TABLE `lx_user_addrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) DEFAULT NULL,
  `ts` char(200) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `area` varchar(150) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `status` enum('弃用','记录','默认') DEFAULT '记录',
  `xxxx` varchar(200) DEFAULT NULL,
  `lianxi` char(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_user_addrs
-- ----------------------------
INSERT INTO `lx_user_addrs` VALUES ('18', '34', null, 'ssss', '山西省太原市杏花岭区', '123456', '记录', 'dgjjkklvb', '15236817351');
INSERT INTO `lx_user_addrs` VALUES ('19', '34', null, 'ssss123456', '山西省太原市万柏林区', '123456', '记录', 'fghjkk', '15236817351');
INSERT INTO `lx_user_addrs` VALUES ('21', '34', null, 'ssss', '江苏省南通市如东县', '123456', '默认', 'fghhjjjkkjfff', '15236817351');
INSERT INTO `lx_user_addrs` VALUES ('31', '56', null, 'WANG', '河南省新乡市长垣县', '453400', '记录', 'UUUUU\n', '65555555');
INSERT INTO `lx_user_addrs` VALUES ('23', '41', null, '1223', '河北省邢台市邢台县', '123456', '默认', '1212232', '15236817351');
INSERT INTO `lx_user_addrs` VALUES ('24', '42', null, '', '山西省太原市市辖区', '', '记录', '额外人父亲违反', '');
INSERT INTO `lx_user_addrs` VALUES ('25', '42', null, '', '吉林省白城市大安市', '', '记录', '发改委给我', '');
INSERT INTO `lx_user_addrs` VALUES ('26', '42', null, '2342', '吉林省白城市大安市', '456742', '记录', '的发发', '');
INSERT INTO `lx_user_addrs` VALUES ('27', '42', null, '2342', '吉林省白城市大安市', '456742', '记录', '的发发', '13526356236');
INSERT INTO `lx_user_addrs` VALUES ('28', '42', null, '24234', '河北省石家庄市桥东区', '423424', '记录', '打发', '13236598653');
INSERT INTO `lx_user_addrs` VALUES ('29', '42', null, '1234567', '天津市市辖区河西区', '456321', '默认', '的发发发', '13126589654');
INSERT INTO `lx_user_addrs` VALUES ('30', '46', null, '张啸辰', '北京市市辖县延庆县', '450007', '默认', '213123123123', '18537161646');
INSERT INTO `lx_user_addrs` VALUES ('32', '56', null, '张楠', '河南省新乡市长垣县', '453400', '默认', 'UUUUU', '13700736120');
INSERT INTO `lx_user_addrs` VALUES ('33', '33', null, '1234', '辽宁省沈阳市皇姑区', '450000', '默认', '111', '15890052554');
INSERT INTO `lx_user_addrs` VALUES ('34', '82', null, '张超楠', '河南省新乡市长垣县', '453400', '默认', '蒲东区罗镇屯西头', '13700731202');

-- ----------------------------
-- Table structure for `lx_user_ghs`
-- ----------------------------
DROP TABLE IF EXISTS `lx_user_ghs`;
CREATE TABLE `lx_user_ghs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT NULL,
  `sort` smallint(3) unsigned DEFAULT NULL,
  `brand_id` tinyint(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_user_ghs
-- ----------------------------

-- ----------------------------
-- Table structure for `lx_user_ghs_gn`
-- ----------------------------
DROP TABLE IF EXISTS `lx_user_ghs_gn`;
CREATE TABLE `lx_user_ghs_gn` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_attr_id` int(11) unsigned NOT NULL COMMENT '商品属性id',
  `up_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `startnum` int(11) unsigned DEFAULT '0',
  `c_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `content` enum('添加商品','删除商品','修改商品','单独下架','批量下架','卖出','删除属性','订单返回') NOT NULL,
  `endnum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_user_ghs_gn
-- ----------------------------
INSERT INTO `lx_user_ghs_gn` VALUES ('10', '14', '85', '7', '0', '2015-09-23 12:21:44', '添加商品', '500');
INSERT INTO `lx_user_ghs_gn` VALUES ('11', '15', '85', '7', '0', '2015-09-23 12:21:44', '添加商品', '12');
INSERT INTO `lx_user_ghs_gn` VALUES ('12', '16', '85', '8', '0', '2015-09-23 12:25:22', '添加商品', '234');
INSERT INTO `lx_user_ghs_gn` VALUES ('13', '17', '85', '8', '0', '2015-09-23 12:25:22', '添加商品', '123');
INSERT INTO `lx_user_ghs_gn` VALUES ('14', '18', '85', '9', '0', '2015-09-23 12:27:15', '添加商品', '12');
INSERT INTO `lx_user_ghs_gn` VALUES ('15', '19', '85', '9', '0', '2015-09-23 12:27:15', '添加商品', '32');
INSERT INTO `lx_user_ghs_gn` VALUES ('16', '20', '85', '10', '0', '2015-09-23 12:29:11', '添加商品', '23');
INSERT INTO `lx_user_ghs_gn` VALUES ('17', '21', '85', '10', '0', '2015-09-23 12:29:11', '添加商品', '123');
INSERT INTO `lx_user_ghs_gn` VALUES ('18', '19', '85', '9', '32', '2015-09-28 09:43:42', '删除属性', '0');
INSERT INTO `lx_user_ghs_gn` VALUES ('19', '22', '85', '11', '0', '2015-09-30 15:59:33', '添加商品', '213');
INSERT INTO `lx_user_ghs_gn` VALUES ('20', '23', '85', '12', '0', '2015-09-30 17:08:51', '添加商品', '0');
INSERT INTO `lx_user_ghs_gn` VALUES ('21', '24', '85', '12', '0', '2015-09-30 17:08:51', '添加商品', '0');
INSERT INTO `lx_user_ghs_gn` VALUES ('22', '25', '85', '15', '0', '2015-09-30 17:17:36', '添加商品', '12');
INSERT INTO `lx_user_ghs_gn` VALUES ('23', '25', '85', '15', '12', '2015-10-08 11:33:44', '删除属性', '0');
INSERT INTO `lx_user_ghs_gn` VALUES ('24', '26', '85', '16', '0', '2015-10-08 11:41:58', '添加商品', '12');
INSERT INTO `lx_user_ghs_gn` VALUES ('25', '27', '85', '16', '0', '2015-10-08 11:41:58', '添加商品', '34');
INSERT INTO `lx_user_ghs_gn` VALUES ('26', '28', '85', '17', '0', '2015-10-08 12:08:15', '添加商品', '12');
INSERT INTO `lx_user_ghs_gn` VALUES ('27', '29', '85', '17', '0', '2015-10-08 12:08:15', '添加商品', '34');
INSERT INTO `lx_user_ghs_gn` VALUES ('28', '30', '85', '17', '0', '2015-10-08 12:08:15', '添加商品', '34');
INSERT INTO `lx_user_ghs_gn` VALUES ('38', '26', '85', '16', '20', '2015-10-08 16:59:01', '修改商品', '20');
INSERT INTO `lx_user_ghs_gn` VALUES ('39', '26', '85', '16', '20', '2015-10-08 17:00:25', '修改商品', '19');

-- ----------------------------
-- Table structure for `lx_user_ghs_xxx`
-- ----------------------------
DROP TABLE IF EXISTS `lx_user_ghs_xxx`;
CREATE TABLE `lx_user_ghs_xxx` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `up_id` int(10) unsigned DEFAULT NULL,
  `money` varchar(30) DEFAULT NULL,
  `c_time` int(11) unsigned DEFAULT NULL,
  `c_ip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_user_ghs_xxx
-- ----------------------------

-- ----------------------------
-- Table structure for `lx_zfz`
-- ----------------------------
DROP TABLE IF EXISTS `lx_zfz`;
CREATE TABLE `lx_zfz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `dq` varchar(60) NOT NULL,
  `h_p` float(20,2) NOT NULL,
  `p_p` float(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lx_zfz
-- ----------------------------
INSERT INTO `lx_zfz` VALUES ('13', '91', '金水1号', '10.00', '30.00');
INSERT INTO `lx_zfz` VALUES ('4', '91', '金水2号', '45.00', '46.00');
INSERT INTO `lx_zfz` VALUES ('11', '91', '金水3号', '20.10', '11.00');
INSERT INTO `lx_zfz` VALUES ('12', '91', '金水4号', '33.00', '44.00');

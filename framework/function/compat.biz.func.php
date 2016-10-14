<?php
/**
 * $sn: pro/framework/function/compat.biz.func.php : v 1c53ee809f76 : 2015/04/23 02:12:39 : RenChao $
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */
defined('IN_IA') or exit('Access Denied');

if (isset($_W['uniacid'])) {
	$_W['weid'] = $_W['uniacid'];
}
if (isset($_W['openid'])) {
	$_W['fans']['from_user'] = $_W['openid'];
}
if (isset($_W['member']['uid'])) {
	if (empty($_W['fans']['from_user'])) {
		$_W['fans']['from_user'] = $_W['member']['uid'];
	}
}

/**
 * 获取一个或多个微擎用户某个或多个字段的信息.
 * @param number|array $uid 一个或多个用户 uid
 * @param array $fields 一个、多个或所有字段
 * @return array array('uid1'=>array()) or $user =array()
 */
if (!function_exists('fans_search')) {
	function fans_search($user, $fields = array()) {
		global $_W;
		load()->model('mc');
		$uid = intval($user);
		if(empty($uid)) {
			$uid = pdo_fetchcolumn("SELECT uid FROM ".tablename('mc_mapping_fans')." WHERE openid = :openid AND acid = :acid", array(':openid' => $user, ':acid' => $_W['acid']));
			if (empty($uid)) {
				return array(); //得到UID
			}
		}
		return mc_fetch($uid, $fields);
	}
}

if (!function_exists('fans_fields')) {
	function fans_fields() {
		load()->model('mc');
		return mc_fields();
	}
}

if(!function_exists('fans_update')) {
	function fans_update($user, $fields) {
		global $_W;
		load()->model('mc');
		$uid = intval($user);
		if(empty($uid)) {
			$uid = pdo_fetchcolumn("SELECT uid FROM ".tablename('mc_mapping_fans')." WHERE openid = :openid AND acid = :acid", array(':openid' => $user, ':acid' => $_W['acid']));
			if (empty($uid)) {
				return false; //得到UID
			}
		}
		return mc_update($uid, $fields);
	}
}

if (!function_exists('create_url')) {
	function create_url($segment = '', $params = array(), $noredirect = false) {
		return url($segment, $params, $noredirect);
	}
}

if (!function_exists('toimage')) {
	function toimage($src) {
		return tomedia($src);
	}
}

if (!function_exists('uni_setting')) {
	function uni_setting($uniacid = 0, $fields = '*', $force_update = false) {
		global $_W;
		load()->model('account');
		if ($fields == '*') {
			$fields = '';
		}
		return uni_setting_load($fields, $uniacid);
	}
}
if (!function_exists('activity_token_owned')) {
	function activity_token_owned($uid, $filter = array(), $pindex = 1, $psize = 10) {
		return activity_coupon_owned();
	}
}
if (!function_exists('activity_token_info')) {
	function activity_token_info($couponid, $uniacid) {
		return activity_coupon_info($couponid);
	}
}
if (!function_exists('activity_token_grant')) {
	function activity_token_grant($uid, $couponid, $module = '', $remark = '') {
		return activity_coupon_grant($couponid,$uid);
	}
}
if (!function_exists('activity_token_use')) {
	function activity_token_use($uid, $couponid, $operator, $clerk_id = 0, $recid = '', $module = 'system', $clerk_type = 1, $store_id = 0) {
		return activity_coupon_use($couponid,$recid, $module);
	}
}
if (!function_exists('activity_token_available')) {
	function activity_token_available($uid, $pindex = 1, $psize = 0) {
		return activity_coupon_available();
	}
}
<?php

/**
  $CK = A('CheckInput');
  $id = $CK->in($Cname,$name,$CheckType,$default,$LengMin,$LengMax);

 * in方法使用说明
 * @param $CnName  字符串,中文名,出错时提示用
 * @param $name 字符串,传入参数,可用 get.id或post.id,put.id等，  参考thinkphp的I方法
 * @param $CheckType 字符串,过滤方法,
 * @param $default(可选) 字符串,默认值
 * @param $LengMin(可选) 数字,最短长度,为0时不限制
 * @param $LengMax(可选) 数字,最大长度,为0时不限制

  ---$CheckType可用值:
  intval 0或正整数
  date   日期 如:2014-05-02
  time   时间 如:16:25:00
  datetime 长时间 如:2014-05-02 16:25:00
  password 密码 自动md5后，取前28位字符
  bool   是/否 除输入为0外, 其它都返回 1;
  float  小数 如:1253.123, 不限制小数点多少位
  float(8,2) 小数,整数8位,小数2位,8和2可改
  email 邮箱格式,（后期加防注入)
  saveimage 上传图片,最短长度不为0，即为必须上传，现在每个页面仅支持上传一个图片
  enstr  仅为字母,
  numstr 仅为数字,
  ennumstr  字母,数字,下划线,(防注入)
  cnennumstr  中文,英文,数字,下划线,(即不允许有特殊字符)(防注入)
  string 任意字符串,后期加入防sql注入,防xss,防javascript,尽量不要使用这种方式过滤
  htcontent 内容型,后台在线内容编辑器专用,前台内容编辑器也不能使用,其它地方尽量不要使用,防sql注入,不防javascript
  例：(取多个值时，只A一次即可)
  $CK  = A('CheckInput');
  $id  = $CK->in('id变量','get.id','intval','',0,3);
  $str = $CK->in('密码','get.str','password','',1);
 */
function CheckInputFunc($CnName, $name, $CheckType, $default = NULL, $LengMin = 0, $LengMax = 0) {
    $res ['ok'] = true;
    $res ['error'] = '';
    $res ['data'] = NULL;
    if (strpos($name, '.')) { // 指定参数来源
        list ( $method, $name ) = explode('.', $name, 2);
    } else { // 默认为自动判断
        $method = 'param';
    }
    switch (strtolower($method)) {
        case 'get' :
            $input = & $_GET;
            break;
        case 'post' :
            $input = & $_POST;
            break;
        case 'put' :
            parse_str(file_get_contents('php://input'), $input);
            break;
        case 'param' :
            switch ($_SERVER ['REQUEST_METHOD']) {
                case 'POST' :
                    $input = $_POST;
                    break;
                case 'PUT' :
                    parse_str(file_get_contents('php://input'), $input);
                    break;
                default :
                    $input = $_GET;
            }
            break;
        case 'path' :
            $input = array();
            if (!empty($_SERVER ['PATH_INFO'])) {
                $depr = C('URL_PATHINFO_DEPR');
                $input = explode($depr, trim($_SERVER ['PATH_INFO'], $depr));
            }
            break;
        case 'request' :
            $input = & $_REQUEST;
            break;
        case 'session' :
            $input = & $_SESSION;
            break;
        case 'cookie' :
            $input = & $_COOKIE;
            break;
        case 'server' :
            $input = & $_SERVER;
            break;
        case 'globals' :
            $input = & $GLOBALS;
            break;
        case 'data' :
            $input = & $datas;
            break;
        case 'file' :
            $input = & $_FILES;
            break;
        default :
            return NULL;
    }
    if (empty($name)) { // 获取全部变量
        $res ['ok'] = false;
        $res ['error'] = '方法传入参数错误！';
        return $res;
    } elseif (isset($input [$name])) { // 取值操作
        $data = $input [$name];
    } else { // 变量默认值
        $data = isset($default) ? $default : NULL;
    }

    if ($LengMin != 0) {
        if ($data == '' || $data == NULL) {
            $res ['ok'] = false;
            $res ['error'] = "请填写【 $CnName 】！";
            return $res;
        }
        if (mb_strlen($data, 'utf8') < $LengMin) {
            $res ['ok'] = false;
            $res ['error'] = "【 $CnName 】太短,请重输！";
            return $res;
        }
    } else {
        if ($data == '' || $data == NULL) {
            $res ['ok'] = true;
            $res ['data'] = $data;
            return $res;
        }
    }
    if ($LengMax != 0) {
        if (mb_strlen($data, 'utf8') > $LengMax) {
            $res ['ok'] = false;
            $res ['error'] = "【 $CnName 】太长,请重输！";
            return $res;
        }
    }

    $CKT = new CheckInput();
    $CKT->CnName = $CnName;
    $CKT->CheckType = $CheckType;
    $CKT->data = $data;
    $CKT->LengMin = $LengMin;

    return $CKT->check();
}

class CheckInput {

    var $CnName; // 中文名
    var $CheckType; // 过滤类型
    var $data; // 要过滤的变量
    var $res; // 反回的数组
    var $LengMin;
    var $postfilter = "<[^>]*?=[^>]*?&#[^>]*?>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b[^>]*?>|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";
    var $htcontentfilter = "<[^>]*?=[^>]*?&#[^>]*?>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\()|<[^>]*?\\b(onerror|onmousemove|onload|onclick|onmouseover)\\b[^>]*?>|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*scriiipt\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";

    function __construct() {
        
    }

    function check() {
        switch ($this->CheckType) {
            case 'intval' :
                $this->_intval();
                break;
            case 'date' :
                $this->_date();
                break;
            case 'time' :
                $this->_time();
                break;
            case 'datetime' :
                $this->_datetime();
                break;
            case 'password' :
                $this->_password();
                break;
            case 'string' :
                $this->_string();
                break;
            case 'enstr' :
                $this->_enstr();
                break;
            case 'numstr' :
                $this->_numstr();
                break;
            case 'ennumstr' :
                $this->_ennumstr();
                break;
            case 'cnennumstr' :
                $this->_cnennumstr();
                break;
            case 'htcontent' :
                $this->_htcontent();
                break;
            case 'float' :
                $this->_float();
                break;
            case 'bool' :
                $this->_bool();
                break;
            case 'email' :
                $this->_email();
                break;
            case 'saveimage' :
                $this->_saveimage();
                break;
            case 'uploadFile' :
                $this->_uploadFile();
                break;
            case 'shenfenzheng':
                $this->_shenfenzheng();
                break;
            default :
                // 处理特殊值 如 float(11,2)
                if ((strpos($this->CheckType, 'float')) !== false) {
                    $this->_floatex();
                } elseif (false) {
                    
                } else {
                    $this->res ['ok'] = false;
                    $this->res ['error'] = '函数过滤方法填写错误';
                }
        }
        return $this->res;
    }

    private function _saveimage() {
        if (C('CheckInputsaveimage') == NULL) {
            // echo '===================';
            $upload = new \Think\Upload (); // 实例化上传类
            $upload->autoSub = true; // 是否使用子目录保存上传文件
            $upload->subType = 'date'; // 子目录创建方式，默认为hash，可以设置为hash或者date
            $upload->dateFormat = 'd'; // 子目录方式为date的时候指定日期格式
            $upload->maxSize = 1887437; // 设置附件上传大小
            $upload->exts = array(
                'jpg',
                'gif',
                'png',
                'jpeg'
            ); // 设置附件上传类型
            $upload->rootPath = 'uploads'; // 设置附件上传根目录
            $upload->savePath = '/images/' . date('Y-m', time()) . '/'; // 设置附件上传目录
            $upload->replace = true;
            // $upload->mimes = array('image/jpeg','image/jpg','image/gif','image/png'); //允许上传的文件类型（留空为不限制）
            // $upload->callback=true;
            $info = $upload->upload();
            if (!$info) { // 上传错误提示错误信息
                $error = $upload->getError();
                if (strpos($error, '没有文件被上传') !== false) {
                    // echo '没有文件上传';
                } else {
                    $this->res ['ok'] = false;
                    $this->res ['error'] = '【 ' . $this->CnName . ' 】' . $error;
                    return 0;
                }
            }
            C('CheckInputsaveimage', $info);
        } else {
            $info = C('CheckInputsaveimage');
        }

        // dump($info);
        // dump($this->data);

        $savefile = $info [$this->data] ["savepath"] . $info [$this->data] ["savename"];

        if ($savefile == '' || $savefile == null) {
            $savefile = '';
            if ($this->LengMin > 0) {
                $this->res ['ok'] = false;
                $this->res ['error'] = '【 ' . $this->CnName . ' 】必须上传,请重输！';
                return 0;
            }
        } else {
            // $savefile='/uploads'.$savefile;
            $savefile = 'uploads' . $savefile;
        }

        $this->res ['ok'] = true;
        $this->res ['data'] = $savefile;

        // die();
        // 保存表单数据 包括附件数据
        // return $savePath.$info[0]['savename']; // 保存上传的照片根据需要自行组装
    }

    /*
     * 上传文件($_File)
     */

    private function _uploadFile() {
        $upload = new \Think\Upload (); // 实例化上传类
        $upload->autoSub = true; // 是否使用子目录保存上传文件
        $upload->subType = 'date'; // 子目录创建方式，默认为hash，可以设置为hash或者date
        $upload->dateFormat = 'd'; // 子目录方式为date的时候指定日期格式
        $upload->maxSize = 1887437; // 设置附件上传大小
        $upload->exts = array(
            'jpg',
            'gif',
            'png',
            'jpeg'
        ); // 设置附件上传类型
        $upload->rootPath = 'uploads'; // 设置附件上传根目录
        $upload->savePath = '/images/' . date('Y-m', time()) . '/'; // 设置附件上传目录
        $upload->replace = true;
        $info = $upload->upload();
        if (!$info) { // 上传错误提示错误信息
            $error = $upload->getError();
            if (strpos($error, '没有文件被上传') !== false) {
                // echo '没有文件上传';
            } else {
                $this->res ['ok'] = false;
                $this->res ['error'] = '【 ' . $this->CnName . ' 】' . $error;
                return 0;
            }
        }

        $savefile = $info [key($info)] ["savepath"] . $info [key($info)] ["savename"];

        if ($savefile == '' || $savefile == null) {
            $savefile = '';
            if ($this->LengMin > 0) {
                $this->res ['ok'] = false;
                $this->res ['error'] = '【 ' . $this->CnName . ' 】必须上传,请重输！';
                return 0;
            }
        } else {
            $savefile = 'uploads' . $savefile;
        }

        $this->res ['ok'] = true;
        $this->res ['data'] = $savefile;
    }

    private function _htcontent() {
        // if (preg_match("/".$this->htcontentfilter."/is",$this->data)==1){
        // $this->res['ok']=false;
        // $this->res['error']='【 '.$this->CnName.' 】包含非法字符,请重输！';
        // return 0;
        // }
        $this->res ['ok'] = true;
        $this->res ['data'] = ($this->data);
    }

    private function _cnennumstr() {
        if (preg_match("/" . $this->postfilter . "/is", $this->data) == 1) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】包含非法字符,请重输！';
            return 0;
        }
        // if(!preg_match("/^[0-9a-zA-Z_]{1,}$/",$this->data)){
        // if(!preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$this->data)){
        if (!preg_match("/^[\x80-\xff_a-zA-Z0-9]+$/", $this->data)) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】不能包含特殊字符,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = ($this->data);
    }

    private function _string() {
        if (preg_match("/" . $this->postfilter . "/is", $this->data) == 1) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】包含非法字符,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = ($this->data);
    }

    private function _ennumstr() {
        if (preg_match("/" . $this->postfilter . "/is", $this->data) == 1) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】包含非法字符,请重输！';
            return 0;
        }
        if (!preg_match("/^[0-9a-zA-Z_]{1,}$/", $this->data)) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】只能输入数字,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
    }

    private function _numstr() {
        if (!preg_match("/^[-]{0,1}[0-9]{1,}$/", $this->data)) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】只能输入整数,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
    }

    private function _enstr() {
        if (preg_match("/" . $this->htcontentfilter . "/is", $this->data) == 1) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】包含非法字符,请重输！';
            return 0;
        }
        if (!preg_match("/^[a-zA-Z]{1,}$/", $this->data)) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】只能输入英文字母,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
    }

    private function _email() {
        if (preg_match("/" . $this->postfilter . "/is", $this->data) == 1) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】包含非法字符,请重输！';
            return 0;
        }
        if (!preg_match("/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3}$/", $this->data)) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】格式错误,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
    }

    private function _floatex() {
        $pa = '/float\((.*),(.*)\)/';
        preg_match_all($pa, $this->CheckType, $ma);
        // dump($ma[1][0]);
        // dump($ma[2][0]);
        if (!preg_match("/^[-]{0,1}\d{0," . $ma [1] [0] . "}\.{0,1}(\d{0," . $ma [2] [0] . "})?$/", $this->data)) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】只能输入整数或小数,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
    }

    private function _float() {
        try {
            $str = (double) ($this->data);
        } catch (Exception $e) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】只能输入整数或小数,请重输！';
            return 0;
        }
        if ((string) ($str) != $this->data) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】只能输入整数或小数,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
    }

    private function _bool() {
        if ($this->data == 0) {
            $this->res ['data'] = 0;
        } else {
            $this->res ['data'] = 1;
        }
        $this->res ['ok'] = true;
    }

    private function _password() {
        $this->res ['ok'] = true;
        $this->res ['data'] = substr(md5($this->data), 0, 28);
    }

    private function _intval() {
        if (!preg_match("/^[-]{0,1}[0-9]{1,}$/", $this->data)) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】只能输入整数,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
        /*
         * if( strval($this->data) == strval(intval($this->data)) ){ $this->res['ok']=true; $this->res['data']=$this->data; }else{ $this->res['ok']=false; $this->res['error']='【 '.$this->CnName.' 】只能输入数字,请重输！'; }
         */
    }

    private function _date() {
        if (!preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/', $this->data)) {
            if (!preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/', $this->data)) {
                $this->res ['ok'] = false;
                $this->res ['error'] = '【 ' . $this->CnName . ' 】格式错误,请重输！';
                return 0;
            }
        }
        if (strtotime($this->data) === false) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】格式错误,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
    }

    private function _time() {
        if (!preg_match('/^[0-2]{0,1}[0-9]{1}[:]{1}[0-5]{0,1}[0-9]{1}[:]{1}[0-5]{0,1}[0-9]{1}$/', $this->data)) {
            if (!preg_match('/^[0-2]{0,1}[0-9]{1}[:]{1}[0-5]{0,1}[0-9]{1}$/', $this->data)) {
                $this->res ['ok'] = false;
                $this->res ['error'] = '【 ' . $this->CnName . ' 】格式错误,请重输！';
                return 0;
            }
        }
        if (strtotime($str_tmp) === false) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】格式错误,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
    }

    private function _datetime() {
        if (!preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2} [0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}$/', $this->data)) {
            if (!preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2} [0-9]{1,2}:[0-9]{1,2}$/', $this->data)) {
                $this->res ['ok'] = false;
                $this->res ['error'] = '【 ' . $this->CnName . ' 】格式错误,请重输！';
                return 0;
            }
        }
        if (strtotime($this->data) === false) {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】格式错误,请重输！';
            return 0;
        }
        $this->res ['ok'] = true;
        $this->res ['data'] = $this->data;
    }

    private function _shenfenzheng() {
        if (ck_shengfenzheng($this->data)) {
            $this->res ['ok'] = true;
            $this->res ['data'] = $this->data;
        } else {
            $this->res ['ok'] = false;
            $this->res ['error'] = '【 ' . $this->CnName . ' 】格式错误,请重输！';
            return 0;
        }
    }

}

/**
 * 加密解密函数
 * $operation DECODE ENCODE
 * 
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

    $ckey_length = 4;

    //$key = md5($key ? $key : UC_KEY);
    $key = md5($key);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);

    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);

    $result = '';
    $box = range(0, 255);

    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }

    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }

    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }

    if ($operation == 'DECODE') {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . str_replace('=', '', base64_encode($result));
    }
}

/**
 * 添加规则
 */
function rulAutoAdd($str, $pid, $des = '') {
    if (empty($str) || empty($pid)) {
        $return['message'] = "参数不能为空!";
        $return['status'] = false;
        return $return;
    }
    //查找规则标识是否存在	
    $name = M()->table('__AUTH_RULE__')->where(array('name' => $str))->cache('ruleAutoAdd' . $str, 300)->field('name')->count();
    if ($name) {
        $return['message'] = "规则标识已经存在!";
        $return['status'] = false;
        return $return;
    }
    //添加规则
    $id = M()->table('__AUTH_RULE__')->add(array('name' => $str, 'pid' => $pid, 'title' => $des));
    if ($id) {
        $return['message'] = "规则标识添加成功!";
        $return['status'] = true;
        S('ruleAutoAdd' . $str, null); //删除缓存,防止出错
    } else {
        $return['message'] = "规则标识添加失败!";
        $return['status'] = false;
    }
    return $return;
}

/**
 * 权限验证
 * @param rule string|array  需要验证的规则列表,支持逗号分隔的权限规则或索引数组
 * @param uid  int           认证用户的id
 * @param string mode        执行check的模式
 * @param relation string    如果为 'or' 表示满足任一条规则即通过验证;如果为 'and'则表示需满足所有规则才能通过验证
 * @return boolean           通过验证返回true;失败返回false
 * @return author            灵秀科技		2853102650
 */
function authCheck($rule, $uid, $type = 1, $mode = 'url', $relation = 'or') {
    //超级管理员跳过验证
    $auth = new \Think\Auth();
    //获取当前uid所在的角色组id
    $groups = $auth->getGroups($uid);
    session('gid', $groups[0]['group_id']); //角色组id
    session('gname', $groups[0]['title']); //角色组名称
    //设置的是一个用户对应一个角色组,所以直接取值.如果是对应多个角色组的话,需另外处理
    if (in_array($groups[0]['group_id'], C('ADMINISTRATOR'))) {
        return true;
    } else if (in_array($rule, C('NO_AUTH_RULES'))) {
        return true;
    } else {
        return $auth->check($rule, $uid, $type, $mode, $relation) ? true : false;
    }
}
function Page($rows, $page_size, $page) {
    $page_count = ceil($rows / $page_size);
    $rows1 = array();
    if ($page >= $page_count)
        $page = $page_count;
    if ($page <= 1 || $page == '')
        $page = 1;
    $select_limit = $page_size;
    $w_url1 = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] .$_SERVER['QUERY_STRING'];
    $w_url4=  strpos($w_url1,'?');
    $w_url= substr($w_url1,0,$w_url4);
    $select_from = ($page - 1) * $page_size;
    $rows1['page_l'] = $select_from;
    $rows1['page_r'] = $select_limit;
    $pre_page = ($page == 1) ? 1 : $page - 1;
    $next_page = ($page == $page_count) ? $page_count : $page + 1;

    $pagenav = "<a href='" . $w_url . "?page=1'>首页</a> ";
    $pagenav .= "<a href='" . $w_url . "?page=" . $pre_page . "'>前一页</a> ";
    $pagenav .= "<a href='" . $w_url . "?page=" . $next_page . "'>后一页</a> ";
    $pagenav .= "<a href='" . $w_url . "?page=" . $page_count . "'>末页</a>";
    $pagenav .= "第 " . $page . "/" . $page_count . " 页 共 " . $rows . " 条 ";
    $pagenav.="跳到&nbsp;&nbsp;<select name='topage' size='1' onchange='window.location=\"" . $w_url . "&page=\"+this.value'>\n";
    for ($i = 1; $i <= $page_count; $i++) {
        if ($i == $page)
            $pagenav.="<option value='$i' selected>$i</option>\n";
        else
            $pagenav.="<option value='$i'>$i</option>\n";
    }
    $pagenav.='</select>';
    $rows1['page'] = $pagenav;
    return $rows1;
}
/* 名字获取 */

function Name($id) {
    $rowsss = M('user')->where("id=$id")->field('name')->find();
    return $rowsss['name'];
}

/* 获取当前的分站 */
function Fzid($id) {
    $num = M('user')->where("id=$id")->field('user_up')->count();
    switch ($num) {
        case 0:
            return $id;
            break;
        default:
            $num = M('user')->where("id=$id")->field('user_up')->find();
            return $num['user_up'];
            break;
    }
}

//获取属性名称
function getAttrName($attr_id) {
    $goods_attr = M("GoodsAttr");
    $g_a = $goods_attr->where("id={$attr_id}")->find();
    if(!$g_a['attr_id']){
        $attr_name='无属性';
    }else{
    $attr_id = explode('-', rtrim($g_a['attr_id'], '-'));
    $attr_value = explode('-', rtrim($g_a['attr_value'], '-'));
    $num = count($attr_id);
    $attr_name = '';
    for ($i = 0; $i < $num; $i++) {
        $attribute = M("GoodsAttribute");
        $a_n = $attribute->where("attr_id={$attr_id[$i]}")->getField("attr_name");
        $a_v = $attr_value[$i];
        $attr_name.=$a_n . ':' . $a_v . ';';
    }
    }
    return $attr_name;
}

//分页方法
 function getPage($p,$pnum,$count,$limit) {
    //分页功能
    $url = '?';
    $cur = '';
    $jian=$p-1;
    if($jian<1){
        $jian=1;
    }
    if ($pnum > 1) {
        $str = "<a class=\"cpage\" href=\"{$url}&p=1\">首页</a><a class=\"cpage\" href=\"{$url}&p=" . ($jian) . "\">上一页</a>";
        if ($pnum < 5) {
            for ($i = 0; $i < $pnum; $i++) {
                if ($p == ($i + 1))
                    $cur = 'style="background-color: #ff6b2b;color: #fff;width:40px;"';
                $str.='<a ' . $cur . ' href="' . $url . '&p=' . ($i + 1) . '">' . ($i + 1) . '</a>';
                $cur = '';
            }
        }else {
            if ($p + 3 > $pnum) {
                for ($i = $pnum - 3; $i < $pnum + 1; $i++) {
                    if ($p == $i)
                        $cur = 'style="background-color: #ff6b2b;color: #fff;"';
                    $str.='<a ' . $cur . ' href="' . $url . '&p=' . ($i) . '">' . ($i) . '</a>';
                    $cur = '';
                }
            }else {
                for ($i = $p; $i < $p + 3; $i++) {
                    if ($p == $i)
                        $cur = 'style="background-color: #ff6b2b;color: #fff;"';
                    $str.='<a ' . $cur . ' href="' . $url . '&p=' . ($i) . '">' . ($i) . '</a>';
                    $cur = '';
                }
                $str.='<a>......</a>';
            }
        }
        if ($p < $pnum)
            $str.='<a class="cpage" href="' . $url . '&p=' . ($p + 1) . '">下一页</a>';
        $str.='<a class="cpage" href="' . $url . '&p=' . $pnum . '">末页</a>';
    }else {
        $str = '';
    }
    return $str;
}

function lx_ucenter_encrypt($data, $key, $expire = 0) {
    $key  = md5($key);
    $data = base64_encode($data);
    $x    = 0;
    $len  = strlen($data);
    $l    = strlen($key);
    $char =  '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) $x=0;
        $char  .= substr($key, $x, 1);
        $x++;
    }
    $str = sprintf('%010d', $expire ? $expire + time() : 0);
    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data,$i,1)) + (ord(substr($char,$i,1)))%256);
    }
    return str_replace('=', '', base64_encode($str));
}




/*订单函数*/
function checkorderstatus($ordid){
     $Ord=M('Orderlist');
    $ordstatus=$Ord->where('ordid='.$ordid)->count();
    if($ordstatus>0){
        return false;
    }
    //库存
   
    $o_data1=M("OrderInfo")->where("pici_sn=$ordid")->select();
    foreach($o_data1 as $k=>$v){
        $order_id = $v['order_id'];
        $o_data = M("OrderGoods")->where("order_id=$order_id")->select();
            foreach ($o_data as $k => $v) {
                $id = $v['goods_attr_id']; //商品属性id
                $goods_attr = M("GoodsAttr")->where("id=$id")->find();
                //$price=$goods_attr[0]['market_price'];//商品库中的价格
                $stock = $goods_attr['goods_count']; //商品的库存

                $shop_num = $v['goods_number']; //购买的商品数量
                if (intval($shop_num) > intval($stock)) {
                    //$this->ajaxReturn(array('info' => 0, 'msg' => '商品库存不足'));
                    return false;
                }
            }
    }
    return true;
}

function orderhandle($parameter){
    $ordid=$parameter['out_trade_no'];
    $data['ordid']                 =$ordid;//商家编号
    $data['payment_trade_no']      =$parameter['trade_no'];//支付宝交易号；
    $data['payment_trade_status']  =$parameter['trade_status'];//交易状态；
    $data['payment_notify_id']     =$parameter['notify_id'];//通知校验ID。
    $data['payment_notify_time']   =$parameter['notify_time'];//通知的发送时间。
    $data['payment_buyer_email']   =$parameter['buyer_email'];//买家支付宝帐号；
    $data['ordfee']             =$parameter['total_fee'];   //交易金额；
    $data['ordstatus']             =1;
    $Ord=M('Orderlist');
    //$rows= $Ord->where('ordid='.$ordid)->save($data);
    //$rows==1?:$Ord->add($data);
    $Ord->add($data);
    //积分
    $config=M("SysConfig");
    $user=$config->where("config_name='MONERY_JF_ZF'")->getField("config_value");//积分支付比例
    
    $user1 = $config->where("config_name='MONERY_JF'")->getField("config_value");//用户比例
    
    $o_data1=M("OrderInfo")->where("pici_sn=$ordid")->select();
    $dj_score = 0.00;
    $uid=  session("Q_USER");
    foreach($o_data1 as $k=>$v){
        $order_id = $v['order_id'];
        $order = M("OrderInfo");
                $add['order_status'] = 1;
                $add['shipping_status'] = 0;
                $add['pay_status'] = 1;
                $add['pay_name'] = 0;//支付宝
                $add['pay_time'] = time();
                $add['score'] = $user;
                $add1['order_id'] = $order_id;
                $order->where($add1)->save($add);
                //获取该订单的积分
                $profit = M("OrderInfo")->where("order_id=$order_id")->getField("profit");
                $score = $profit * ($user1 / 100) * ($user / 100); //冻结积分
                $dj_score+=$score;
                //减去商品的库存
                $order_item=M("OrderGoods")->where("order_id=$order_id")->select();
                foreach($order_item as $k=>$v){
                    $id=$v['goods_attr_id'];//属性id
                    $num=$v['goods_number'];
                    $gid=$v['goods_id'];
                    $stock=M("GoodsAttr")->where("id=$id")->getField("goods_count");
                    $sj_stock=$stock-$num;//减掉库存
                    $s_d=M("GoodsAttr")->where("id=$id")->setField("goods_count", $sj_stock);
                    if($s_d){
                        /*库存日志开始*/
                        $kcdata['goods_attr_id'] = $id;
                        $kcdata['endnum'] = $sj_stock;
                        $kcdata['startnum'] = $stock;

                        $kcdata['up_id'] = $uid;
                        $kcdata['sp_id'] = $gid;
                        $kcdata['content'] = "卖出";
                        $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
                        $kuncun = M('user_ghs_gn')->add($kcdata);
                        
                        /*库存日志结束*/
                    }
                }
    }
    //向用户表加入冻结积分
            $dj = M("User")->where("id=$uid")->getField("dj_jf");
            $dj_jf = $dj + $dj_score;
            $data = M("User")->where("id=$uid")->setField("dj_jf", $dj_jf);
    /**/
    /*更新自己订单的状态 order_sn*/

}


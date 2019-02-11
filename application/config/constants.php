<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//사용자 정의 상수
//사이트 전역변수
define('sSiteUrl',"http://wms.allt.kr");
define('sSiteCookie',"wms.allt.kr");
const sUploadUrl="http://img.allt.kr";
const sLinkSiteUrl="http://wms.allt.kr";
const sSiteName="Warehouse Management System";
/*
//사이트 전역배열
const arrPermission=array(array("1-1","회원가입 현황"),array("1-2","승계회원 현황"),array("1-3","탈퇴회원 현황"),array("1-4","회원점핑 쿠폰관리"),array("1-5","제휴회원 현황"),array("1-6","제휴회원 등록"),array("2-1","일반 스테이지 관리"),array("2-2","대기(추천) 스테이지 관리"),array("2-3","효력대기 스테이지 관리"),array("2-4","연체/부실 스테이지 관리"),array("2-5","미완성 스테이지 관리"),array("2-6","대기(취소자) 스테이지 관리"),array("2-7","나눔 스테이지 관리"),array("2-8","스테이지 약정철회 관리"),array("3-1","I-CSS 조회"),array("3-2","I-CSS 평점/한도 관리"),array("3-3","개인평점 관리"),array("3-4","IPT 설문참여자"),array("3-5","IPT 기술문"),array("3-6","NICE 신용등급 재조정"),array("4-1","회원 조회/상담"),array("4-2","회원 상담 내역"),array("5-1","스테이지 관리"),array("5-2","스테이지 약정철회 관리")); //관리자 권한 설정
*/





const arrCategoryYn=array(array("Y","<span class='badge badge-primary badge-square'>Y</span>"),array("N","<span class='badge badge-default badge-square'>N</span>")); // 카테고리 YN
const arrRegistItem=array(array("1","셀렉트박스"),array("2","라디오")); //가입정보
const arrPopupUseYn=array(array("Y","<span class='badge badge-primary badge-square'>Y</span>"),array("N","<span class='badge badge-default badge-square'>N</span>")); // 팝업사용 YN
const arrQnaYn=array(array("N","<span class='badge badge-warning badge-square width-75'>처리중</span>"),array("Y","<span class='badge badge-default badge-square width-75'>처리완료</span>")); // 문의처리 YN

//테이블
const sTableName01="tbl_company"; //관리자 테이블
const sTableName02="tbl_board_config"; //게시판 설정 테이블
const sTableName03="tbl_board"; //게시판 테이블
const sTableName04="tbl_board_file"; //게시판 파일 테이블
//폴더
const sUploadFolder01="/home/wms/upload/settings/";
const sUploadFolder02="/home/wms/upload/systems/";
const sUploadFolder03="/home/wms/upload/stage/";
const sUploadFolder04="/home/wms/upload/excel/";
const sUploadFolder05="/home/wms/upload/commonImage/";
const sUploadFolder06="/home/wms/upload/member/";
?>

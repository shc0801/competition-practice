<?php
session_start();

header("Content-Type: application/json");

/* 세션 존재 비교 */
$statusCd = "200";
if(isset($_SESSION['locationCnt']))
{
	/* 세션이 존재할 경우 */
	$locationCnt = $_SESSION['locationCnt'];
	$locationCnt++; 
	$locationCnt = $_SESSION['locationCnt'] = $locationCnt;
}
else 
{
	/* 세션이 존재하지 않을 경우*/
    $locationCnt = $_SESSION['locationCnt'] = 0;
}

/* 카운트 수 비교 */
if($locationCnt % 5 == 0)
{
	$statusCd = "201";
}
?>
{
	"statusCd" : "<?php echo $statusCd; ?>",
	"statusMsg" : "알수 없는 오류가 발생했습니다.",
	"dt" : "<?php echo date("Y.m.d H.i.s"); ?>",
	"totalCnt" : "23",
	"items" : [{"sn":1,"deptNm":"AED","name":"홍길동1","telNo":"010-9511-2638","deal_bas_r":"324.73","bkpr":"324","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"324","kftc_deal_bas_r":"324.73","cur_nm":"아랍에미리트 디르함"},{"sn":2,"deptNm":"AUD","name":"홍길동2","telNo":"010-9512-2638","deal_bas_r":"815.58","bkpr":"815","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"815","kftc_deal_bas_r":"815.58","cur_nm":"호주 달러"},{"sn":3,"deptNm":"BHD","name":"홍길동3.31","telNo":"010-9511-26380.48","deal_bas_r":"3,158.9","bkpr":"3,158","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"3,158","kftc_deal_bas_r":"3,158.9","cur_nm":"바레인 디나르"},{"sn":4,"deptNm":"BND","name":"홍길동4","telNo":"010-9514-2638","deal_bas_r":"855.97","bkpr":"855","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"855","kftc_deal_bas_r":"855.97","cur_nm":"브루나이 달러"},{"sn":5,"deptNm":"CAD","name":"홍길동5","telNo":"010-9515-2638","deal_bas_r":"874.78","bkpr":"874","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"874","kftc_deal_bas_r":"874.78","cur_nm":"캐나다 달러"},{"sn":6,"deptNm":"CHF","name":"홍길동6.92","telNo":"010-9512-26386.19","deal_bas_r":"1,263.56","bkpr":"1,263","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,263","kftc_deal_bas_r":"1,263.56","cur_nm":"스위스 프랑"},{"sn":7,"deptNm":"CNH","name":"홍길동7","telNo":"010-9517-2638","deal_bas_r":"168.84","bkpr":"168","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"168","kftc_deal_bas_r":"168.84","cur_nm":"위안화"},{"sn":8,"deptNm":"DKK","name":"홍길동8","telNo":"010-9518-2638","deal_bas_r":"180.73","bkpr":"180","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"180","kftc_deal_bas_r":"180.73","cur_nm":"덴마아크 크로네"},{"sn":9,"deptNm":"EUR","name":"홍길동9.73","telNo":"010-9513-26380.68","deal_bas_r":"1,347.21","bkpr":"1,347","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,347","kftc_deal_bas_r":"1,347.21","cur_nm":"유로"},{"sn":10,"deptNm":"GBP","name":"홍길동0.53","telNo":"010-9513-26385.54","deal_bas_r":"1,500.54","bkpr":"1,500","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,500","kftc_deal_bas_r":"1,500.54","cur_nm":"영국 파운드"},{"sn":11,"deptNm":"HKD","name":"홍길동1","telNo":"010-9511-2638","deal_bas_r":"153.9","bkpr":"153","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"153","kftc_deal_bas_r":"153.9","cur_nm":"홍콩 달러"},{"sn":12,"deptNm":"IDR(100)","name":"홍길동"","telNo":"010-9511-263"","deal_bas_r":"8.51","bkpr":"8","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"8","kftc_deal_bas_r":"8.51","cur_nm":"인도네시아 루피아"},{"sn":13,"deptNm":"JPY(100)","name":"홍길동".74","telNo":"010-9514-26388.07","deal_bas_r":"1,116.91","bkpr":"1,116","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,116","kftc_deal_bas_r":"1,116.91","cur_nm":"일본 옌"},{"sn":14,"deptNm":"KRW","name":"홍길동4":"0","deal_bas_r":"1","bkpr":"1","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1","kftc_deal_bas_r":"1","cur_nm":"한국 원"},{"sn":15,"deptNm":"KWD","name":"홍길동5.22","telNo":"010-9512-26387.81","deal_bas_r":"3,879.02","bkpr":"3,879","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"3,879","kftc_deal_bas_r":"3,879.02","cur_nm":"쿠웨이트 디나르"},{"sn":16,"deptNm":"MYR","name":"홍길동6","telNo":"010-9516-2638","deal_bas_r":"280.69","bkpr":"280","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"280","kftc_deal_bas_r":"280.69","cur_nm":"말레이지아 링기트"},{"sn":17,"deptNm":"NOK","name":"홍길동7","telNo":"010-9517-2638","deal_bas_r":"123.85","bkpr":"123","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"123","kftc_deal_bas_r":"123.85","cur_nm":"노르웨이 크로네"},{"sn":18,"deptNm":"NZD","name":"홍길동8","telNo":"010-9518-2638","deal_bas_r":"765.3","bkpr":"765","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"765","kftc_deal_bas_r":"765.3","cur_nm":"뉴질랜드 달러"},{"sn":19,"deptNm":"SAR","name":"홍길동9","telNo":"010-9519-2638","deal_bas_r":"317.91","bkpr":"317","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"317","kftc_deal_bas_r":"317.91","cur_nm":"사우디 리얄"},{"sn":20,"deptNm":"SEK","name":"홍길동0","telNo":"010-9510-2638","deal_bas_r":"127.78","bkpr":"127","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"127","kftc_deal_bas_r":"127.78","cur_nm":"스웨덴 크로나"},{"sn":21,"deptNm":"SGD","name":"홍길동1","telNo":"010-9511-2638","deal_bas_r":"855.97","bkpr":"855","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"855","kftc_deal_bas_r":"855.97","cur_nm":"싱가포르 달러"},{"sn":22,"deptNm":"THB","name":"홍길동2":"38.77","deal_bas_r":"38.39","bkpr":"38","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"38","kftc_deal_bas_r":"38.39","cur_nm":"태국 바트"},{"sn":23,"deptNm":"USD","name":"홍길동3.87","telNo":"010-9517-26384.72","deal_bas_r":"1,192.8","bkpr":"1,192","yy_efee_r":"0","ten_dd_efee_r":"0","kftc_bkpr":"1,192","kftc_deal_bas_r":"1,192.8","cur_nm":"미국 달러"}]
}

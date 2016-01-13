<?php

//���ڸ�ʽ��
function format_time($time){
	return date("Y-m-d",$time);
}

//�ж�����
function format_date($time){
	$today_begin = mktime(0,0,0);
	$today_end = $today_begin + 24*3600;
	$yesterday_begin = $today_begin - 24*3600;
	
	$list_data_part = array();
	
	if ($time < $yesterday_begin) {
		$data = 3;
	} else if ($time < $today_begin) {
		$data = 2;
	} else if ($time < $today_end) {
		$data = 1;
	}

	return $data;
	
}

//������
function rmdirr($dirname) {
    if (!file_exists($dirname)) {
        return false;
    }
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }
    $dir = dir($dirname);
    if ($dir) {
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            //�ݹ�
            rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
        }
    }
}

//��ȡ�ļ��޸�ʱ��
function getfiletime($file, $DataDir) {
    $a = filemtime($DataDir . $file);
    $time = date("Y-m-d H:i:s", $a);
    return $time;
}

//��ȡ�ļ��Ĵ�С
function getfilesize($file, $DataDir) {
    $perms = stat($DataDir . $file);
    $size = $perms['size'];
    // ��λ�Զ�ת������
    $kb = 1024;         // Kilobyte
    $mb = 1024 * $kb;   // Megabyte
    $gb = 1024 * $mb;   // Gigabyte
    $tb = 1024 * $gb;   // Terabyte

    if ($size < $kb) {
        return $size . " B";
    } else if ($size < $mb) {
        return round($size / $kb, 2) . " KB";
    } else if ($size < $gb) {
        return round($size / $mb, 2) . " MB";
    } else if ($size < $tb) {
        return round($size / $gb, 2) . " GB";
    } else {
        return round($size / $tb, 2) . " TB";
    }
}

//�ַ�����ʽ��
function this_text_show($s) {
	$s = str_replace(" ", "&nbsp;", $s);
	$s = str_replace("\r", "", $s);
	$s = str_replace("\n", "<br>", $s);
	for ($i=0; $i<5; $i++) {
		$s = str_replace("<br><br>", "<br>", $s);
	}
	$s = "<br>".$s;
	$s = preg_replace("/<br>([^>]*?\d{2}:\d{2}:\d{2})/", "<br><br><font color=blue>[\\1]</font>", $s);
	while (substr($s, 0, 4) == "<br>") {
		$s = substr($s, 4);
	}
	return $s;
}

//�����ַ�����		
function strFilter($str){
	$str = str_replace("'","", $str); //Ӣ�ĵ���
	$str = str_replace('��',"", $str); //���ĵ���
	$str = str_replace('"',"", $str); //Ӣ��˫��
	$str = str_replace('��',"", $str); //���ĵ���
	$str = str_replace('-',"", $str);//Ӣ�ļ���
	$str = str_replace('��',"", $str);//���ķֺ�
	$str = str_replace(';',"", $str);//Ӣ�ķֺ�
	return trim($str);
}

// ������:
/**
* $table_name ���ݿ����
* $table_name ���ݿ������׺	
*/
function create_table($table_name, $tab_prefix) {
	include_once dirname(__FILE__)."/function.create_table.php";
	$s = $db_tables[$table_name];
	$s = str_replace("{hid}",$tab_prefix,$s);
	
	return $s;	
}

//��ȡ�������ڵ�ʱ�����е��·�
function diffdate($date1, $date2){
    if (strtotime ( $date1 ) > strtotime ( $date2 )) 
    {
        $ymd = $date2;
        $date2 = $date1;
        $date1 = $ymd;
    }
    list ( $y1, $m1, $d1 ) = explode ( '-', $date1 );
    list ( $y2, $m2, $d2 ) = explode ( '-', $date2 );
    $math = ($y2 - $y1) * 12 + $m2 - $m1;
    $my_arr = array ();
    if ($y1 == $y2 && $m1 == $m2) 
    {
        if ($m1 < 10) 
        {
            $m1 = intval ( $m1 );
            $m1 = '0' . $m1;
        }
        if ($m2 < 10) 
        {
            $m2 = intval ( $m2 );
            $m2 = '0' . $m2;
        }
        $my_arr [] = $y1 . '_' . $m1;
        $my_arr [] = $y2 . '_' . $m2;
        return $my_arr;
    }     
    $p = $m1;
    $x = $y1;     
    for($i = 0; $i <= $math; $i ++) 
    {
        if ($p > 12) 
        {
            $x = $x + 1;
            $p = $p - 12;
            if ($p < 10) 
            {
                $p = intval ( $p );
                $p = '0' . $p;
            }
            $my_arr [] = $x . '-' . $p;
        } 
        else 
        {
            if ($p < 10) 
            {
                $p = intval ( $p );
                $p = '0' . $p;
            }
            $my_arr [] = $x . '-' . $p;
        }
        $p = $p + 1;
    }
    return $my_arr;
}












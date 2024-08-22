<?php

function set_zone()
{
    return date_default_timezone_set("Asia/Makassar");
}

// 2021-08-01
function tgl_indo($tgl)
{
    $tanggal    = substr($tgl, 8, 2);
    $bulan      = getBulan(substr($tgl, 5, 2));
    $tahun      = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function tgl_indoFull($tgl)
{
    $tanggal    = substr($tgl, 8, 2);
    $bulan      = getBulan(substr($tgl, 5, 2));
    $tahun      = substr($tgl, 0, 4);
    $waktu      = substr($tgl, 11, 9);
    return $tanggal . ' ' . $bulan . ' ' . $tahun. ' '.$waktu;
}

function getBulan($bln)
{
    switch ($bln) {
        case '01':
            return "January";
            break;
        case '02':
            return "February";
            break;
        case '03':
            return "March";
            break;
        case '04':
            return "April";
            break;
        case '05':
            return "May";
            break;
        case '06':
            return "June";
            break;
        case '07':
            return "July";
            break;
        case '08':
            return "Agust";
            break;
        case '09':
            return "September";
            break;
        case '10':
            return "October";
            break;
        case '11':
            return "November";
            break;
        case '12':
            return "December";
            break;
    }
}

function getConvertBulan($bln)
{
    switch ($bln) {
        case "January":
            return '01';
            break;
        case "February":
            return '02';
            break;
        case "March":
            return '03';
            break;
        case "April":
            return '04';
            break;
        case "May":
            return '05';
            break;
        case "June":
            return '06';
            break;
        case "July":
            return '07';
            break;
        case "August":
            return '08';
            break;
        case "September":
            return '09';
            break;
        case "October":
            return '10';
            break;
        case "November" :
            return '11';
            break;
        case "December":
            return '12';
            break;
    }
}

// Cek Total Hari Minggu
function totalMingguArray($tgl_awal, $tgl_akhir)
{
    $tgl_awal       = date_create_from_format('d-m-Y', $tgl_awal);
    $tgl_awal       = date_format($tgl_awal, 'Y-m-d');
    $tgl_awal       = strtotime($tgl_awal);

    $tgl_akhir      = date_create_from_format('d-m-Y', $tgl_akhir);
    $tgl_akhir      = date_format($tgl_akhir, 'Y-m-d');
    $tgl_akhir      = strtotime($tgl_akhir);

    $haricuti       = array();
    $minggu         = array();

    for ($i = $tgl_awal; $i <= $tgl_akhir; $i += (60 * 60 * 24)) {
        if ((date('l', $i) === 'Saturday') || (date('l', $i) === 'Sunday')) {
            $minggu[]       = $i;
        } else {
            $haricuti[]     = $i;
        }
    }

    $simpan = array();
    foreach ($minggu as $a) {
        $simpan[] = date('d-m-Y', $a);
    }

    return $minggu;
}

function hariIndo ($hariInggris) {
    switch ($hariInggris) {
        case 'Sunday':
            return 'Minggu';
        case 'Monday':
            return 'Senin';
        case 'Tuesday':
            return 'Selasa';
        case 'Wednesday':
            return 'Rabu';
        case 'Thursday':
            return 'Kamis';
        case 'Friday':
            return 'Jumat';
        case 'Saturday':
            return 'Sabtu';
        default:
            return 'hari tidak valid';
    }
}

function getDay($date){
    $convert    = gmdate($date,time()+60*60*8);
    $pecah      = explode("-",$convert);
    $tgl        = $pecah[2];
    $bln        = $pecah[1];
    $thn        = $pecah[0];
    $day        = date("l",mktime(0,0,0,$bln,$tgl,$thn));

    return $day;
}

function set_pesan($pesan, $tipe = true)
{
    $ci = get_instance();
    if ($tipe) {
        $ci->session->set_flashdata('pesan', "<div class='alert alert-success'><strong>SUCCESS!</strong> {$pesan} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    } else {
        $ci->session->set_flashdata('pesan', "<div class='alert alert-danger'><strong>ERROR!</strong> {$pesan} <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
    }
}
<?php

use App\Constants\GlobalConstant;

if (!function_exists('formatRupiah')) {
    function formatRupiah($value, $is_prefix = false)
    {
        $format = number_format($value, 0, '.', '.');
        return $is_prefix ? 'Rp ' . $format : $format;
    }
}

if (!function_exists('formatPaymentStatus')) {
    function formatPaymentStatus($value)
    {
        if ($value == GlobalConstant::WAITING) {
            return '<span class="badge badge-info">Menunggu Pembayaran</span>';
        } else if ($value == GlobalConstant::PENDING) {
            return '<span class="badge badge-warning">Menunggu Konfirmasi Pembayaran</span>';
        } else {
            return '<span class="badge badge-success">Pembayaran Berhasil</span>';
        }
    }
}

if (!function_exists('formatOrderStatus')) {
    function formatOrderStatus($value)
    {
        if ($value == GlobalConstant::PENDING) {
            return '<span class="badge badge-info">Belum Diproses</span>';
        } else if ($value == GlobalConstant::PROCESS) {
            return '<span class="badge badge-success">Proses</span>';
        } else if ($value == GlobalConstant::DONE) {
            return '<span class="badge badge-success">Selesai</span>';
        } else {
            return '<span class="badge badge-danger">Dibatalkan</span>';
        }
    }
}

if (!function_exists('formatOrderPayment')) {
    function formatOrderPayment($value)
    {
        if ($value) {
            return '<span class="badge badge-info">Cash</span>';
        } else {
            return '<span class="badge badge-warning">Transfer</span>';
        }
    }
}

if (!function_exists('paymentStatusOptions')) {
    function paymentStatusOptions()
    {
        return [
            [
                'label' => 'Menunggu Pembayaran',
                'value' => GlobalConstant::WAITING,
            ],
            [
                'label' => 'Menunggu Konfirmasi Pembayaran',
                'value' => GlobalConstant::PENDING,
            ],
            [
                'label' => 'Pembayaran Berhasil',
                'value' => GlobalConstant::PAID,
            ],
        ];
    }
}

if (!function_exists('orderStatusOptions')) {
    function orderStatusOptions()
    {
        return [
            [
                'label' => 'Belum Diproses',
                'value' => GlobalConstant::PENDING,
            ],
            [
                'label' => 'Diproses',
                'value' => GlobalConstant::PROCESS,
            ],
            [
                'label' => 'Selesai',
                'value' => GlobalConstant::DONE,
            ],
            [
                'label' => 'Dibatalkan',
                'value' => GlobalConstant::CANCELLED,
            ],
        ];
    }
}

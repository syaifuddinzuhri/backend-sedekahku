<?php

namespace App\Traits;

use App\Constants\GlobalConstant;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\URL;

trait GlobalTrait
{

    public static function datatables($request, $query)
    {
        $request->sortBy ? $sortBy = $request->sortBy : $sortBy = 'created_at';
        $request->orderBy && in_array($request->orderBy, ['asc', 'desc']) ? $orderBy = $request->orderBy : $orderBy = 'desc';
        $request->perPage ? $perPage = $request->perPage : $perPage = 10;
        $result = $query->orderBy($sortBy, $orderBy)->paginate($perPage)->appends($request->all());
        return $result;
    }

    public function getUserLoginApi()
    {
        return User::with(['province', 'city', 'subdistrict', 'village', 'supplier', 'market'])->find(auth('api')->user()->id);
    }

    public function getUserLoginWeb()
    {
        return User::with(['province', 'city', 'subdistrict', 'village'])->find(auth()->user()->id);
    }

    public function generateTransactionOrderNumber()
    {
        $timestamp = time();
        $random_number = mt_rand(100, 999);
        $order_number = 'SDK' . $timestamp . $random_number;
        return $order_number;
    }

    public function customResponse($status, $message = '', $data = [], $code = 500)
    {
        $statusCode = $status == true ? 200 : $code;
        if ($status == true) {
            return Response::json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $statusCode);
        } else {
            return Response::json([
                'status' => $status,
                'message' => $message,
            ], $statusCode);
        }
    }

    public static function customDatatable($items, $perPage = 10, $page = 1, $options = [])
    {
        $options = [
            'path' => URL::to('/') . app('request')->getRequestUri()
        ];
        $data = [];
        foreach ($items as $key => $value) {
            array_push($data, $value);
        }

        $offset = ($page * $perPage) - $perPage;
        $itemsForCurrentPage = array_slice($data, $offset, $perPage, true);
        return new LengthAwarePaginator(array_values($itemsForCurrentPage), count($data), $perPage, $page, $options);
    }

    public static function uploadImage($image, $path, $rekursif = true, $filename = "file-")
    {
        if ($image) {
            ini_set('memory_limit', '256M');
            if (!is_dir($path)) {
                mkdir($path, 0755, $rekursif);
            }
            $imageName = $filename . time() . '.' . $image->extension();
            Image::make($image)->save($path . $imageName);
            return $imageName;
        }
    }

    public static function unlinkImage($path, $imageName)
    {
        $image = $path . $imageName;
        if (file_exists($image)) {
            @unlink($image);
        }
    }

    public function phoneNumberValidation($phone)
    {
        $verifiedNumber = NULL;
        if ($phone) {
            $f = substr($phone, 0, 1);
            if ($f == "0") {
                $verifiedNumber = $phone;
                // $r = substr($phone, 1, strlen($phone));
                // $verifiedNumber = "62$r";
            } else if ($f == "+") {
                $r = substr($phone, 1, strlen($phone) - 1);
                $cc = substr($r, 0, 2);
                if ($cc == "62") {
                    $r1 = substr($phone, 3, strlen($phone) - 3);
                    $verifiedNumber = "0$r1";
                }
            } else if ($f == "6") {
                $r = substr($phone, 2, strlen($phone) - 2);
                $cc = substr($phone, 0, 2);
                if ($cc == "62") {
                    $verifiedNumber = "0$r";
                }
            } else {
                $verifiedNumber = $phone;
            }
        }
        return $verifiedNumber;
    }

    function changePhoneFormat($nomorhp)
    {
        $nomorhp = trim($nomorhp);
        $nomorhp = strip_tags($nomorhp);
        $nomorhp = str_replace(" ", "", $nomorhp);
        $nomorhp = str_replace("(", "", $nomorhp);
        $nomorhp = str_replace(".", "", $nomorhp);
        if (!preg_match('/[^+0-9]/', trim($nomorhp))) {
            if (substr(trim($nomorhp), 0, 3) == '62') {
                $nomorhp = trim($nomorhp);
            } elseif (substr($nomorhp, 0, 1) == '0') {
                $nomorhp = '62' . substr($nomorhp, 1);
            }
        }
        return $nomorhp;
    }


    public static function cekStatusBayar($status)
    {
        switch ($status) {
            case 1:
                return 'Sudah Dibayar';
                break;
            case 2:
                return 'Kadaluarsa';
                break;
            case 3:
                return 'Dibatalkan';
                break;
            default:
                return 'Belum Dibayar';
                break;
        }
    }

    public static function cekStatusPesanan($status)
    {
        switch ($status) {
            case 1:
                return 'Sedang Proses';
                break;
            case 2:
                return 'Sudah Terkirim';
                break;
            case 3:
                return 'Sudah Dikonfirmasi';
                break;
            case 4:
                return 'Dibatalkan';
                break;
            default:
                return 'Belum Diproses';
                break;
        }
    }

    public static function roleCheck($role)
    {
        switch ($role) {
            case GlobalConstant::SUPER_ADMIN:
                return 'Super Admin';
                break;
            case GlobalConstant::ADMIN:
                return 'Admin';
                break;
            case GlobalConstant::CUSTOMER:
                break;
            case GlobalConstant::SUPPLIER:
                return 'Supplier';
                break;
            default:
                return '';
                break;
        }
    }

    public static function badgeRoleCheck($role)
    {
        switch ($role) {
            case GlobalConstant::SUPER_ADMIN:
                return '<span class="badge badge-success">Super Admin</span>';
                break;
            case GlobalConstant::ADMIN:
                return '<span class="badge badge-primary">Admin</span>';
                break;
            case GlobalConstant::CUSTOMER:
                return '<span class="badge badge-warning">Customer</span>';
                break;
            case GlobalConstant::SUPPLIER:
                return '<span class="badge badge-info">Supplier</span>';
                break;
            default:
                return '';
                break;
        }
    }
}

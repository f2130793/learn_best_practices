<?php
/**
 * Created by PhpStorm.
 * User: wutao
 * Date: 2018/9/10
 * Time: 上午10:21.
 */

namespace App\Http\Controllers\BestPractices;

use App\Http\Controllers\Controller;

class singleLiabilityPrincipleController extends Controller
{
    /*Bad Practices*/
    public function getFullNameAttributeBad()
    {
        if (auth()->user() && auth()->user()->hasRole('client') && auth()->user()->isVerified()) {
            return 1;
        } else {
            return 2;
        }
    }

    /**
     * 一个类和一个方法应该只有一个职责
     * 遇到if else的情况大多可以拆出来.
     *
     * @return int
     */
    /*Good Practices*/
    public function getFullNameAttribute()
    {
        return $this->isVerfiedClient() ? $this->getFullNameLong() : $this->getFullNameShort();
    }

    public function isVerfiedClient()
    {
        return auth()->user() && auth()->user()->hasRole('client') && auth()->user()->isVerified();
    }

    public function getFullNameLong()
    {
        return 1;
    }

    public function getFullNameShort()
    {
        return 2;
    }
}

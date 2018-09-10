<?php
/**
 * Created by PhpStorm.
 * User: wutao
 * Date: 2018/9/10
 * Time: 上午10:35
 */
namespace  App\Http\Controllers\BestPractices;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Client;
use App\Client as ClientModel;

class EasyController extends Controller
{
    /**
     * @var ClientModel;
     */
    private $client;

    public function indexBad()
    {
        $client = Client::verified()
            ->with(['orders' => function ($q) {
                $q->where('created_at', '>', Carbon::today()->subWeek());
            }])
            ->get();

        return view('index', ['clients' => $client]);
    }

    /**
     * 控制器尽量简单，检验放在请求类，业务逻辑放在服务类
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index', ['clients' => $this->client->getWithNewOrders()]);
    }
}
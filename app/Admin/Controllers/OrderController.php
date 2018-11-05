<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class OrderController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('订单列表')
            ->body($this->grid());
    }



    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order);

        $grid->order_sn('订单号');
        $grid->order_sn('交易号');
        $grid->column('enterpriseCompany.enterprise_company_name','企业公司名称');
        $grid->column('product.product_name','产品服务名称');
        $grid->column('product.unit','单位')->display(function ($value){
            return Product::$unitMap[$value];
        });
        $grid->num('数量');
        $grid->money('金额');
        $grid->transaction_id('交易号');
        $grid->remark('备注');
        $grid->created_at('创建时间');
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            // 设置created_at字段的范围查询
            $filter->between('created_at', '创建时间')->date();
            $filter->equal('order_sn', '系统单号');
            $filter->equal('transaction_id', '交易号');
            $filter->where(function ($query) {
                $query->whereHas('enterpriseCompany', function ($query) {
                    $query->where('enterprise_company_name', 'like', "%{$this->input}%");
                });

            }, '企业公司名称');
        });
        $grid->disableCreateButton();
        $grid->disableExport();
        $grid->disableRowSelector();
        return $grid;
    }

}

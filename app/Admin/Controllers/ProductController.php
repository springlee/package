<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductController extends Controller
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
            ->header('产品列表')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('产品详情')
            ->body($this->detail($id));
    }


    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('新建')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->id('ID');
        $grid->product_name('产品名称');
        $grid->product_desc('产品描述');
        $grid->unit('单位')->display(function ($unit) {
            return Product::$unitMap[$unit];
        });;
        $grid->created_at('创建时间');
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableView();
        });
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            // 设置created_at字段的范围查询
            $filter->between('created_at', '创建时间')->datetime();
        });

        $grid->disableExport();
        $grid->disableRowSelector();
        return $grid;
    }

    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑')
            ->body($this->form()->edit($id));
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);
        $form->text('product_name', '产品名称')->rules('required');
        $form->text('product_desc', '产品描述')->rules('required');
        $form->select('unit', '单位')->options(Product::$unitMap);
        $form->hasMany('rules', '规则列表', function (Form\NestedForm $form) {
            $form->text('num', '数量')->rules('required|integer|min:0');
            $form->text('price', '价格（元）')->rules('required|numeric|min:0.01');
        });
        $form->tools(function (Form\Tools $tools) {

            // 去掉`删除`按钮
            $tools->disableDelete();

            // 去掉`查看`按钮
            $tools->disableView();
        });
        $form->footer(function ($footer) {

            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

        });
        return $form;
    }
}

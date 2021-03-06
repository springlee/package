<?php

namespace App\Admin\Controllers;

use App\Models\EnterpriseCompany;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class EnterpriseCompanyController extends Controller
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
            ->header('企业列表')
            ->body($this->grid());
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
            ->header('企业创建')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EnterpriseCompany);

        $grid->id('Id');
        $grid->enterprise_company_name('企业公司名称');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });
        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->between('created_at', '创建时间')->datetime();
            $filter->equal('enterprise_company_name', '企业公司名称');
        });
        $grid->disableExport();
        $grid->disableRowSelector();
        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EnterpriseCompany);
        $form->text('enterprise_company_name', '企业公司名称')->rules(function($form) {
            if ($id = $form->model()->id) {
                return 'required|unique:enterprise_companies,enterprise_company_name,'.$id.',id';
            } else {
                return 'required|unique:enterprise_companies';
            }
        });
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();

        });
        return $form;
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑')
            ->body($this->form()->edit($id));
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('详情')
            ->body($this->detail($id));
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(EnterpriseCompany::findOrFail($id));

        $show->enterprise_company_name('公司企业名称');
        $show->products('他的产品服务',function ($product) {
            $product->product_name('产品服务名称');
            $product->expiry_date('到期时间');
            $product->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableView();
                $actions->disableEdit();
            });
            $product->tools(function ($tools) {
                // 禁用批量删除按钮
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });
            $product->disableFilter();
            $product->disableExport();
            $product->disableRowSelector();
            $product->disableCreateButton();
            $product->disableRowSelector();

        });
        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });

        return $show;
    }

}

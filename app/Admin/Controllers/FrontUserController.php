<?php

namespace App\Admin\Controllers;

use App\Models\EnterpriseCompany;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class FrontUserController extends Controller
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
            ->header('企业用户列表')
            ->body($this->grid());
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

        $grid = new Grid(new User);
        $grid->model()->where('user_type', '=', User::TYPE_MANGER);
        $grid->id('ID');
        $grid->email('邮箱');
        $grid->email_verified_at('邮箱验证时间');
        $grid->column('enterpriseCompany.enterprise_company_name','企业公司名称');
        $grid->expiry_date('系统到期日');
        $states = [
            'on'  => ['value' => 'enable', 'text' => '启用', 'color' => 'primary'],
            'off' => ['value' => 'disable', 'text' => '禁用', 'color' => 'default'],
        ];
        $grid->status('状态')->switch($states);
        $grid->created_at('创建时间');

        $grid->actions(function ($actions) {
            $actions->disableDelete();
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
            $filter->between('created_at', '创建时间')->date();
            $filter->equal('email', '邮箱')->email();
            $filter->where(function ($query) {
                $query->whereHas('enterpriseCompany', function ($query) {
                    $query->where('enterprise_company_name', 'like', "%{$this->input}%");
                });

            }, '企业公司名称');
        });

        $grid->disableExport();
        $grid->disableRowSelector();

        return $grid;
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
        $show = new Show(User::findOrFail($id));

        $show->name('姓名');
        $show->email('邮箱');
        $show->email_verified_at('邮箱验证时间');
        $show->enterprise_company_id('企业公司')->as(function ($enterprise_company_id) {
            return EnterpriseCompany::find($enterprise_company_id)->enterprise_company_name;
        });
        $show->expiry_date('服务到期日期');
        $show->created_at('创建时间');

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        $form = Admin::form(User::class, function (Form $form) {


            $form->text('name', '姓名')->rules('required');
            $form->email('email', '邮箱')->rules(function($form) {
                if ($id = $form->model()->id) {
                    return 'required|email|unique:users,email,'.$id.',id';
                } else {
                    return 'required|email|unique:users';
                }
            });
            $form->password('password', '密码')->rules('required|min:6');
            $form->datetime('email_verified_at', '邮箱验证时间')->default(date('Y-m-d H:i:s'))->rules('required|date');
            $form->select('enterprise_company_id', '企业名称')
                ->options(EnterpriseCompany::all()->pluck('enterprise_company_name', 'id'))
                ->rules('required');
            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
                $tools->disableView();
            });
            $form->footer(function ($footer) {
                $footer->disableViewCheck();
                $footer->disableEditingCheck();

            });
            $form->saving(function (Form $form) {
                if ($id = $form->model()->id) {
                    $user =  User::where('enterprise_company_id', $form->input('enterprise_company_id'))
                        ->where('id','!=',$id)
                        ->where('user_type','=',User::TYPE_MANGER)
                        ->first();
                } else {
                    $user =  User::where('enterprise_company_id', $form->input('enterprise_company_id'))->first();
                }
               if($user){
                   $error = new MessageBag([
                       'title'   => '提示',
                       'message' => '改企业已经绑定过用户',
                   ]);
                   return back()->with(compact('error'));
               }
                $form->model()->user_type = User::TYPE_MANGER;
                $form->password = Hash::make( $form->password);
                if($form->input('status')){
                    $form->model()->status = $form->input('status')==='off'? User::STATUS_DISABLE:User::STATUS_ENABLE;
                }else{
                    $form->model()->status =User::STATUS_ENABLE;
                }
            });
            $form->saved(function (Form $form) {
                if($form->input('status')){
                    User::query()->where('enterprise_company_id',$form->model()->enterprise_company_id)
                        ->update([
                            'status'=> $form->input('status')==='off'? User::STATUS_DISABLE:User::STATUS_ENABLE
                        ]);
                }
                $user = User::find($form->model()->id);
                $user->assignRole('Admin');
                if(!$user->expiry_date){
                    $userService = new UserService();
                    $userService->enterpriseCompanyServiceByRegisterOrAdd($user);
                }
            });
        });

        return $form;
    }



}

<?php
namespace console\controllers;
use Yii;
use yii\console\Controller;
use common\components\rbac\UserRoleRule;
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        
        $dashboard = $auth->createPermission('dashboard');
        $dashboard->description = 'Админ панель';
        $auth->add($dashboard);
        
        $rule = new UserRoleRule();
        $auth->add($rule);
        
        $user = $auth->createRole('customer');
        $user->description = 'Покупатель';
        $user->ruleName = $rule->name;
        $auth->add($user);
        
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $admin->ruleName = $rule->name;
        $auth->add($admin);
    }
}
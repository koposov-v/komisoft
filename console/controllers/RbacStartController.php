<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacStartController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем роль "user"
        $user = $auth->createRole('user');
        $auth->add($user);

        // добавляем роль "admin"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);
    }

}
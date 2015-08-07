<?php

namespace app\controllers;
use app\models\UserGroups;
use Yii;
use app\models\Notices;
use app\models\Comments;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\Groups;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use app\models\Users;
use yii\filters\AccessControl;

class WorkspaceController extends \yii\web\Controller
{
    public $layout = 'workspace';

    private $group;
    public function beforeAction($action)
    {
        if (parent::beforeAction($action) && !empty(\Yii::$app->request->get('identifier'))){
            $this->group = Groups::find()->where(['identifier' => \Yii::$app->request->get('identifier')])->one();
            $roleId=UserGroups::find()->where(['group_id'=>$this->group->id, 'user_id' => \Yii::$app->user->getId()])->one()->role_id;
            $roleName = \Yii::$app->params['authRoles'][$roleId - 1];

            if($roleName) {
                \Yii::$app->db->createCommand('DELETE FROM auth_assignment WHERE user_id = :userId')
                    ->bindValue(':userId', \Yii::$app->user->getId())->execute();
                $auth = Yii::$app->authManager;
                $authorRole = $auth->getRole($roleName);
                $auth->assign($authorRole, \Yii::$app->user->getId());

                return true;
            }
        }
        return false;
    }

    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'actions'=>['create','update', 'delete'],
                        'roles' => ['user'],
                    ],
                    [
                        'allow' => true,
                        'actions'=>['create','update', 'delete', 'index'],
                        'roles' => ['owner'],
                    ],
                ],
            ],
        ];
    }*/

    public function actionIndex()
    {
        //var_dump(\Yii::$app->user->identity->getRole($this->group->id)->item_name);
        //var_dump(Users::findOne(\Yii::$app->user->getId())->getRole($this->group->id)->item_name);
        //die('dd');
        if (!\Yii::$app->user->isGuest && \Yii::$app->user->can('AccessGroup', ['group' => $this->group])) {

            if ($this->group) {
                $query = Notices::find()->where(['group_id' => $this->group->id])->all();
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $query,
                    'key' => 'id',

                ]);

                return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'group' => $this->group,
                ]);

            } else {
                throw new NotFoundHttpException(Yii::t('app', 'There is no group with identifier {id}', [
                    'id' => $this->group->identifier,
                ]));
            }
        } else {
            throw new ForbiddenHttpException('Access denied');
        }

    }

    public function actionView($id)
    {
        if(\Yii::$app->user->can('AccessGroup',['group'=>$this->group]))
        {
            $model_comments = new Comments();
            if ($model_comments->load(Yii::$app->request->post())) {
                if ($model_comments->save()) {
                    $this->redirect(Url::toRoute(['workspace/view', 'id' => $id, 'identifier' => $this->group->identifier]));
                }
            }
            $model_comments->notice_id = $id;

            $dataProvider = new ActiveDataProvider([
                'query' => Comments::find()->where(['notice_id' => $id]),
                'key' => 'id',
            ]);

            return $this->render('view', [
                'model_comments' => $model_comments,
                'dataProvider' => $dataProvider,
                'model' => $this->findModel($id),
                'group' => $this->group,
            ]);
        }
        else{
            throw new ForbiddenHttpException('Access denied');
        }
    }

    public function actionCreate()
    {
        if(\Yii::$app->user->can('createPost')) {

            $model = new Notices();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id, 'identifier' => $this->group->identifier]);

            } else {
                $model->group_id = $this->group->id;

                return $this->render('create', [
                    'model' => $model,
                    'group' => $this->group
                ]);
            }
        }
        else
        {
            throw new ForbiddenHttpException('Access denied');
        }
    }

    public function actionUpdate($id)
    {
        if(\Yii::$app->user->can('updateOwnPost', ['updatePost'=>$this->findModel($id)])) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id, 'identifier' => $this->group->identifier]);

            } else {

                return $this->render('update', [
                    'model' => $model,
                    'group' => $this->group,
                ]);
            }
        }
        else
        {
            throw new ForbiddenHttpException('Access denied');
        }
    }

    public function actionDelete($id)
    {
        if(\Yii::$app->user->can('deletePost')) {
            Comments::deleteAll('notice_id = :id', [':id' => $id]);
            $this->findModel($id)->delete();

            return $this->redirect(['index', 'identifier' => $this->group->identifier]);
        }
        else
        {
            throw new ForbiddenHttpException('Access denied');
        }
    }

    public function actionDeletecomment($id_comment)
    {
        $comment = Comments::findOne($id_comment);

        $notice_id = $comment->notice_id;

        $comment->delete();

        return $this->redirect(Url::toRoute(['workspace/view', 'id' => $notice_id, 'identifier' => $this->group->identifier]));
    }


    protected function findModel($id)
    {
        if (($model = Notices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

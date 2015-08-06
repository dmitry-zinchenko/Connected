<?php

namespace app\controllers;

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
/**
 * NoticeController implements the CRUD actions for Notices model.
 */
class NoticeController extends Controller
{
    /**
     * Lists all Notices models.
     * @return mixed
     */
    private $group;
    public function beforeAction($action)
    {
        if (parent::beforeAction($action) && !empty(\Yii::$app->request->get('identifier'))){
            $this->group = Groups::find()->where(['identifier' => \Yii::$app->request->get('identifier')])->one();
            return true;
        }
        return false;
    }

    public function actionIndex()
    {
        if(!\Yii::$app->user->isGuest) {
            $query = Notices::find()->where(['group_id' => $this->group->id])->all();
            $dataProvider = new ArrayDataProvider([
                'allModels' => $query,
                'key' => 'id',

            ]);

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'group' => $this->group,
            ]);
        }
        else
        {
            throw new ForbiddenHttpException('Access denied');
        }
    }

    /**
     * Displays a single Notices model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(\Yii::$app->user->can('AccessGroup',['group'=>$this->group]))
        {
            $model_comments = new Comments();
            if ($model_comments->load(Yii::$app->request->post())) {
                if ($model_comments->save()) {
                    $this->redirect(Url::toRoute(['notice/view', 'id' => $id, 'group_identifier' => $this->group->identifier]));
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

    /**
     * Creates a new Notices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(\Yii::$app->user->can('createPost')) {
            $model = new Notices();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id, 'group_identifier' => $this->group->identifier]);

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

    /**
     * Updates an existing Notices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(\Yii::$app->user->can('updateOwnPost',['updatePost'=>$this->findModel($id)])) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id, 'group_identifier' => $this->group->identifier]);

            } else {

                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else
        {
            throw new ForbiddenHttpException('Access denied');
        }
    }

    /**
     * Deletes an existing Notices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(\Yii::$app->user->can('deletePost')) {
            Comments::deleteAll('notice_id = :id', [':id' => $id]);
            $this->findModel($id)->delete();

            return $this->redirect(['index', 'group_identifier' => $this->group->identifier]);
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

        return $this->redirect(Url::toRoute(['notice/view', 'id' => $notice_id, 'group_identifier' => $this->group->identifier]));
    }

    /**
     * Finds the Notices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
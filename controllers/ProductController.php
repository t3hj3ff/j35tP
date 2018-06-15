<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Products;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Products model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Products::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('create-perm')){
          $model = new Products();

          if ($model->load(Yii::$app->request->post())) {
              $model->save(false);
              $productId=$model->id;
              $productImg = UploadedFile::getInstance($model,'product_image');
              $productImgName = 'img' . $productId . '.' . $productImg->getExtension();
              $productImg->saveAs(Yii::getAlias('@productImgDir') . '/' .$productImgName);
              $model->product_image = $productImgName;
              $model->save();
              return $this->redirect(['view', 'id' => $model->id]);
          }

          return $this->render('create', [
              'model' => $model
          ]);
        }
        else{
          throw new \yii\base\UserException(\Yii::t('app', 'You dont have permission to create a product.'));
        }

    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
      $model = $this->findModel($id);
      $user_id = Yii::$app->user->id;
      if(array_keys(\Yii::$app->authManager->getRolesByUser($user_id))[0] == 'admin' || $model->author == \Yii::$app->user->id ) {
          return $this->render('update', [
              'model' => $model,
          ]);
      }
      else{
          throw new \yii\base\UserException(\Yii::t('app', 'Either you are not the owner of the product, or you dont have enough permissions!'));
      }

    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      if(Yii::$app->user->can('delete-perm')){
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
      }
      else{
        throw new \yii\base\UserException(\Yii::t('app', 'You dont have right to view this page.'));
      }
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}

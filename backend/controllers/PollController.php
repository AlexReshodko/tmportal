<?php

namespace backend\controllers;

use Yii;
use common\models\Poll;
use common\models\PollValue;
use common\models\Model;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use common\components\BackendController;
use yii\web\NotFoundHttpException;

/**
 * PollController implements the CRUD actions for Poll model.
 */
class PollController extends BackendController
{

    /**
     * Lists all Poll models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Poll::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Poll model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Poll model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
        $modelPoll = new Poll();
        $modelsPollValue = [new PollValue];
        if ($modelPoll->load(Yii::$app->request->post())) {

            $modelsPollValue = Model::createMultiple(PollValue::classname());
            Model::loadMultiple($modelsPollValue, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsPollValue),
                    ActiveForm::validate($modelPoll)
                );
            }

            // validate all models
            $valid = $modelPoll->validate();
            $valid = Model::validateMultiple($modelsPollValue) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPoll->save(false)) {
                        foreach ($modelsPollValue as $modelPollValue) {
                            $modelPollValue->poll_id = $modelPoll->id;
                            if (! ($flag = $modelPollValue->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPoll->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelPoll' => $modelPoll,
            'modelsPollValue' => (empty($modelsPollValue)) ? [new PollValue] : $modelsPollValue
        ]);
    }

    /**
     * Updates an existing Poll model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
    public function actionUpdate($id)
    {
        $modelPoll = $this->findModel($id);
        $modelsPollValue = $modelPoll->pollValues;

        if ($modelPoll->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsPollValue, 'id', 'id');
            $modelsPollValue = Model::createMultiple(PollValue::classname(), $modelsPollValue);
            Model::loadMultiple($modelsPollValue, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPollValue, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsPollValue),
                    ActiveForm::validate($modelPoll)
                );
            }

            // validate all models
            $valid = $modelPoll->validate();
            $valid = Model::validateMultiple($modelsPollValue) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPoll->save(false)) {
                        if (! empty($deletedIDs)) {
                            PollValue::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPollValue as $modelPollValue) {
                            $modelPollValue->poll_id = $modelPoll->id;
                            if (! ($flag = $modelPollValue->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPoll->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelPoll' => $modelPoll,
            'modelsPollValue' => (empty($modelsPollValue)) ? [new PollValue] : $modelsPollValue
        ]);
    }

    /**
     * Deletes an existing Poll model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Poll model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Poll the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Poll::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

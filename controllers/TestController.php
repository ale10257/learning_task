<?php

namespace app\controllers;

use app\forms\DocumentForm;
use app\forms\ListForm;
use app\models\Document;
use app\models\DocumentList;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\Response;


class TestController extends Controller
{

    /** @var DocumentForm */
    private $documentForm;
    /** @var ListForm */
    private $listForm;
    /** @var Document */
    private $document;
    /** @var DocumentList */
    private $documentList;

    public function __construct(
        $id,
        $module,
        DocumentForm $documentForm,
        ListForm $listForm,
        Document $document,
        DocumentList $documentList
    ) {
        parent::__construct($id, $module);
        $this->documentForm = $documentForm;
        $this->listForm = $listForm;
        $this->document = $document;
        $this->documentList = $documentList;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Document::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->document->getItem($id),
        ]);
    }

    public function actionCreate()
    {
        $documentForm = $this->documentForm->getForm();
        $listForm = $this->listForm->getForm();

        $post = Yii::$app->request->post();
        if ($documentForm->load($post) && $documentForm->validate() && $listForm->load($post) && $listForm->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $document = $documentForm->saveForm();
                $listForm->saveForm($document->id);
                $transaction->commit();
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'documentForm' => $documentForm,
            'listForm' => $listForm,
        ]);
    }

    public function actionUpdate($id)
    {
        $documentForm = $this->documentForm->getForm($id);
        $listForm = $this->listForm->getForm($id);

        $post = Yii::$app->request->post();
        if ($documentForm->load($post) && $documentForm->validate() && $listForm->load($post) && $listForm->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $document = $documentForm->saveForm($id);
                $listForm->saveForm($document->id);
                $transaction->commit();
                return $this->redirect(['view', 'id' => $id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'documentForm' => $documentForm,
            'listForm' => $listForm,
        ]);
    }

    public function actionDelete($id)
    {
        $this->document->deleteItem($id);
        return $this->redirect(['index']);
    }

    public function actionCheckName()
    {
        if (Yii::$app->request->isPost && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $name = trim(Yii::$app->request->post('name'));
            $id = Yii::$app->request->post('id');
            $andWhere = $id ? ['<>', 'id', $id] : [];
            $result = [];
            if (!$name) {
                $result['error'] = 'Variable name not found!';
                return $result;
            }
            $check = $this->document::find()->where(['name' => $name])->andWhere($andWhere)->exists();
            $result = $check ? ['error' => 'Name ' . $name . ' already exist!'] : ['success' => true];
            return $result;
        }

        throw new ForbiddenHttpException();
    }
}

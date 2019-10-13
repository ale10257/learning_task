<?php


namespace app\commands;

use app\models\Article;
use yii\console\Controller;
use Faker;

class FakerArticleController extends Controller
{
    public function actionIndex()
    {
        $faker = Faker\Factory::create('ru_RU');

        for ($i = 0; $i < 100; $i++) {
            $model = new Article();
            $model->title = $faker->realText(100);
            $model->lead = $faker->realText(100);
            $model->save();
            echo $model->title . PHP_EOL;
        }
    }
}
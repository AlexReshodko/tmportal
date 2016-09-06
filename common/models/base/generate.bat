@echo off
cd ../../../
for /F "tokens=1,2" %%i in (common\models\base\models.txt) do (
	yii gii/model --tableName=%%i --modelClass=Base%%j --ns=common\models\base --messageCategory=%%j --enableI18N=1 --overwrite=1 --interactive=0
)
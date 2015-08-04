<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!\Yii::$app->user->can($action->id)) {
                throw new ForbiddenHttpException('Access denied');
    //            echo "error";
            }
            return true;
        } else {
            return false;
        }
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }
     
    public function rules()
    {
        return [
            [['username', 'password', 'first_name', 'last_name', 'email'], 'required'],
            [['username', 'email'], 'unique'],
            [['username', 'password', 'first_name', 'last_name', 'email'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'first_name' => Yii::t('app', 'Firstname'),
            'last_name' => Yii::t('app', 'Lastname'),
            'email' => Yii::t('app', 'Email'),
            'authKey' => Yii::t('app', 'authKey'),
            'accessToken' => Yii::t('app', 'accessToken')
        ];
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
    
    /*
    **
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return (Users::find()->byPk($id)) ? new static(Users::find()->byPk($id)->one()) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $users = Users::find()->asArray()->all();
       foreach ($users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
      $users = Users::find()->asArray()->all();
       foreach ($users as $user) {
            if ($user['username'] === $username) {
                return new static($user);
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
    

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstname()
    {
        return $this->first_name;
    }

    public function getLastname()
    {
        return $this->last_name;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password,$this->password);
    }
    
    public function setAuthKey($str)
    {
        $this->authKey=Yii::$app->getSecurity()->generatePasswordHash($str);
    }
    
        public function setToken($str)
    {
        $this->accessToken=Yii::$app->getSecurity()->generatePasswordHash($str);
    }

    public function setPassword($str)
    {
        $this->password = $str;
        $this->hashPassword();
    }
    
    public function hashPassword()
    {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
    }

    public function setFirstname($str)
    {
        $this->first_name=$str;
    }
    public function setLastname($str)
    {
        $this->last_name=$str;
    }

    public function setLanguage($str)
    {
        $this->language=$str;
    }
}

<?php

class UserController extends CController
{       
    public function actions()
    {
        return array(
             'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=> 0x0079AA,
                'maxLength'=> 5,
                'minLength'=> 5,
                'foreColor'=> 0xFFFFFF,
            ),
        );
    }
	
	/**
    * Displays the register page
    */
    public function actionRegister()
    {
        $model = new User();
		
        if (!Yii::app()->user->isGuest) {
            $this->redirect(array('user/feed'));
        } else {
            // Если $_POST['User'] не пустой массив - значит была отправлена форма
            // следовательно нам надо заполнить $form этими данными
             // и провести валидацию. Если валидация пройдет успешно - пользователь
            // будет зарегистрирован, не успешно - покажем ошибку на экран
            if (!empty($_POST['User'])) {
                
                 // Заполняем $form данными которые пришли с формы
                $model->attributes = $_POST['User'];
                
                // Запоминаем данные которые пользователь ввёл в капче
                 $model->verifyCode = $_POST['User']['verifyCode'];
                
                    // В validate мы передаем название сценария. Оно нам может понадобиться
                    // когда будем заниматься созданием правил валидации [читайте дальше]
                     if($model->validate('registration')) {
                        // Если валидация прошла успешно...
                        // Тогда проверяем свободен ли указанный логин..

                            if ($model->model()->count("login = :login", array(':login' => $model->login))) {
                                 // Указанный логин уже занят. Создаем ошибку и передаем в форму
                                $model->addError('login', 'Логин уже занят');
                                $this->render("registration", array('model' => $model));
                             } else {
                                // Выводим страницу что "все окей"
                                $model->save();
                                $this->render("registration_ok");
                            }
                                             
                    } else {
                        // Если введенные данные противоречат 
                        // правилам валидации (указаны в rules) тогда
                        // выводим форму и ошибки.
                         // [Внимание!] Нам ненадо передавать ошибку в отображение,
                        // Она автоматически после валидации цепляеться за 
                        // $model и будет [автоматически] показана на странице с 
                         // формой! Так что мы тут делаем простой рэндер.
                        
                        $this->render('register', array('model' => $model));
                    }
             } else {
                // Если $_POST['User'] пустой массив - значит форму некто не отправлял.
                // Это значит что пользователь просто вошел на страницу регистрации
                // и ему мы должны просто показать форму.
                 
                $this->render('register', array('model' => $model));
            }
        }
    }
    
    /**
	* Displays the login page
	*/
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array('user/feed'));
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirects to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    
    /**
    * Displays the feed page
    */
	public function actionFeed ()
	{
		$this->render('feed');
	}
	
	/**
    * Displays the courses page
    */
	public function actionCourses ()
	{
		$model=new Course;
		$this->render('courses',array('model'=>$model));
	}
	
	/**
    * Displays the settings page
    */
	public function actionSettings ()
	{
		$model=new User;
		$this->render('settings',array('model'=>$model));
	}
    
} 
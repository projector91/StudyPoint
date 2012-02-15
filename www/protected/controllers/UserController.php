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
            // ���� $_POST['User'] �� ������ ������ - ������ ���� ���������� �����
            // ������������� ��� ���� ��������� $form ����� �������
             // � �������� ���������. ���� ��������� ������� ������� - ������������
            // ����� ���������������, �� ������� - ������� ������ �� �����
            if (!empty($_POST['User'])) {
                
                 // ��������� $form ������� ������� ������ � �����
                $model->attributes = $_POST['User'];
                
                // ���������� ������ ������� ������������ ��� � �����
                 $model->verifyCode = $_POST['User']['verifyCode'];
                
                    // � validate �� �������� �������� ��������. ��� ��� ����� ������������
                    // ����� ����� ���������� ��������� ������ ��������� [������� ������]
                     if($model->validate('registration')) {
                        // ���� ��������� ������ �������...
                        // ����� ��������� �������� �� ��������� �����..

                            if ($model->model()->count("login = :login", array(':login' => $model->login))) {
                                 // ��������� ����� ��� �����. ������� ������ � �������� � �����
                                $model->addError('login', '����� ��� �����');
                                $this->render("registration", array('model' => $model));
                             } else {
                                // ������� �������� ��� "��� ����"
                                $model->save();
                                $this->render("registration_ok");
                            }
                                             
                    } else {
                        // ���� ��������� ������ ������������ 
                        // �������� ��������� (������� � rules) �����
                        // ������� ����� � ������.
                         // [��������!] ��� ������ ���������� ������ � �����������,
                        // ��� ������������� ����� ��������� ���������� �� 
                        // $model � ����� [�������������] �������� �� �������� � 
                         // ������! ��� ��� �� ��� ������ ������� ������.
                        
                        $this->render('register', array('model' => $model));
                    }
             } else {
                // ���� $_POST['User'] ������ ������ - ������ ����� ����� �� ���������.
                // ��� ������ ��� ������������ ������ ����� �� �������� �����������
                // � ��� �� ������ ������ �������� �����.
                 
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
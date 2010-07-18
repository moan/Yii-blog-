<?php
/**
 * PostController class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2009 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */


/**
 * PostController controls the CRUD operations for posts.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: PostController.php 64 2010-02-01 05:36:52Z mocapapa@g.pugpug.org $
 */

Yii::import('application.vendors.*');
require_once('Zend/Feed.php');
require_once('Zend/Feed/Rss.php');

class PostController extends CController
{
	/**
	 * @var string specifies the default action to be 'list'.
	 */
	public $defaultAction='list';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_post;

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image
			// this is used by the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xF5F5F5,
			),
		);
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'list' and 'show' actions
				'actions'=>array('list','show','captcha','PostedInMonth','PostedOnDate','Feed'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to perform any action
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Shows a particular post.
	 */
	public function actionShow()
	{
		$post=$this->loadPost();
		$comment=$this->newComment($post);
		$this->render('show',array(
			'post'=>$post,
			'comments'=>$post->comments,
			'newComment'=>$comment,
		));
	}

	/**
	 * Creates a new post.
	 * If creation is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionCreate()
	{
		$post=new Post;
		if(isset($_POST['Post']))
		{
			$post->attributes=$_POST['Post'];
			if(isset($_POST['previewPost']))
				$post->validate();
			else if(isset($_POST['submitPost']) && $post->save())
				$this->redirect(array('show','id'=>$post->id));
		}
		$this->render('create',array('post'=>$post));
	}

	/**
	 * Updates a particular post.
	 * If update is successful, the browser will be redirected to the 'show' page.
	 */
	public function actionUpdate()
	{
		$post=$this->loadPost();
		if(isset($_POST['Post']))
		{
			$post->attributes=$_POST['Post'];
			if(isset($_POST['previewPost']))
				$post->validate();
			else if(isset($_POST['submitPost']) && $post->save())
				$this->redirect(array('show','id'=>$post->id));
		}
		$this->render('update',array('post'=>$post));
	}

	/**
	 * Deletes a particular post.
	 * If deletion is successful, the browser will be redirected to the 'list' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadPost()->delete();
			$this->redirect(array('list'));
		}
		else
			throw new CHttpException(500,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all posts.
	 */
	public function actionList()
	{
		$criteria=new CDbCriteria;
		$criteria->condition='status='.Post::STATUS_PUBLISHED;
		$criteria->order='createTime DESC';
		$withOption=array('author');
		if(!empty($_GET['tag']))
		{
			$withOption['tagFilter']['params'][':tag']=$_GET['tag'];
			$postCount=Post::model()->with($withOption)->count($criteria);
		}
		else
			$postCount=Post::model()->count($criteria);

		$pages=new CPagination($postCount);
		$pages->pageSize=Yii::app()->params['postsPerPage'];
		$pages->applyLimit($criteria);

		$posts=Post::model()->with($withOption)->findAll($criteria);
		$this->render('list',array(
			'posts'=>$posts,
			'pages'=>$pages,
		));
	}

        /**
         * Sitewide search.
         * Shows a particular post searched.
         */
        public function actionSearch()
        {
	        $criteria=new CDbCriteria;
		$criteria->condition='status='.Post::STATUS_PUBLISHED;
		$criteria->order='createTime DESC';
		$search=new SiteSearchForm;
		
		if(isset($_POST['SiteSearchForm'])) {
		        $search->attributes=$_POST['SiteSearchForm'];
			$_GET['searchString'] = $search->string;
		} else {
	 	        $search->string=$_GET['searchString'];
		}

		$criteria->condition .=' AND content LIKE :keyword';
		$criteria->params=array(':keyword'=>'%'.$search->string.'%');
		
		$postCount=Post::model()->count($criteria);
		$pages=new CPagination($postCount);
		$pages->pageSize=Yii::app()->params['postsPerPage'];
		$pages->applyLimit($criteria);
		
		$posts=Post::model()->findAll($criteria);
		
		$this->render('found',array(
					   'posts'=>$posts,
					   'pages'=>$pages,
					   'search'=>$search,
					   ));

        }

	/**
	 * Manages all posts.
	 */
	public function actionAdmin()
	{
		$criteria=new CDbCriteria;

		$pages=new CPagination(Post::model()->count());
		$pages->applyLimit($criteria);

		$sort=new CSort('Post');
		$sort->defaultOrder='status ASC, createTime DESC';
		$sort->applyOrder($criteria);

		$posts=Post::model()->findAll($criteria);

		$this->render('admin',array(
			'posts'=>$posts,
			'pages'=>$pages,
			'sort'=>$sort,
		));
	}

	/**
	 * Generates the hyperlinks for post tags.
	 * This is mainly used by the view that displays a post.
	 * @param Post the post instance
	 * @return string the hyperlinks for the post tags
	 */
	public function getTagLinks($post)
	{
		$links=array();
		foreach($post->getTagArray() as $tag)
			$links[]=CHtml::link(CHtml::encode($tag),array('list','tag'=>$tag));
		return implode(', ',$links);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	protected function loadPost($id=null)
	{
		if($this->_post===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_post=Post::model()->findByPk($id!==null ? $id : $_GET['id']);
			if($this->_post===null || Yii::app()->user->isGuest && $this->_post->status!=Post::STATUS_PUBLISHED)
				throw new CHttpException(500,'The requested post does not exist.');
		}
		return $this->_post;
	}

	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Post the post that the new comment belongs to
	 * @return Comment the comment instance
	 */
	protected function newComment($post)
	{
		$comment=new Comment;
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			$comment->postId=$post->id;
			if(Yii::app()->params['commentNeedApproval'])
				$comment->status=Comment::STATUS_PENDING;
			else
				$comment->status=Comment::STATUS_APPROVED;

			if(isset($_POST['previewComment']))
				$comment->validate('insert');
			else if(isset($_POST['submitComment']) && $comment->save())
			{
				if($comment->status==Comment::STATUS_PENDING)
				{
					Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
					$this->refresh();
				}
				else
					$this->redirect(array('show','id'=>$post->id,'#'=>'c'.$comment->id));
			}
		}
		return $comment;
	}

	/**
         * Collect posts issued on specific date
         */
        public function actionPostedOnDate()
        {
          $criteria=new CDbCriteria;
          $criteria->condition='status='.Post::STATUS_PUBLISHED;
          $criteria->order='createTime DESC';

          $criteria->condition.=' AND createTime > :time1 AND createTime < :time2';
          $month = date('n', $_GET['time']);
          $date = date('j', $_GET['time']);
          $year = date('Y', $_GET['time']);
          $criteria->params[':time1']= $theDay = mktime(0,0,0,$month,$date,$year);
          $criteria->params[':time2']= mktime(0,0,0,$month,$date+1,$year);

          $pages=new CPagination(Post::model()->count($criteria));
          $pages->pageSize=Yii::app()->params['postsPerPage'];
          $pages->applyLimit($criteria);

          $posts=Post::model()->with('author')->findAll($criteria);

          $this->render('date',array(
                                     'posts'=>$posts,
                                     'pages'=>$pages,
                                     'theDay'=>$theDay,
                                     ));
        }

        /**
         * Collect posts issued in specific month
         */
        public function actionPostedInMonth()
        {
          $criteria=new CDbCriteria;
          $criteria->condition='status='.Post::STATUS_PUBLISHED;
          $criteria->order='createTime DESC';

          $criteria->condition.=' AND createTime > :time1 AND createTime < :time2';
          $month = date('n', $_GET['time']);
          $year = date('Y', $_GET['time']);
          if ($_GET['pnc'] == 'n') $month++;
          if ($_GET['pnc'] == 'p') $month--;
          $criteria->params[':time1']= $firstDay = mktime(0,0,0,$month,1,$year);
          $criteria->params[':time2']= mktime(0,0,0,$month+1,1,$year);

          $pages=new CPagination(Post::model()->count($criteria));
          $pages->pageSize=Yii::app()->params['postsPerPage'];
          $pages->applyLimit($criteria);

          $posts=Post::model()->with('author')->findAll($criteria);

          $this->render('month',array(
                                      'posts'=>$posts,
                                      'pages'=>$pages,
                                      'firstDay'=> $firstDay,
                                      ));


        }

        /**
         * Feed (from the cookbook 20)
         */
	public function actionFeed()
	{
		$req = new CHttpRequest;
		// retrieve the latest posts
		$posts=Post::model()->findAll(array(
			'order'=>'createTime DESC',
			'limit'=> Yii::app()->params['postsPerFeedCount'],
		));
		// convert to the format needed by Zend_Feed
		$entries=array();
		foreach($posts as $post)
		{
			$entries[]=array(
				'title'=>CHtml::encode($post->title),
				'link'=>CHtml::encode($req->getHostInfo().$this->createUrl('post/show',array('id'=>$post->id))),
				'description'=>$post->content,
				'lastUpdate'=>$post->createTime,
			);
		}
		// generate and render RSS feed
		$feed=Zend_Feed::importArray(array(
			'title'   => 'My Post Feed',
			'link'    => $this->createUrl(''),
			'charset' => 'UTF-8',
			'entries' => $entries,      
		), 'rss');
		$feed->send();
	}
}

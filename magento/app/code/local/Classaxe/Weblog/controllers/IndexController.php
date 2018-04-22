<?php
/**
 * Created by PhpStorm.
 * User: mfrancis
 * Date: 2018-04-21
 * Time: 15:32
 */
class Classaxe_Weblog_IndexController extends Mage_Core_Controller_Front_Action {
    public function testModelAction() {
        $params = $this->getRequest()->getParams();
        $blogpost = Mage::getModel('weblog/blogpost');
        echo("Loading the blogpost with an ID of ".$params['id']);
        $blogpost->load($params['id']);
        $blogpost->setBlogpostId('15');
        $blogpost->unsBlogpostId();
        $data = $blogpost->getData();
        var_dump($data);
        var_dump($blogpost->getOrigData());
    }

    public function createNewPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->setTitle('Code Post!');
        $blogpost->setPost('This post was created from code!');
        $blogpost->save();
        echo 'post with ID ' . $blogpost->getId() . ' created';
    }

    public function editFirstPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->load(1);
        $blogpost->setTitle("The First post - edited!");
        $blogpost->save();
        echo 'post edited';
    }

    public function deleteFirstPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->load(1);
        $blogpost->delete();
        echo 'post removed';
    }

    public function showAllBlogPostsAction() {
        $posts = Mage::getModel('weblog/blogpost')->getCollection();
        foreach($posts as $blog_post){
            echo '<h3>'.$blog_post->getTitle().'</h3>';
            echo nl2br($blog_post->getPost());
        }
    }
}
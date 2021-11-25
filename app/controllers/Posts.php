<?php 

class Posts extends Controller{

    public function __construct(){
        if(!isLogin()){
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        
    }

    public function index(){
        // Get posts
        $posts = $this->postModel->getPosts();
        $data=[
            'posts'=>$posts
        ];
        $this->view('posts/index',$data);
    }

    public function add(){
        // Check if POST or GET request
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process the form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'title_error'=>'',
                'body_error'=>'',
            ];

            // Validate title
            if(empty($data['title'])){
                $data['title_error'] = 'title is require';

            }else{
                if(strlen($data['title']) < 2){
                    $data['title_error'] = 'Title must be at lest 2 letters';
                }
            }

            // Validate body
            if(empty($data['body'])){
                $data['body_error'] = 'body of the post is require';

            }else{
                if(strlen($data['body']) < 2){
                    $data['body_error'] = 'The post must be at lest 2 letters';
                }
            }

            // Make sure there are no errors
            if(empty($data['title_error']) && empty($data['body_error'])){
                $data['user_id'] = $_SESSION['user_id'];
                if($this->postModel->addPost($data)){
                    flash('Add_post','Your post submitted successfully!');
                    redirect('posts');

                }else{
                    die('Something went wrong');
                }

            }else{
                // Load the view with errors
                $this->view('posts/add', $data);
            }


        }else{
            // Init data
            $data=[
                'title'=>'',
                'body'=>'',
                'title_error'=>'',
                'body_error'=>''
            ];
            // Load view
            $this->view('posts/add',$data);

        }
        
    }

    public function show($id){
        $post=$this->postModel->getPostById($id);
        $user=$this->userModel->getUserById($post->user_id);
        $data =[
            'post'=>$post,
            'user'=>$user
        ];
        $this->view('posts/show',$data);
            

        
    }

    public function edit($id){
        // Check if POST or GET request
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process the form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'id'=>$id,
                'title'=>trim($_POST['title']),
                'body'=>trim($_POST['body']),
                'title_error'=>'',
                'body_error'=>'',
            ];

            // Validate title
            if(empty($data['title'])){
                $data['title_error'] = 'title is require';

            }else{
                if(strlen($data['title']) < 2){
                    $data['title_error'] = 'Title must be at lest 2 letters';
                }
            }

            // Validate body
            if(empty($data['body'])){
                $data['body_error'] = 'body of the post is require';

            }else{
                if(strlen($data['body']) < 2){
                    $data['body_error'] = 'The post must be at lest 2 letters';
                }
            }

            // Make sure there are no errors
            if(empty($data['title_error']) && empty($data['body_error'])){
                if($this->postModel->updatePost($data)){
                    flash('Edit_post','Your post was edited successfully!');
                    redirect('posts/show/'.$id);

                }else{
                    die('Something went wrong');
                }

            }else{
                // Load the view with errors
                $this->view('posts/edit', $data);
            }


        }else{
            // Get the post from database
            $post = $this->postModel->getPostById($id);

            // Check the post's owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }

            // Init data
            $data=[
                'id'=>$id,
                'title'=>$post->title,
                'body'=>$post->body,
                'title_error'=>'',
                'body_error'=>''
            ];
            // Load view
            $this->view('posts/edit',$data);

        }
        
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get the post from database
            $post = $this->postModel->getPostById($id);

            // Check the post's owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            if($this->postModel->deletePost($id)){
                flash('remove_post','Your post removed');
                redirect('posts');
            }else{
                die('Something went wrong');
            }
            $data=[];
            $this->view('posts/delete',$data);

        }else{
            redirect('posts');
        }
        

    }
}

?>
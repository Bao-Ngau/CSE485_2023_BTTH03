<?php
require_once ("./vendor/autoload.php");
require_once("./services/AuthorService.php");

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use MyApp\Services\CategoryService;
class AuthorController{
    private $loader;
    private $twig;
    public function __construct(){
        $this->loader = new FilesystemLoader('./views/author');
        $this->twig = new Environment($this->loader);
    }
    public function index(){
        $authors = AuthorService::getAll();
        echo $this->twig->render('index.twig',[
            'authors' => $authors
        ]);
    }
    public function edit(){
        $ma_tgia = $ten_tgia = '';
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $ma_tgia = $_GET['ma_tgia'];
            $ten_tgia = $_GET['ten_tgia'];
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $txtMa_tgia = $_POST['txtMa_tgia'];
            $txtTen_tgia = $_POST['txtTen_tgia'];
            $txtHinh_tgia = $_POST['txtHinh_tgia'];
            if(isset($_POST['edit'])){
                AuthorService::update($txtMa_tgia,$txtTen_tgia,$txtHinh_tgia);
                echo "<script>window.location.href = 'index.php?controller=author'</script>";
            }
        }
        echo $this->twig->render('edit.twig',[
            'ma_tgia' => $ma_tgia,
            'ten_tgia' => $ten_tgia
        ]);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ten_tgia = $_POST['ten_tgia'];
            $hinh_tgia = $_POST['hinh_tgia'];

            if(isset($_POST['add'])){
                AuthorService::add('',$ten_tgia,$hinh_tgia);
                echo "<script>window.location.href = 'index.php?controller=author'</script>";
            }
        }
        echo $this->twig->render('add.twig');
    }
    public function delete(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $ma_tgia = $_GET['ma_tgia'];

            $authorSV = AuthorService::getById($ma_tgia);
            $author = new Author($authorSV['ma_tgia'],$authorSV['ten_tgia'],$authorSV['hinh_tgia']);
            if($_GET['action'] == 'delete'){
                AuthorService::delete($author);
                echo "<script>window.location.href = 'index.php?controller=author'</script>";
            }
        }
    }

}
?>
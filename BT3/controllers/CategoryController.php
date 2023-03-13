<?php

require_once ("./vendor/autoload.php");
require_once("./services/CategoryService.php");



use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use MyApp\Services\CategoryService;
class CategoryController {
    private $loader;
    private $twig;
    public function __construct(){
        $this->loader = new FilesystemLoader('./views/category');
        $this->twig = new Environment($this->loader);
    }
    public function index(){
        $categorys = CategoryServices::getAll();
        
        echo $this->twig->render('index.twig',[
            'categorys' => $categorys
        ]);
    }
    
    public function edit(){
        $ma_tloai = $ten_tloai = '';
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $ma_tloai = $_GET['ma_tloai'];
            $ten_tloai = $_GET['ten_tloai'];
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $txtMa_tloai = $_POST['txtMa_tloai'];
            $txtTen_tloai = $_POST['txtTen_tloai'];
            if(isset($_POST['edit'])){
                CategoryServices::Update($txtMa_tloai,$txtTen_tloai);
                echo "<script>window.location.href = 'index.php?controller=category';</script>";
            }
        }
        echo $this->twig->render('edit.twig',[
            'ma_tloai' => $ma_tloai,
            'ten_tloai' => $ten_tloai,
        ]);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $txtTen_tloai = $_POST['txtTen_tloai'];
            if(isset($_POST['add'])){
                CategoryServices::Add('',$txtTen_tloai);
                echo "<script>window.location.href = 'index.php?controller=category';</script>";
            }
        }
        echo $this->twig->render('add.twig');
    }
    public function delete(){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if($_GET['action'] == 'delete'&& isset($_GET['ma_tloai'])){
                $ma_tloai = $_GET['ma_tloai'];
                $category = CategoryServices::getById($ma_tloai);
                if(is_array($category)){
                    $ca = new Category($category['ma_tloai'], $category['ten_tloai']);
                    CategoryServices::Delete($ca);
                    echo "<script>window.location.href = 'index.php?controller=category';</script>";
                }
            }
        }
    }
}
?>
<?php
require_once 'vendor/autoload.php';
require_once './config/config.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('views');
$twig = new Environment($loader);

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $stmt = $db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
            if($stmt->execute([$name, $email])){
                echo "<script>
                    alert('thêm thành công');
                    window.location.href = 'index.php';
                </script>";
            }else{
                echo "<script>
                    alert('thêm thất bại');
                </script>";
            };
            exit;
        }
        echo $twig->render('add.twig',[
            "title"=> "Thêm user",
        ]);
        break;
    case 'edit':
        $id = $_GET['id'];
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $stmt = $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            if($stmt->execute([$name, $email, $id])){
                echo "<script>
                    alert('Xửa thành công');
                    window.location.href = 'index.php';
                </script>";
            }else{
                echo "<script>
                    alert('Xửa thất bại');
                </script>";
            };
            exit;
        }
        echo $twig->render('edit.twig', ['user' => $user,'id' => $id]);
        break;
    case 'delete':
        $id = $_GET['id'];
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        if($stmt->execute([$id])){
            echo "<script>
                alert('Xóa thành công');
                window.location.href = 'index.php';
            </script>";
        }else{
            echo "<script>
                alert('Xóa thất bại');
            </script>";
        };
        break;
    default:
        $stmt = $db->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $twig->render('index.twig', ['users' => $users]);
        break;
}
?>
<?php
require_once('./config/DBConnection.php');
class Article {
    private $ma_bviet,$tieude,$ten_bhat,$ma_tloai,$tomtat,$noidung,$ma_tgia,$ngayviet,$hinhanh;
    public function __construct($ma_bviet,$tieude,$ten_bhat,$ma_tloai,$tomtat,$noidung,$ma_tgia,$ngayviet,$hinhanh){
        $this->ma_bviet = $ma_bviet;
        $this->tieude = $tieude;
        $this->ten_bhat = $ten_bhat;
        $this->ma_tloai = $ma_tloai;
        $this->tomtat = $tomtat;
        $this->noidung = $noidung;
        $this->ma_tgia = $ma_tgia;
        $this->ngayviet = $ngayviet;
        $this->hinhanh = $hinhanh;
    }

    //set
    public function setMa_bviet($ma_bviet){
        $this->ma_bviet = $ma_bviet;
    }
    public function setTieude($tieude){
        $this->tieude = $tieude;
    }
    public function setTen_bhat($ten_bhat){
        $this->ten_bhat = $ten_bhat;
    }
    public function setMa_tloai($ma_tloai){
        $this->ma_tloai = $ma_tloai;
    }
    public function setTomtat($tomtat){
        $this->tomtat = $tomtat;
    }
    public function setNoidung($noidung){
        $this->noidung = $noidung;
    }
    public function setMa_tgia($ma_tgia){
        $this->ma_tgia = $ma_tgia;
    }
    public function setNgayviet($ngayviet){
        $this->ngayviet = $ngayviet;
    }
    public function setHinhanh($hinhanh){
        $this->hinhanh = $hinhanh;
    }
    //get
    public function getMa_bviet(){
        return $this->ma_bviet;
    }
    public function getTieude(){
        return $this->tieude;
    }
    public function getTen_bhat(){
        return $this->ten_bhat;
    }
    public function getMa_tloai(){
        return $this->ma_tloai;
    }
    public function getTomtat(){
        return $this->tomtat;
    }
    public function getNoidung(){
        return $this->noidung;
    }
    public function getMa_tgia(){
        return $this->ma_tgia;
    }
    public function getNgayviet(){
        return $this->ngayviet;
    }
    public function getHinhanh(){
        return $this->hinhanh;
    }

    public function add(){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        
        $sql = "INSERT INTO baiviet(ma_bviet,tieude,ten_bhat,ma_tloai,tomtat,noidung,ma_tgia,ngayviet,hinhanh) 
        VALUE(?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            $this->ma_bviet,
            $this->tieude,
            $this->ten_bhat,
            $this->ma_tloai,
            $this->tomtat,
            $this->noidung,
            $this->ma_tgia,
            $this->ngayviet,
            $this->hinhanh]);
    }
    public function update(){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();

        $sql = "UPDATE baiviet SET tieude=?,ten_bhat=?,ma_tloai=?,tomtat=?,noidung=?,ma_tgia=?,ngayviet=?,hinhanh=? WHERE ma_bviet=?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$this->tieude, $this->ten_bhat, $this->ma_tloai, $this->tomtat, $this->noidung, $this->ma_tgia, $this->ngayviet, $this->hinhanh, $this->ma_bviet]);
    }
    public function delete(){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        
        $sql = "DELETE FROM baiviet WHERE ma_bviet =?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$this->ma_bviet]);
    }
    public static function getById($ma_bviet){
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "SELECT * FROM baiviet WHERE ma_bviet = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$ma_bviet]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function getAll(){
        $dbconn = new DBConnection();
        $conn = $dbconn->getConnection();

        $sql = "SELECT * FROM baiviet";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
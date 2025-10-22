<?php
class User
{
    public $idUser;
    public $email;
    public $fullName;
    public $phone;
    public $role;
    public $urlAvatar;
    public $created;
    public $updated;

    private $connect; // Lưu kết nối database

    public function __construct($connect, $config_id_user)
    {
        $this->connect = $connect; // Lưu kết nối để dùng cho các method
        $result = $connect->query("SELECT * FROM users WHERE id_user = '$config_id_user'");
        $data = $result->fetch_assoc();

        if ($data) {
            $this->idUser = $data['id_user'];
            $this->email = $data['email'];
            $this->fullName = $data['full_name'];
            $this->phone = $data['phone'];
            $this->role = $data['role'];
            $this->urlAvatar = $data['avatar'];
            $this->created = $data['created_at'];
            $this->updated = $data['updated_at'];
        }
    }
}

class Address
{
    public $idAddress;
    public $idUser;
    public $label;
    public $name;
    public $phone;
    public $province;
    public $district;
    public $ward;
    public $street;
    public $created;

    private $connect; // Lưu kết nối database

    public function __construct($connect, $config_id_user)
    {
        $this->connect = $connect; // Lưu kết nối để dùng cho các method
        $result = $connect->query("select * from addresses where id_user = '$config_id_user'");
        $data = $result->fetch_assoc();
        $this->idAddress = $data['id_address'] ?? '';
        $this->idUser = $data['id_user'] ?? '';
        $this->label = $data['label'] ?? '';
        $this->name = $data['recipient_name'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->province = $data['province'] ?? '';
        $this->district = $data['district'] ?? '';
        $this->ward = $data['ward'] ?? '';
        $this->street = $data['street'] ?? '';
        $this->created = $data['created_at'] ?? '';
    }
}

class Product
{
    public $idProduct;
    public $idCate;
    public $name;
    public $image;
    public $material;
    public $color;
    public $size;
    public $quantity;
    public $shortDescription;
    public $description;
    public $basePrice;
    public $sellPrice;
    public $created;
    public $updated;

    public function __construct($connect, $id_product)
    {
        $query = "SELECT * FROM products WHERE id_product = $id_product LIMIT 1";
        $result = $connect->query($query);
        $data = $result->fetch_assoc();
        if ($data) {
            $this->idProduct = $data['id_product'];
            $this->idCate = $data['id_cate'];
            $this->name = $data['name'];
            $this->image = $data['image'];
            $this->material = $data['material'];
            $this->color = $data['color'];
            $this->size = $data['size'];
            $this->quantity = $data['quantity'];
            $this->shortDescription = $data['short_description'];
            $this->description = $data['description'];
            $this->basePrice = $data['base_price'];
            $this->sellPrice = $data['sell_price'];
            $this->created = $data['created'];
            $this->updated = $data['updated'];
        }
    }
}

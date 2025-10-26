<?php
class User
{
    private $idUser;
    private $email;
    private $password;
    private $fullName;
    private $phone;
    private $role;
    private $urlAvatar;
    private $created;
    private $updated;

    private $connect;

    // Constructor mặc định (không tham số)
    public function __constructDefault()
    {
        $this->idUser = '';
        $this->email = '';
        $this->password = '';
        $this->fullName = '';
        $this->phone = '';
        $this->role = '';
        $this->urlAvatar = '';
        $this->created = '';
        $this->updated = '';
    }

    // Constructor có tham số (load dữ liệu từ DB)
    public function __construct($connect = null, $config_id_user = null)
    {
        if ($connect && $config_id_user) {
            $this->connect = $connect;
            $result = $connect->query("SELECT * FROM users WHERE id_user = '$config_id_user'");
            $data = $result->fetch_assoc();

            if ($data) {
                $this->idUser = $data['id_user'];
                $this->email = $data['email'];
                $this->password = $data['password_hash'];
                $this->fullName = $data['full_name'];
                $this->phone = $data['phone'];
                $this->role = $data['role'];
                $this->urlAvatar = $data['avatar'];
                $this->created = $data['created_at'];
                $this->updated = $data['updated_at'];
            }
        } else {
            $this->__constructDefault();
        }
    }

    // Getters
    public function getIdUser()
    {
        return $this->idUser;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getFullName()
    {
        return $this->fullName;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getRole()
    {
        return $this->role;
    }
    public function getUrlAvatar()
    {
        return $this->urlAvatar;
    }
    public function getCreated()
    {
        return $this->created;
    }
    public function getUpdated()
    {
        return $this->updated;
    }
}

class Address
{
    private $idAddress;
    private $idUser;
    private $label;
    private $name;
    private $phone;
    private $province;
    private $district;
    private $ward;
    private $street;
    private $created;

    private $connect;

    // Constructor mặc định
    public function __constructDefault()
    {
        $this->idAddress = '';
        $this->idUser = '';
        $this->label = '';
        $this->name = '';
        $this->phone = '';
        $this->province = '';
        $this->district = '';
        $this->ward = '';
        $this->street = '';
        $this->created = '';
    }

    // Constructor có tham số
    public function __construct($connect = null, $config_id_user = null)
    {
        if ($connect && $config_id_user) {
            $this->connect = $connect;
            $result = $connect->query("SELECT * FROM addresses WHERE id_user = '$config_id_user'");
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
        } else {
            $this->__constructDefault();
        }
    }

    // Getters
    public function getIdAddress()
    {
        return $this->idAddress;
    }
    public function getIdUser()
    {
        return $this->idUser;
    }
    public function getLabel()
    {
        return $this->label;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getProvince()
    {
        return $this->province;
    }
    public function getDistrict()
    {
        return $this->district;
    }
    public function getWard()
    {
        return $this->ward;
    }
    public function getStreet()
    {
        return $this->street;
    }
    public function getCreated()
    {
        return $this->created;
    }
}

class Product
{
    private $idProduct;
    private $idCate;
    private $name;
    private $image;
    private $material;
    private $color;
    private $size;
    private $quantity;
    private $shortDescription;
    private $description;
    private $basePrice;
    private $sellPrice;
    private $created;
    private $updated;

    // Constructor mặc định
    public function __constructDefault()
    {
        $this->idProduct = '';
        $this->idCate = '';
        $this->name = '';
        $this->image = '';
        $this->material = '';
        $this->color = '';
        $this->size = '';
        $this->quantity = '';
        $this->shortDescription = '';
        $this->description = '';
        $this->basePrice = '';
        $this->sellPrice = '';
        $this->created = '';
        $this->updated = '';
    }

    // Constructor có tham số
    public function __construct($connect = null, $id_product = null)
    {
        if ($connect && $id_product) {
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
                $this->created = $data['created_at'];
                $this->updated = $data['updated_at'];
            }
        } else {
            $this->__constructDefault();
        }
    }

    // Getters
    public function getIdProduct()
    {
        return $this->idProduct;
    }
    public function getIdCate()
    {
        return $this->idCate;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getMaterial()
    {
        return $this->material;
    }
    public function getColor()
    {
        return $this->color;
    }
    public function getSize()
    {
        return $this->size;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function getShortDescription()
    {
        return $this->shortDescription;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getBasePrice()
    {
        return $this->basePrice;
    }
    public function getSellPrice()
    {
        return $this->sellPrice;
    }
    public function getCreated()
    {
        return $this->created;
    }
    public function getUpdated()
    {
        return $this->updated;
    }
}

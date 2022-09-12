<?php
namespace App\Services;

// https://github.com/sanderjongsma/mageFaker

class FakerEcommerceProvider extends \Faker\Provider\Base
{
    protected static $fashionNames = array(
        "French Cuff Cotton Twill Oxford","Slim fit Dobby Oxford Shirt","Plaid Cotton Shirt","Sullivan Sport Coat","Linen Blazer","Stretch Cotton Blazer","Chelsea Tee",
        "Merino V-neck Pullover Sweater","Lexington Cardigan Sweater","Core Striped Sport Shirt","Bowery Chino Pants","The Essential Boot Cut Jean","Flat Front Trouser",
        "NoLIta Cami","Black NoLIta Cami","Tori Tank","Delancy Cardigan Sweater","Ludlow Oxford Top","Elizabeth Knit Top","Essex Pencil Skirt","Racer Back Maxi Dress","Sheath",
        "Convertible Dress","Park Avenue Pleat Front Trousers","Aviator Sunglasses","Jackie O Round Sunglasses","Retro Chic Eyeglasses","Barclay d'Orsay pump, Nude","Ann Ankle Boot",
        "Hana Flat, Charcoal","Dorian Perforated Oxford","Wingtip Cognac Oxford","Suede Loafer, Navy","Isla Crossbody Handbag","Florentine Satchel Handbag","Flatiron Tablet Sleeve",
        "Broad St. Flapover Briefcase","Houston Travel Wallet","Roller Suitcase","Classic Hardshell Suitcase","Classic Hardshell Suitcase","Body Wash with Lemon Flower Extract and Aloe Vera",
        "Bath Minerals and Salt","Shea Enfused Hydrating Body Lotion","Titian Raw Silk Pillow","Shay Printed Pillow","Carnegie Alpaca Throw","Park Row Throw","Gramercy Throw","Herald Glass Vase",
        "Modern Murray Ceramic Vase","Stone Salt and Pepper Shakers","Fragrance Diffuser Reeds","Geometric Candle Holders","Ludlow Sheath Dress","Lafayette Convertible Dress","TriBeCa Skinny Jean",
        "DUMBO Boyfriend Jean","Classic Hardshell Suitcase","Luggage Set","Vase Set","Olvidalo by Brownout","Alice in Wonderland","Khaki Bowery Chino Pants","Core Striped Sport Shirt-Indigo",
        "Classic Hardshell Suitcase","Pearl Strand Necklace","Blue Horizons Bracelets","Pearl Stud Earrings","Swing Time Earrings","Silver Desert Necklace","Swiss Movement Sports Watch",
        "Pearl Necklace Set","Around the World in 80 Days","Thomas Overcoat","Draper Suit Coat","Lincoln Blazer","Bushwick Skinny Jean","Draper Pant","Olive Bushwick Skinny Jean","Avery Oxford Shirt",
        "Slim-fit Dobby Oxford Shirt","Carroll Check Dress Shirt","Clark Dress Shirt","Striped Crew Tee","Oatmeal Henley Tee","Henley Tee","Villa Bermuda Shorts","Cornelia Skirt","Grand Slim Straight Jean",
        "Hester Ankle Pant","Angela Wrap Dress","Jane Dress","Jacqueline Medallion Dress","Ludlow Seersucker Top","Gans Trench Coat","Sheri Collar Shirt","Charcoal Sheri Collar Shirt","Milli Cardigan",
        "Stretch Cotton Camisole","Noa Sheer Blouse","Brooklyn Jean Jacket","Mercer Loafer","Broad St Saddle Shoes","Empire Oxford","Lenox Boot","Studio Dress Shoe","Carnegie Sneaker","Hudson Snakeskin Pump",
        "Prima Pump","Plaza Platform","Annie Pump","Broadway Pump","Ellis Flat","Yuca Sneaker","Black Nolita Cami","NoLIta Cami-Pink","Black Nolita Cami-Black"
    );
    
    protected static $fashionCategories = array(
        "Women","Tops & Blouses","Pants & Denim","Dresses & Skirts","Men","Shirts","Tees, Knits and Polos","Pants & Denim","Blazers","Accessories","Eyewear","Jewelry","Shoes","Bags & Luggage","Home & Decor",
        "Books & Music","Bed & Bath","Electronics","Decorative Accents","Sale","Women","Men","Accessories","Home & Decor","VIP"
    );
    
    // product
    public function productName(){
        return static::randomElement(static::$fashionNames);
    }
    
    public function productImage(){
        return 'media/mageFaker/product/' . $this->numberBetween(1, 29) . '.jpg';
    }
    
    public function price(){
        return (int) $this->numberBetween(1, 999) . '.' . $this->numberBetween(10,99);
    }
    
    public function sku(){
        return uniqid();
    }
    
    public function weight(){
        return (int) $this->numberBetween(1, 999) . '.0000';
    }
    
    public function shortDescription(){
        return $this->generator->paragraph(8);
    }
    
    public function description(){
        $paragraph = '';
        for($i = 0; $i < 4; $i++){
            $paragraph .= '<p>' . $this->generator->paragraph(8) . '</p>';
        }
        return $paragraph;
    }
    
    public function metaKeys(){
        $words = $this->generator->words(4);
        return implode(', ', $words);
    }
    
    public function metaDescription(){
        return $this->generator->paragraph(4);
    }
    
    // category
    public function categoryName(){
        return static::randomElement(static::$fashionCategories);
    }
    
    public function categoryImage(){
        return '../../../media/mageFaker/category/' . $this->numberBetween(1, 14) . '.jpg';
    }
    
    public function categoryUrl($name){
        return $name . '-' . uniqid();
    }
}
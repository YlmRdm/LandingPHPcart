<?php
/**
 * @package Cart class
 *
 * @author Yalim Erdem
 *
 * @email  yalim.erdem@gmail.com
 *
 */

include("DBConnection.php");
class Cart
{

    protected $db;
    private $_sku;

    public function setSKU($sku) {
        $this->_sku = $sku;
    }

    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }

    // getAll Product
    public function getAllProduct() {
    	try {
    		$sql = "SELECT * FROM products";
		    $stmt = $this->db->prepare($sql);

		    $stmt->execute();
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }

    // get Student
    public function getProduct() {
    	try {
    		$sql = "SELECT * FROM products WHERE sku=:sku";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'sku' => $this->_sku
			];
		    $stmt->execute($data);
		    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }

}
?>

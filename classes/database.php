<?
    class Database{
        protected $db_host;
        protected $db_name;
        protected $db_user;
        protected $db_pass;

        public function __construct($host, $name, $user, $pass){
            $this->db_host = $host;
            $this->db_name = $name;
            $this->db_user = $user;
            $this->db_pass = $pass;
        }

        //Phương thức kết nối CSDL.
        public function getConn(){
            //tạo Datasource name
            $dsn = "mysql:host={$this->db_host}; dbname={$this->db_name}; charset=utf8";
            try {
                //Luồng đi
                $conn = new PDO($dsn, $this->db_user, $this->db_pass); //Xin 1 kết nối
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;

            } catch (PDOException $e) {
                //Phạt đi
                echo $e->getMessage();
                exit;
            }
        }
    }
?>
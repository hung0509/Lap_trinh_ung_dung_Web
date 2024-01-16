<?

    class Book{
        private $id;
        private $title;
        private $description;
        private $author;
        private $imagefile;

        public function __construct($title, $description, $author, $imagefile){
            $this->title = $title;
            $this->description = $description;
            $this->author = $author;
            $this->imagefile = $imagefile;
        }

        private function validate(){
            //Bắt buộc phải có
            return $this->title && $this->description && $this->author && $this->imagefile;
        }


        //Thêm sách (C)
        public function addBook($conn){
            if($this->validate()){
                $sql = "insert into books(title, description, author, imagefile) values 
                (:title, :description, :author, :imagefile);";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
                $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
                $stmt->bindValue(':author', $this->author, PDO::PARAM_STR);
                $stmt->bindValue(':imagefile', $this->imagefile, PDO::PARAM_STR);

                return $stmt->execute();
            }else{
                return false;
            } 
        }

        // Đọc sách(R)
        public function getAll($conn){
            try{
                $sql = "select * from books;";
                $stmt = $conn->prepare($sql);
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book'); //Xet 1 đổi tượng
                $stmt->execute(); // Thực hiện câu lệnh sql
                $books = $stmt->fetch();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function getByID($conn, $id){
            try{
                $sql = "select * from books where id=:id;";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Book'); //Trả về 1 đổi tượng
                $stmt->execute(); // Thực hiện câu lệnh sql
                $books = $stmt->fetch();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        //Update(U)
        public function update($conn){

        }

        //Delete
        public function delete($conn){

        }

        public function deleteByID($conn, $id){

        }

        public function updateImage($conn, $id, $imagefile){

        }
    }
?>
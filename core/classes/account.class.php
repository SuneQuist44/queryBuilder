<?php 
    class account extends connect {
        public function addname() {
            if (isset($_POST['name-submit'])) {
                global $db;
                
                $name = $_POST['name'];
                
                $content =  [
                    array('insert', ['into', 'values'], [''], 'account', ['name'], [$name]),
                ];
                
                $db->dispatch($content);
            }
        }

        public function getname() {
            global $db;

            $content =  [
                array('select', ['from', 'where'], ['id', '135'], 'account', ['name'], ['']),
            ];
            
            $this->stmt = $db->dispatch($content);

            $row = $this->stmt->fetch();
            echo $row['name'];
        }

        public function updatename() {
            if (isset($_POST['update-submit'])) {
                global $db;
                
                $update = $_POST['update'];
                
                $content =  [
                    array('update', ['set', 'where'], ['id', '135'], 'account', ['name'], [$update]),
                ];
                
                $db->dispatch($content);
            }
        }

        public function deletename() {
            if (isset($_POST['delete-submit'])) {
                global $db;                
                
                $content =  [
                    array('delete', ['from', 'where'], ['id', '137'], 'account', [''], ['']),
                ];
                
                $db->dispatch($content);
            }
        }
    }
?>
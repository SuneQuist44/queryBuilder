<?php 
    class connect extends tokens {

        protected $pdo;
        protected $stmt;

        public function __construct() {
            // PDO Attributes
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                // Data Source Name (DSN)
                $dsn = 'mysql:host='.$this->dbhost . 
                ';dbname='.$this->dbname . 
                ';port='.$this->dbport . 
                ';charset='.$this->dbchar;

                // Set PDO
                $this->pdo = new PDO($dsn, $this->dbroot, $this->dbpwd, $options);
            } catch (PDOException $e) { print $e->getMessage(); } // Handle errors
        }

        // Dispatch content to database
        public function dispatch($content) {

            // How to setup content.
            // $content = [
                //array(type, [primary keys], [secondary keys], database, [value], [input]),
                //array(type, [primary keys], [secondary keys], database, [value], [input]),
            //];

            // Get each value in content
            if (is_array($content)) {
                foreach($content as list($type, $pKey, $sKey, $database, $input, $value)) { // Value
    
                    $valueSeperated = implode("', '", $value);
                    $inputSeperated = implode("', '", $input);
    
                    $arr = array();
                    for($i = 0; $i < count($input); $i++) {
                        array_push($arr, $input[$i] .' = \''. $value[$i] . '\'');
                        $update = join(" ? ", $arr);
                    }
                    
                    // Get all pKey
                    foreach($pKey as $k) {
                        // Swtich operator
                        switch(strtoupper($type)) {
                            default:
                            case 'INSERT':
                                $sql = "$type $pKey[0] $database($inputSeperated) $pKey[1]('$valueSeperated')";
                                break;
                            case 'SELECT':
                                $sql = "$type $inputSeperated $pKey[0] $database $pKey[1] $sKey[0] = '$sKey[1]'";
                                break;
                            case 'UPDATE':
                                $sql = "$type $database $pKey[0] $update $pKey[1] $sKey[0] = $sKey[1]";
                                break;
                            case 'DELETE':
                                $sql = "$type $pkey[0] $database $pkey[1] $skey[0] = $skey[1]";
                                break;
                            };
                    }
                        
                    $this->stmt = $this->pdo->prepare($sql); // Prepare state
                    $this->stmt->execute();
    
                    return $this->stmt;
                }
            } else {
                return null;
            }
        }
    }
?>
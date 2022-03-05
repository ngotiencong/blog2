<?php
    class upload{
        function __construct()
        {
            
        }
        static function uploadImage($img,$url){
            if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            {
                $error =  "Phải Post dữ liệu";
                die;
            }
            if (!isset($_FILES[$img]))
            {
                $error = "Dữ liệu không đúng cấu trúc";
                die;
            }
            if ($_FILES[$img]['error'] != 0){
            $error = "Dữ liệu upload bị lỗi";
              die;
            }
            $target_dir    = "uploads/".$url;
            $imageFileType = pathinfo(basename($_FILES[$img]["name"]),PATHINFO_EXTENSION);
            $file_name =  md5(time()).".".$imageFileType;
            $target_file   = $target_dir .$file_name ;
            $allowUpload   = true;
            $maxfilesize   = 5000000;
            $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
            $error = "";
          
          
            if(isset($_POST["submit"])) {
                //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
                $check = getimagesize($_FILES[$img]["tmp_name"]);
                if($check !== false)
                {
                    $allowUpload = true;
                }
                else
                {
                    $error =  "Không phải file ảnh.";
                    $allowUpload = false;
                }
            }
            if ($_FILES[$img]["size"] > $maxfilesize)
            {
                $error = "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
                $allowUpload = false;
            }
          
            // Kiểm tra kiểu file
            if (!in_array($imageFileType,$allowtypes ))
            {
              $error = "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
                $allowUpload = false;
            }
          
          
            if ($allowUpload)
            {
                // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
                if (move_uploaded_file($_FILES[$img]["tmp_name"], $target_file))
                {
                  return array('status' => true, 'file' => $file_name);
                }
                else
                {
                    $error = "Có lỗi xảy ra khi upload file.";
                }
            }
            else
            {
                $error = "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
            }
            return array('status' => false, 'error' => $error);
          }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <style type="text/css">
        #nav{
            background-color: blue;
            height: 50px;
            color: white;
        }
    </style>
    <body>
        <?php include 'db_connect.php' ?>
        <img src="imgLOGO.jpg" alt="Beatles" style="width:auto;">
        <div>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"><center>Send SMS</center></h3>
                    </div>

                    <div class="modal-body">
                        <!-- General Form Elements -->
                        <form action="" method="post">
                            <?php
                            //this line of code isfor select option to for dropdown the user
                            $fetch_con = $connect->query("SELECT * FROM contact") or die($connect->error());
                            $fetch_con2 = $connect->query("SELECT * FROM message") or die($connect->error());
                            ?>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Masking <label style="color: red;">*</label></label>
                                <div class="col-sm-9">
                                    <select name="masking" class="form-control" aria-label=" select "  required/>
                                    <option selected disabled>-Select-</option>
                                    <?php while ($contact = $fetch_con->fetch_assoc()): ?>
                                        <option> <?php echo $contact['phone'] ?></option>
                                    <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                            <div class="row mb-3">
                                <label for="text" class="col-sm-3 col-form-label">Mobile Number<label style="color: red;">*</label></label>
                                <div class="col-sm-9">
                                <input type="tel" id="fnumber" class="form-control" name="number" placeholder="Enter Your Number"><br><br>
                                </div>
                            </div>
                            <!-- <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Message Body<label style="color: red;">*</label></label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="message" class="form-control" style="height: 100px" placeholder="start typing..."></textarea>
                                </div>
                            </div> -->

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Template <label style="color: red;">*</label></label>
                                <div class="col-sm-9">
                                    <select name="message" class="form-control" aria-label=" select "  required/>
                                    <option selected disabled>-Select-</option>
                                    <?php while ($message = $fetch_con2->fetch_assoc()): ?>
                                        <option> <?php echo $message['Message'] ?></option>
                                    <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Message Body<label style="color: red;">*</label></label>
                                <div class="col-sm-9">
                                    <textarea type="text" name="sms" class="form-control" style="height: 100px" placeholder="start typing..."></textarea>
                                </div>
                               
                                </div>
                            </div>

                         </div>
                    <div class="modal-footer">
                        <button id="confirm" class="btn btn-primary btn-sm" name="send">Send</button>
                    </div>
                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST['send'])) {
            $masking = $_POST['masking'];
            $number = $_POST['number'];
            $msg = $_POST['message'];
            
            $masking = str_replace(" ","%20",$masking);
            $msg = str_replace("\\n","%0A",$msg);
            $msg = str_replace(" ","%20",$msg);

        


            $ch = curl_init( "https://api.boom-cast.com/boomcast/WebFramework/boomCastWebService/OTPMessage.php?masking=".$masking."&userName=orion&password=cddffa4f9f8e75167355f48d13dced2f&MsgType=TEXT&receiver=".$number."&message=".$msg."");

            $res=curl_exec($ch);
           
            curl_close($ch);
            $data=json_decode($res);
            var_dump($data);    
            }
    
        ?>

    </body>
    <script src="bootstrap.min.js"></script>
</html>
<?php
    session_start();
    require_once 'dbconnection.php';

    $sql = 'SELECT * FROM `ticket record` WHERE `account`=:account';
    $sth = $pdo->prepare($sql);
    $sth->bindParam(":account",$_SESSION['id']);
    $sth->execute();
    $ticketHistory = $sth->fetchAll();
?>

<!DOCTYPE html>
<html lang="zh-TW">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content />
        <meta name="author" content />
        <title>CCU 高鐵接駁車票預約系統-登入</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/pineapple.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- jQuery -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css" type="text/css"/>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column">
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container px-5">
                    <a class="navbar-brand" href="index.php">CCU 高鐵接駁車票預約系統</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="index.php">首頁</a></li>
                            <li class="nav-item"><a class="nav-link" href="searching.php">查詢</a></li>
                            <?php echo '<li class="nav-item"><a class="nav-link" href="userhome.php">你好,'.$_SESSION['name'].'</a></li>';?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <section class=" py-5">
                <div class="container px-5 my-5">
                    <div class="text-center mb-5">
                        <h1 class="fw-bolder">已預定班次如下</h1>    
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <table id="HistoryTable" class="display table table-light">
                            <thead>
                                <tr>
                                    <th>班次</th>
                                    <th>日期/時間</th>
                                    <th>下單時間</th>
                                    <th>價格</th>
                                    <th>付款狀態</th>
                                    <th>是否退票</th>
                                    <th>車票</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php 
                                    foreach($ticketHistory as $his){
                                        echo "<tr class='table-light'>";
                                        echo "<td class='table-light'>".$his['bus number']."</td>";
                                        echo "<td class='table-light'>".$his['bus date']."/".date('H:i',strtotime($his['bus time'])) ."</td>";
                                        echo "<td class='table-light'>".$his['timestamp']."</td>";
                                        echo "<td class='table-light'>".$his['price']."</td>";
                                        if($his['state']==1) echo "<td class='table-light'>已付款</td>";
                                        else echo "<td class='table-light'>未付款</td>";
                                        if($his['refunded']==1) echo "<td class='table-light'>已退票</td>";
                                        else echo "<td class='table-light'>無</td>";
                                        echo  '<td class="table-light"><a href="ticketvisualize/dist/e_ticket.php?serial='.$his['serial'].'">車票</a>';
                                        echo "</tr>";
                                    }
                    
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; Your Website 2022</div></div>
                    <div class="col-auto">
                        <a class="link-light small" href="">Privacy</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Terms</a>
                        <span class="text-white mx-1">&middot;</span>
                        <a class="link-light small" href="#!">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <!-- <script src="js/scripts.js"></script> -->
        <!-- jQuery -->
    <script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" ></script>
    </body>
</html>

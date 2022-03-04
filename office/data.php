<script type="text/javascript">
$(function () {
    <?php
    function purchases($month, $c){
        include 'heart/heart.php';
        $db = mysqli_connect('localhost', $database_user, $database_password, $database_name);
        $de = $db->query("SELECT ((`selling_price` * `product_quantity`) - `discount`) AS `count` FROM `sales` WHERE `company_id` = '$c' AND `nguvai` LIKE '$month%'");
        $dv = mysqli_fetch_array($de);
        echo $dv['count'];

    }
    function airtime($month, $c){
        include 'heart/heart.php';
        $db = mysqli_connect('localhost', $database_user, $database_password, $database_name);
        $de = $db->query("SELECT COUNT(`id`) AS `count` FROM `texcha` WHERE `company_id` = '$c' AND `nguvai` LIKE '$month%' AND `type`='AIRTIME'");
        $dv = mysqli_fetch_array($de);
        echo $dv['count'];
    }
    function transfer($month, $c){
        include 'heart/heart.php';
        $db = mysqli_connect('localhost', $database_user, $database_password, $database_name);
        $de = $db->query("SELECT COUNT(`id`) AS `count` FROM `texcha` WHERE `company_id` = '$c' AND `nguvai` LIKE '$month%' AND `type`like '%TRANSFER%'");
        $dv = mysqli_fetch_array($de);
        echo $dv['count'];
    }

    ?>
var lineData = {
    labels: [<?php
                $dfg = 12;
                while ($dfg>=0) {
                    echo "'".date('F', strtotime('last day of ' . -$dfg . 'month'))."',";
                    $dfg--;
                }
                ?>
            ],
    datasets: [

        {
            label: "Cash In/Payments",
            backgroundColor: 'rgba(26,179,148,0.5)',
            borderColor: "rgba(26,179,148,0.7)",
            pointBackgroundColor: "rgba(26,179,148,1)",
            pointBorderColor: "#fff",
            data: [
                <?php
                // $dfg = 12;
                // while ($dfg>=0) {
                //     echo "'";
                //     cash_in(backs('Y-m', 'last day of ' . -$dfg . 'month'), $company_id);
                //     echo "',";
                //     $dfg--;
                // }

                 ?>

        ]
        },
        {
            label: "Transfer",
            backgroundColor: 'rgba(220, 220, 220, 0.5)',
            pointBorderColor: "#fff",
            data: [
                <?php
                // $dfg = 12;
                // while ($dfg>=0) {
                //     echo "'";
                //     transfer(backs('Y-m', 'last day of ' . -$dfg . 'month'), $company_id);
                //     echo "',";
                //     $dfg--;
                // }

                 ?>
            ]
        }
    ]
};

var lineOptions = {
    responsive: true
};


var ctx = document.getElementById("lineChart").getContext("2d");
new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

var barData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "Data 1",
            backgroundColor: 'rgba(220, 220, 220, 0.5)',
            pointBorderColor: "#fff",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "Data 2",
            backgroundColor: 'rgba(26,179,148,0.5)',
            borderColor: "rgba(26,179,148,0.7)",
            pointBackgroundColor: "rgba(26,179,148,1)",
            pointBorderColor: "#fff",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};

var barOptions = {
    responsive: true
};


var ctx2 = document.getElementById("barChart").getContext("2d");
new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});

var polarData = {
    datasets: [{
        data: [
            300,140,200
        ],
        backgroundColor: [
            "#a3e1d4", "#dedede", "#b5b8cf"
        ],
        label: [
            "My Radar chart"
        ]
    }],
    labels: [
        "App","Software","Laptop"
    ]
};

var polarOptions = {
    segmentStrokeWidth: 2,
    responsive: true

};

var ctx3 = document.getElementById("polarChart").getContext("2d");
new Chart(ctx3, {type: 'polarArea', data: polarData, options:polarOptions});

var doughnutData = {
    labels: ["App","Software","Laptop" ],
    datasets: [{
        data: [300,50,100],
        backgroundColor: ["#a3e1d4","#dedede","#b5b8cf"]
    }]
} ;


var doughnutOptions = {
    responsive: true
};


var ctx4 = document.getElementById("doughnutChart").getContext("2d");
new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});


var radarData = {
    labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
    datasets: [
        {
            label: "My First dataset",
            backgroundColor: "rgba(220,220,220,0.2)",
            borderColor: "rgba(220,220,220,1)",
            data: [65, 59, 90, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            backgroundColor: "rgba(26,179,148,0.2)",
            borderColor: "rgba(26,179,148,1)",
            data: [28, 48, 40, 19, 96, 27, 100]
        }
    ]
};

var radarOptions = {
    responsive: true
};

var ctx5 = document.getElementById("radarChart").getContext("2d");
new Chart(ctx5, {type: 'radar', data: radarData, options:radarOptions});

});
</script>

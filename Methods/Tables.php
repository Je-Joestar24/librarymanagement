<?php
function tablize($heads, $query, $classes = "", $include = "", $datas1 = "")
{
    include($include);
    $datas = array();
    $query = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($query)) {
        if ($datas === "") {
            array_push($datas, array_values($row));
        } else {
            array_push($datas, $row);
        }
    }

    if ($datas1 !== "") {
        $datas1 = explode(", ", $datas1);
    }
    $table = "<table class='{$classes}'><thead><tr>";
    foreach ($heads as $head) $table .= "<th>{$head}</th>";
    $table .= "<th>Action</th></tr></thead><tbody>";
    foreach ($datas as $data) {
        $table .= "<tr>";
        if ($datas1 === "") foreach ($data as $dt) $table .= "<td>{$dt}</td>";
        else foreach ($datas1 as $dt){ 
            $table .= "<td class = 'px-2'>" . $data[$dt] . "</td>";
        }
        $table .= "<td><button class = 'btn btn-sm btn-dark mx-2'>Edit</button><button class = 'mx-2 btn btn-sm btn-danger'>Delete</></td></tr>";
    }
    $table .= "</tbody></table>";
    echo $table;
}

function modalCreation($inputs,$modalID, $placeholders, $Title)
{
    $modal = "<div class='modal fade' id='".$modalID."' tabindex='-1'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'>
                <h5 class= 'modal-title'>{$Title}</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button></div>
            <form class = 'text-center' action = 'AllTables.php' method = 'post'>
            <div class='modal-body'>";
    for($i = 0; $i < count($placeholders); $i ++) {
        $modal .= "<input class = 'form-control' type='text' name = '" . $inputs[$i] . "' placeholder = '" . $placeholders[$i] . "'><br>";
    }
    $modal .= "
    </div>
    <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <input type='submit' name = 'sbmt' class='btn btn-primary' value = 'Save'>
    </div>
    </form>
</div>
</div>
</div>";
echo $modal;
}


function canvasCreation($inputs, $placeholders, $buttons, $Title)
{
}
?>

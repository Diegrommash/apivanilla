<?php


function query($sql){
    $query = $pdo->query($sql);
    $query->ejecute();

    while($item = $pdo->fetchObject()){
        yield $item;
    }

}


foreach(query("SELECT * FROM tabla") as $item){
    echo "<li>{$item->valor}</li>";
}
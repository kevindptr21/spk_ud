<? 
$nav = array ( 
    ['title' => 'Home','icon'=> 'outline_home_black_18dp.png','href' => 'auth'],
    ['title' => 'Manajemen Karyawan','icon'=> 'outline_people_alt_black_18dp.png','href' => 'karyawan'],
    ['title' => 'Manajemen Pekerjaan','icon'=> 'outline_work_outline_black_18dp.png','href' => 'pekerjaan'],
    ['title' => 'Manajemen Kriteria','icon'=> 'outline_text_snippet_black_18dp.png','href' => '-'],
    ['title' => 'Penilaian Karyawan','icon'=> 'outline_calculate_black_18dp.png','href' => '-'],
);
?>
<div class="logo">
    <img src="<?php base_url() ?>assets/images/logoUD.jpg" class="img-logo" />
</div>
<div class="menu bg-secondary">
    <div class="list-menu ">
        <? echo '<ul class="list-group">';
        foreach($nav as $v) {
            echo '<a href="'.$v['href'].'">';
            if($_SERVER["REQUEST_URI"] === "/".$v["href"]){
                echo '<li class="list-group-item" style="background:#adff2f">';
            }else {
                echo '<li class="list-group-item">';
            }
            echo '
                <div class="row">
                    <div class="col-4 align-self-center"><img src="assets/icons/'.$v['icon'].'"/></div>
                    <div class="col text-dark nav-title">'.$v['title'].'</div>
                </div>
            </li></a>';

        }
        echo '</ul>';
        ?>
    </div>
</div>
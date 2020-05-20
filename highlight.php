<?php

$abc = array("А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы", "Ь", "Э", "Ю", "Я");

# гласные
$vowel = array("А", "Е", "Ё", "И", "О", "У", "Ы", "Э", "Ю", "Я");
$vowel_close = array("И", "Ы", "У", "Ю"); # верхние
$vowel_mid = array("Е", "Э", "О", "Ё"); # средние
$vowel_open = array("А", "Я"); # нижние

# согласные

$consonant = array("Б", "В", "Г", "Д", "Ж", "З", "Й", "К", "Л", "М", "Н", "П", "Р", "С", "Т", "Ф", "Х", "Ц", "Ч", "Ш", "Щ");

$consonant_modal = array("Б", "В", "Г", "Д", "Ж", "З", "Й", "Л", "М", "Н", "Р");
$consonant_voiceless = array("К", "П", "С", "Т", "Ф", "Х", "Ц", "Ч", "Ш", "Щ");

$consonant_noisy = array("Б", "П", "Д", "Т", "К", "Г", "Ф", "В", "С", "З", "Х", "Ш", "Ж", "Щ", "Ц", "Ч");

$consonant_plosive = array("Б", "П", "Д", "Т", "К", "Г");
$consonant_fricative = array("Ф", "В", "С", "З", "Х", "Ш", "Ж", "Щ");
$consonant_affricate = array("Ц", "Ч");

$consonant_sonant = array("М", "Н", "Л", "Й", "Р");

#другое

$aphonic = ["Ь", "Ъ"];
$punc = [" "];

# получение текста

$poem = $_POST['hi_text'];

$showtags = htmlentities($poem);

$lines = preg_split('<br /> ', $showtags);

$nested_lines = array();

foreach($lines as $key => $line) {
  $line = mb_strtoupper($line);
  $line = mb_str_split($line);
  array_push($nested_lines,$line);
}

$highlight1 = array();
$highlight2 = array();
$highlight3 = array();

$highlighted = "";


if ( ($_POST['hi']) == "vow" ) {
  $highlight1 = $vowel_close;
  $highlight2 = $vowel_mid;
  $highlight3 = $vowel_open;
} elseif ( ($_POST['hi']) == "con_voice" ) {
  $highlight1 = $consonant_modal;
  $highlight2 = $consonant_voiceless;
} elseif ( ($_POST['hi']) == "con_type" ) {
  $highlight1 = $consonant_noisy;
  $highlight2 = $consonant_sonant;
} elseif ( ($_POST['hi']) == "con_noisy" ) {
  $highlight1 = $consonant_plosive;
  $highlight2 = $consonant_affricate;
  $highlight3 = $consonant_fricative;
} elseif ( ($_POST['hi']) == "one_char" ) {
  array_push($highlight1, $_POST['char_select']);

}



foreach ($nested_lines as $lk => $lv) {
  foreach ($lv as $ck => $cv) {
    if ( in_array($cv, $highlight1 ) ) {
      $highlighted .= "<span class=\"hi1\">$cv</span>" ;
    }
    elseif ( in_array($cv, $highlight2) ) {
      $highlighted .= "<span class=\"hi2\">$cv</span>" ;
    }
    elseif ( in_array($cv, $highlight3) ) {
      $highlighted .= "<span class=\"hi3\">$cv</span>" ;
    }
    elseif ( in_array($cv, $abc) ) {
      $highlighted .= "$cv" ;
    }
    elseif ( in_array($cv, $punc) ) {
      $highlighted .= "$cv" ;
    }
    else {
      continue;
    }

  }
  $highlighted .= "<br />" ;
}


?>

<!DOCTYPE html>
<html>

<head>

<title>Поэтическая функция</title>

<link rel="shortcut icon" href="_/f.png" />

<link href="https://fonts.googleapis.com/css2?family=PT+Mono&display=swap" rel="stylesheet">

<style>

.hi1 {
  background-color: LIGHTGREEN ;
}

.hi2 {
  background-color: gold ;

}

.hi3 {
  background-color: VIOLET;
;

}

h3, h4 {
  margin: 45px 0px 20px 0px;
}

.mono {
  letter-spacing: 0.01em;
  word-spacing: 0.3em;
  font-size: 1.3em;
}

</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



</head>

<body>



  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="index.php">
      <img src="_/logo.svg" height="30" class="d-inline-block align-top" alt="p(f)">
      Поэтическая функция
    </a>
    <ul class="navbar-nav mr-auto">
          <li class="nav-item">
          </li>
    </ul>
  </nav>

<div class="container-md" style="max-width: 1024px">


  <div class="card" style="width: 100%; margin: 40px 0px">
    <div class="card-body">
  <!--    <h5 class="card-title">Анализируемый текст</h5>
      <p class="card-text">
        <?php
        print($poem)
        ?>
      </p> -->
      <button type="button" class="btn btn-primary" onclick="history.go(-1);">Вернуться к статистике</button>
      <button type="button" class="btn btn-link" href="index.php">Перейти к форме ввода</button>

    </div>
  </div>

<h3>Подсветка</h3>

<p>
<b>Критерий: </b>
<?php
if ( ! isset($_POST['hi']) ) {
  echo 'Не был выбран либо некорректен.';
} elseif ( ($_POST['hi']) == "vow" ) {
  echo 'Гласные: верхний, средний, нижний подъем';
} elseif ( ($_POST['hi']) == "con_voice" ) {
  echo 'Согласные: звонкие, глухие';
} elseif ( ($_POST['hi']) == "con_type" ) {
  echo 'Cогласные: шумные, сонорные';
} elseif ( ($_POST['hi']) == "con_noisy" ) {
  echo 'Шумные согласные: взрывные, аффрикаты, фрикативные';
} elseif ( ($_POST['hi']) == "one_char" ) {
  echo "Буква: ", $_POST['char_select'];
}

?>
</p>




<p>

<?php
if ( ($_POST['hi']) == "vow" ) {
  echo "<span class=\"hi1\">Верхние</span><br />";
  echo "<span class=\"hi2\">Средние</span><br />";
  echo "<span class=\"hi3\">Нижние</span><br />";
} elseif ( ($_POST['hi']) == "con_voice" ) {
  echo "<span class=\"hi1\">Звонкие</span><br />";
  echo "<span class=\"hi2\">Глухие</span><br />";
} elseif ( ($_POST['hi']) == "con_type" ) {
  echo "<span class=\"hi1\">Шумные</span><br />";
  echo "<span class=\"hi2\">Сонорные</span><br />";
} elseif ( ($_POST['hi']) == "con_noisy" ) {
  echo "<span class=\"hi1\">Взрывные</span><br />";
  echo "<span class=\"hi2\">Аффрикаты</span><br />";
  echo "<span class=\"hi3\">Фрикативные</span><br />";
}
?>

</p>

<div class="mono">
<?php

print_r($highlighted);

?>
</div>


<hr style="margin:100px 0px 15px 0px">
<ul>
  <li>
    <a target="_blank" href="https://ru.wikipedia.org/wiki/%D0%A0%D1%83%D1%81%D1%81%D0%BA%D0%B0%D1%8F_%D1%84%D0%BE%D0%BD%D0%B5%D1%82%D0%B8%D0%BA%D0%B0">
    «Русская фонетика» на Википедии
    </a>
  </li>
  <li>
    <a target="_blank" href="http://rusgram.narod.ru/1-32.html">
    Фонетическая справка
    </a>
  </li>
  <li>
  © E. Немкович для работы "Визуализация как инструмент структурно-семиотического анализа поэтического текста: проект алгоритма"
  </li>
  <li>
  Обновлено: 20 мая 2020 г.
  </li>
  <li>
  Страница загружена с ресурса
  <?php
  echo $_SERVER['HTTP_HOST'];
  ?>
  </li>
  <li>
    <a target="_blank" href="https://github.com/k-nem/poeticfunction">
    Исходный код
    </a>
  </li>

</ul>

<hr style="margin:0px 0px 50px 0px">

</div>






</body>
</html>

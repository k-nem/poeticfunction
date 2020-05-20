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
$punc = [" ", ".", ",", "-", "—", "!", "?", "«", "»", "\""];

# получение текста

$poem = nl2br($_POST['text']);

$showtags = htmlentities($poem);
$droptags = strip_tags($poem);

$lines = preg_split('<br /> ', $showtags);

$nested_lines = array();

foreach($lines as $key => $line) {
  $line = mb_strtoupper($line);
  $line = mb_str_split($line);
  array_push($nested_lines,$line);
}

//var_dump($nested_lines);

# подсчет всех букв

$characters = mb_strtoupper($droptags);
$all_char_counts = array_flip($abc);

foreach ($abc as $k => $v) {
  $all_char_counts[$v] = mb_substr_count($characters, $v);
}

//$sorted_char_counts = arsort($all_char_counts);

$char_counts = $all_char_counts;
//$char_counts = array_filter($char_counts);
$char_total = array_sum($char_counts);

#
# гласные

$vowel_counts = array_flip($vowel);
$vowel_counts = array_intersect_key($all_char_counts, $vowel_counts);
$vowel_total = array_sum($vowel_counts);
$vowel_ratio = round($vowel_total / $char_total * 100, 1);

# гласные верхнего ряда

$vowel_close_counts = array_flip($vowel_close);
$vowel_close_counts = array_intersect_key($all_char_counts, $vowel_close_counts);
$vowel_close_total = array_sum($vowel_close_counts);
$vowel_close_ratio = round($vowel_close_total / $vowel_total * 100, 1);

# гласные среднего ряда

$vowel_mid_counts = array_flip($vowel_mid);
$vowel_mid_counts = array_intersect_key($all_char_counts, $vowel_mid_counts);
$vowel_mid_total = array_sum($vowel_mid_counts);
$vowel_mid_ratio = round($vowel_mid_total / $vowel_total * 100, 1);

# гласные нижнего ряда

$vowel_open_counts = array_flip($vowel_open);
$vowel_open_counts = array_intersect_key($all_char_counts, $vowel_open_counts);
$vowel_open_total = array_sum($vowel_open_counts);
$vowel_open_ratio = round($vowel_open_total / $vowel_total * 100, 1);

#
# согласные

$consonant_counts = array_flip($consonant);
$consonant_counts = array_intersect_key($all_char_counts, $consonant_counts);
$consonant_total = array_sum($consonant_counts);
$consonant_ratio = round($consonant_total / $char_total * 100, 1);

# по звонкости
# звонкие согласные

$consonant_modal_counts = array_flip($consonant_modal);
$consonant_modal_counts = array_intersect_key($all_char_counts, $consonant_modal_counts);
$consonant_modal_total = array_sum($consonant_modal_counts);
$consonant_modal_ratio = round($consonant_modal_total / $consonant_total * 100, 1);

# глухие согласные

$consonant_voiceless_counts = array_flip($consonant_voiceless);
$consonant_voiceless_counts = array_intersect_key($all_char_counts, $consonant_voiceless_counts);
$consonant_voiceless_total = array_sum($consonant_voiceless_counts);
$consonant_voiceless_ratio = round($consonant_voiceless_total / $consonant_total * 100, 1);

# по типу
# шумные согласные

$consonant_noisy_counts = array_flip($consonant_noisy);
$consonant_noisy_counts = array_intersect_key($all_char_counts, $consonant_noisy_counts);
$consonant_noisy_total = array_sum($consonant_noisy_counts);
$consonant_noisy_ratio = round($consonant_noisy_total / $consonant_total * 100, 1);

# подтипы шумных согласных
# взрывные согласные

$consonant_plosive_counts = array_flip($consonant_plosive);
$consonant_plosive_counts = array_intersect_key($all_char_counts, $consonant_plosive_counts);
$consonant_plosive_total = array_sum($consonant_plosive_counts);
$consonant_plosive_ratio = round($consonant_plosive_total / $consonant_total * 100, 1);

# аффрикаты

$consonant_affricate_counts  = array_flip($consonant_affricate);
$consonant_affricate_counts = array_intersect_key($all_char_counts, $consonant_affricate_counts);
$consonant_affricate_total = array_sum($consonant_affricate_counts);
$consonant_affricate_ratio = round($consonant_affricate_total / $consonant_total * 100, 1);

# фрикативные

$consonant_fricative_counts = array_flip($consonant_fricative);
$consonant_fricative_counts = array_intersect_key($all_char_counts, $consonant_fricative_counts);
$consonant_fricative_total = array_sum($consonant_fricative_counts);
$consonant_fricative_ratio = round($consonant_fricative_total / $consonant_total * 100, 1);

# сонорные

$consonant_sonant_counts = array_flip($consonant_sonant);
$consonant_sonant_counts = array_intersect_key($all_char_counts, $consonant_sonant_counts);
$consonant_sonant_total = array_sum($consonant_sonant_counts);
$consonant_sonant_ratio = round($consonant_sonant_total / $consonant_total * 100, 1);

$aphonic_total = $char_total - $vowel_total - $consonant_total;
$aphonic_ratio = round($aphonic_total / $char_total * 100, 1);

$highlight1 = array();
$highlight2 = array();
$highlight3 = array();

$highlighted = "";

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

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style>

h3, h4 {
  margin: 45px 0px 20px 0px;
}


</style>


<script src="https://www.gstatic.com/charts/loader.js"></script>

<!-- повторяемость букв -->

<script type="text/javascript">
     google.charts.load('current', {'packages':['bar']});
     google.charts.setOnLoadCallback(drawStuff);

     function drawStuff() {
       var data = new google.visualization.arrayToDataTable([
         ['Буква', 'Количество'],
         <?php
         foreach ($vowel_counts as $k => $v) {
           echo "[\"",$k,"\", ",$v,"],\n";
         }
         ?>

       ]);

       var options = {
         title: 'All chars',
         width: 900,
         legend: { position: 'none' },

         bars: 'horizontal', // Required for Material Bar Charts.
         axes: {
           x: {
             0: { side: 'top', label: 'Количество'} // Top x-axis.
           }
         },
         bar: { groupWidth: "90%" }
       };

       var chart = new google.charts.Bar(document.getElementById('vowels'));
       chart.draw(data, options);
     };
</script>

<script type="text/javascript">
     google.charts.load('current', {'packages':['bar']});
     google.charts.setOnLoadCallback(drawStuff);

     function drawStuff() {
       var data = new google.visualization.arrayToDataTable([
         ['Буква', 'Количество'],
         <?php
         foreach ($consonant_counts as $k => $v) {
           echo "[\"",$k,"\", ",$v,"],\n";
         }
         ?>

       ]);

       var options = {
         title: 'All chars',
         width: 900,
         legend: { position: 'none' },

         bars: 'horizontal', // Required for Material Bar Charts.
         axes: {
           x: {
             0: { side: 'top', label: 'Количество'} // Top x-axis.
           }
         },
         bar: { groupWidth: "90%" }
       };

       var chart = new google.charts.Bar(document.getElementById('consonants'));
       chart.draw(data, options);
     };
</script>

<!-- пропорция согласный/гласный/беззвучный -->

<script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart);

     function drawChart() {

       var data = google.visualization.arrayToDataTable([
         ['Тип буквы', '%'],
         ['Гласные', <?php echo $vowel_total; ?>],
         ['Согласные', <?php echo $consonant_total; ?>],
         ['Ь/Ъ', <?php echo $aphonic_total; ?>],
       ]);

       var options = {
         pieHole: 0.4,
       };

       var chart = new google.visualization.PieChart(document.getElementById('total_ratio'));

       chart.draw(data, options);
     }
   </script>

<!-- гласные по типу -->

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Тип', '%'],
        ['Верхний подъем', <?php echo $vowel_close_total; ?>],
        ['Средний подъем', <?php echo $vowel_mid_total; ?>],
        ['Нижний подъем', <?php echo $vowel_open_total; ?>],
      ]);

      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('vowel_ratio'));

      chart.draw(data, options);
    }
  </script>

<!-- согласные по звонкости -->

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Тип', '%'],
        ['Звонкие', <?php echo $consonant_modal_total; ?>],
        ['Глухие', <?php echo $consonant_voiceless_total; ?>],
      ]);

      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('consonant_voice_ratio'));

      chart.draw(data, options);
    }
  </script>

  <!-- согласные по типу -->

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Тип', '%'],
        ['Шумные', <?php echo $consonant_noisy_total; ?>],
        ['Сонорные', <?php echo $consonant_sonant_total; ?>],
      ]);

      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('consonant_type_ratio'));

      chart.draw(data, options);
    }
  </script>

<!-- шумные по типу  -->

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Тип', '%'],
        ['Взрывные', <?php echo $consonant_plosive_total; ?>],
        ['Аффрикаты', <?php echo $consonant_affricate_total; ?>],
        ['Фрикативные', <?php echo $consonant_fricative_total; ?>],
      ]);

      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('consonant_noisy_ratio'));

      chart.draw(data, options);
    }
  </script>


  <script type="text/javascript">
       google.charts.load('current', {'packages':['bar']});
       google.charts.setOnLoadCallback(drawStuff);

       function drawStuff() {
         var data = new google.visualization.arrayToDataTable([
           ['Буква', 'Количество'],
           <?php
           foreach ($vowel_counts as $k => $v) {
             echo "[\"",$k,"\", ",$v,"],\n";
           }
           ?>

         ]);

         var options = {
           title: 'All chars',
           width: 900,
           legend: { position: 'none' },

           bars: 'horizontal', // Required for Material Bar Charts.
           axes: {
             x: {
               0: { side: 'top', label: 'Количество'} // Top x-axis.
             }
           },
           bar: { groupWidth: "90%" }
         };

         var chart = new google.charts.Bar(document.getElementById('all_sorted'));
         chart.draw(data, options);
       };
  </script>


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
      <h5 class="card-title">Анализируемый текст</h5>
      <p class="card-text">
        <?php
        print($poem)
        ?>
      </p>
      <a href="index.php" class="card-link">Вернуться к форме ввода</a>
    </div>
  </div>


  <h4>Информация из поля ввода</h4>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Всего символов</th>
        <th scope="col">Всего букв</th>
        <th scope="col">Уникальных букв</th>
        <th scope="col">Кодировка</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php print_r(mb_strlen($droptags)); ?></td>
        <td><?php print_r($char_total); ?></td>
        <td><?php print_r(count(array_filter($char_counts))); ?> из <?php print_r(count($all_char_counts)); ?> букв алфавита</td>
        <td><?php print_r(mb_detect_encoding($poem)); ?></td>
      </tr>
    </tbody>
  </table>


<hr style="margin:50px 0px 0px 0px">

<h4>Повторяемость гласных</h4>

<div id="vowels" style="width: 900px; height: 330px"></div>

<hr />
<h4>Повторяемость согласных</h4>

<div id="consonants" style="width: 900px; height: 600px;"></div>

<hr />


<h4>Пропорция: гласные/согласные</h4>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Категория</th>
      <th scope="col">Количество</th>
      <th scope="col">% букв</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Гласные</td>
      <td><?php echo $vowel_total; ?></td>
      <td><?php echo $vowel_ratio; ?>%</td>
    </tr>
    <tr>
      <td>Согласные</td>
      <td><?php echo $consonant_total; ?></td>
      <td><?php echo $consonant_ratio; ?>%</td>
    </tr>
    <tr>
      <td>Ь, Ъ</td>
      <td><?php echo $aphonic_total; ?></td>
      <td><?php echo $aphonic_ratio; ?>%</td>
    </tr>
  </tbody>
</table>

<div id="total_ratio" style="width: 900px; height: 450px;"></div>

<hr />

<h4>Пропорция: гласные по подъему</h4>



<table class="table">
  <thead>
    <tr>
      <th scope="col">Категория</th>
      <th scope="col">Буквы</th>
      <th scope="col">Количество</th>
      <th scope="col">% гласных</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Верхние</td>
      <td>И, Ы, У, Ю</td>
      <td><?php echo $vowel_close_total; ?></td>
      <td><?php echo $vowel_close_ratio; ?>%</td>
    </tr>
    <tr>
      <td>Средние</td>
      <td>Е, Э, О, Е</td>
      <td><?php echo $vowel_mid_total; ?></td>
      <td><?php echo $vowel_mid_ratio; ?>%</td>
    </tr>
    <tr>
      <td>Нижние</td>
      <td>А, Я</td>
      <td><?php echo $vowel_open_total; ?></td>
      <td><?php echo $vowel_open_ratio; ?>%</td>
    </tr>
  </tbody>
</table>

<div id="vowel_ratio" style="width: 900px; height: 450px;"></div>

<hr />

<h4>Пропорция: согласные по звонкости</h4>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Категория</th>
      <th scope="col">Количество</th>
      <th scope="col">% согласных</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Звонкие</td>
      <td><?php echo $consonant_modal_total; ?></td>
      <td><?php echo $consonant_modal_ratio; ?>%</td>
    </tr>
    <tr>
      <td>Глухие</td>
      <td><?php echo $consonant_voiceless_total; ?></td>
      <td><?php echo $consonant_voiceless_ratio; ?>%</td>
    </tr>

  </tbody>
</table>

<div id="consonant_voice_ratio" style="width: 900px; height: 450px;"></div>

<hr />

<h4>Пропорция: согласные по способу образования</h4>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Категория</th>
      <th scope="col">Количество</th>
      <th scope="col">% согласных</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Шумные</td>
      <td><?php echo $consonant_noisy_total; ?></td>
      <td><?php echo $consonant_noisy_ratio; ?>%</td>
    </tr>
    <tr>
      <td>Сонорные</td>
      <td><?php echo $consonant_sonant_total; ?></td>
      <td><?php echo $consonant_sonant_ratio; ?>%</td>
    </tr>

  </tbody>
</table>

<div id="consonant_type_ratio" style="width: 900px; height: 450px;"></div>

<hr />

<h4>Пропорция: шумные согласные по типу</h4>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Категория</th>
      <th scope="col">Количество</th>
      <th scope="col">% согласных</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Взрывные</td>
      <td><?php echo $consonant_plosive_total; ?></td>
      <td><?php echo $consonant_plosive_ratio; ?>%</td>
    </tr>
    <tr>
      <td>Аффрикаты</td>
      <td><?php echo $consonant_affricate_total; ?></td>
      <td><?php echo $consonant_affricate_ratio; ?>%</td>
    </tr>
    <tr>
      <td>Фрикативные</td>
      <td><?php echo $consonant_fricative_total; ?></td>
      <td><?php echo $consonant_fricative_ratio; ?>%</td>
    </tr>

  </tbody>
</table>

<div id="consonant_noisy_ratio" style="width: 900px; height: 450px;"></div>


<hr />
<h4>Количество гласных</h4>

<table class="table table-sm" style="width: 500px;">
  <thead>
    <tr>
      <th scope="col">Буква</th>
      <th scope="col">Количество</th>
      <th scope="col">% гласных</th>
    </tr>
  </thead>
  <tbody>

      <?php
      foreach ($vowel_counts as $k => $v) {
        echo "<tr>";
        echo "<td>", $k, "</td>";
        echo "<td>", $v, "</td>";
        echo "<td>", round($v / $vowel_total * 100, 1), "%</td>";
      }
      ?>

  </tbody>
</table>

<hr />
<h4>Количество согласных</h4>

<table class="table table-sm" style="width: 500px;">
  <thead>
    <tr>
      <th scope="col">Буква</th>
      <th scope="col">Количество</th>
      <th scope="col">% согласных</th>
    </tr>
  </thead>
  <tbody>

      <?php
      foreach ($consonant_counts as $k => $v) {
        echo "<tr>";
        echo "<td>", $k, "</td>";
        echo "<td>", $v, "</td>";
        echo "<td>", round($v / $consonant_total * 100, 1), "%</td>";
      }
      ?>

  </tbody>
</table>

<hr />
<h3>Подсветить буквы</h3>
<p>Выбрать критерий:</p>

<form method="post" action="highlight.php">
<p><input type="radio" name="hi" value="vow">  Гласные: верхний, средний, нижний подъем </p>
<p><input type="radio" name="hi" value="con_voice">  Согласные: звонкие, глухие</p>
<p><input type="radio" name="hi" value="con_type">  Cогласные: шумные, сонорные</p>
<p><input type="radio" name="hi" value="con_noisy">  Шумные согласные: взрывные, аффрикаты, фрикативные</p>
<p><input type="radio" name="hi" value="one_char">
  Буква:
  <select name="char_select" id="chardrop">
        <?php
        foreach ($char_counts as $k => $v) {
          echo "<option value=\"$k\">$k</option>";
        }
        ?>
  </select>
</p>

<input type="hidden" name="hi_text" value="<?php print_r($poem); ?>">
<input type="hidden" name="hi_text2" value="<?php $poem; ?>">
<button type="submit" class="btn btn-primary" name="submit_hi" value="True" style="margin: 20px 0px 20px 0px">Перейти к подсветке</button>

<p style="color: lightgray">Если при переходе не выбран критерий, вы увидите ошибки.</p>

</form>

<?php
//print_r($lines);
//print_r($nested_lines);

//echo("\n</pre>\n");


//print_r($highlighted);
//print_r(htmlentities($poem));

?>


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

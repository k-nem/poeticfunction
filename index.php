<!DOCTYPE html>
<html>

<head>

<title>Поэтическая функция</title>

<link rel="shortcut icon" href="_/f.png" />

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>



  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href=index.php>
      <img src="_/logo.svg" height="30" class="d-inline-block align-top" alt="">
      Поэтическая функция
    </a>
  </nav>

<div class="container-md" style="max-width: 1024px">

  <div class="alert alert-primary" role="alert" style='margin-top: 50px'>
    ⚠️ Для корректной работы рекомендуется использование Google Chrome. В других бразерах не тестировалось.
  </div>


  <form method="post" action="func.php">
    <div class="form">
    <label for="txt" style='margin: 20px 0px 0px 0px'><h4>Анализировать текст</h4></label>
    <p>Замените текст из поля на свой, или нажмите "Начать анализ" для перехода к примеру визуализации.
      <a href="https://ru.wikisource.org/wiki/%D0%9A%D0%B0%D1%82%D0%B5%D0%B3%D0%BE%D1%80%D0%B8%D1%8F:%D0%9F%D0%BE%D1%8D%D0%B7%D0%B8%D1%8F" target="_blank">
        Найти стихотворение
      </a>
    </p>
    <textarea class="form-control" id="txt" name="text" rows="14">
Ах, какая усталость под вечер!
Недовольство собою и миром и всем!
Слишком много я им улыбалась при встрече,
Улыбалась, не зная зачем.

Слишком много вопросов без жажды
За ответ заплатить возлиянием слёз.
Говорили, гадали, и каждый
Неизвестность с собою унёс.

Слишком много потупленных взоров,
Слишком много ненужных бесед в терему,
Вышивания бисером слишком ненужных узоров.
Вот гирлянда, вот ангел… К чему?

Ах, какая усталость! Как слабы
Наши лучшие сны! Как легка в обыденность ступень!
Я могла бы уйти, я замкнуться могла бы…
Я Христа предавала весь день!</textarea>


    <button type="submit" class="btn btn-primary btn-lg" name="submit" value="True" style="margin: 20px 0px 20px 0px">Начать анализ</button>
    </div>
  </form>
<p style="color: lightgray">Текст с неподходящей кодировкой и форматированием может отображаться некорректно. <br>
  В случае возникновения трудностей попробуйте скопировать текст с
  <a style="color: lightgray; text-decoration: underline;" href="https://ru.wikisource.org/wiki/%D0%9A%D0%B0%D1%82%D0%B5%D0%B3%D0%BE%D1%80%D0%B8%D1%8F:%D0%9F%D0%BE%D1%8D%D0%B7%D0%B8%D1%8F" target="_blank">
    Викитеки
  </a>
</p>



<hr style="margin: 60px 0px 15px 0px">
  <ul>
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

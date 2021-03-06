<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TASK 16</title>
</head>
<body>
   <?php
      include 'example_persons_array.php';
      include 'script.php';
      include 'getPerfectPartner.php';
   ?>
   <div>
      <div>
         <h2>Разбиение и объединение ФИО</h2>
         <p>getPartsFromFullname принимает как аргумент одну строку — склеенное ФИО.<br>
         Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’:<br>
         <h4> <?php print_r(getPartsFromFullname($fullname)); ?></h4></p>
         <p>getFullnameFromParts принимает как аргумент три строки — фамилию, имя и отчество.<br>
         Возвращает как результат их же, но склеенные через пробел:<br>
         <h4> <?php echo $fullname; ?></h4></p>
         <h2>Сокращение ФИО</h2>
         <p>getShortName, принимающую как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович»<br>
         и возвращающую строку вида «Иван И.», где сокращается фамилия и отбрасывается отчество.:<br>
         <h4> <?php print_r(getShortName($fullname)); ?></h4></p>
         <h2>Функция определения пола по ФИО</h2>
         <p>функция getGenderFromName, принимающую как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович»<br>
            возвращаем -1 - женский пол, 0 - пол не удалось определить, 1 - мужской пол:<br>
         <h4> <?php print_r(getGenderFromName($fullname)); ?></h4></p>
         <h2>Определение полового состава</h2>
         <p>Функция getGenderDescription для определения полового состава аудитории:</p>
         <h4> <?php print_r(getGenderDescription($example_persons_array)); ?></h4>
         <p>Функция getGenderDescriptionWhithFilter для определения полового состава аудитории, используя фильтрацию:</p>
         <h4>Гендерный состав аудитории:<br> <?php print_r(getGenderDescriptionWhithFilter($example_persons_array)); ?></h4>
         <h2>Идеальный подбор пары</h2>
         <h4> <?php
                  $perfect = getPartsFromFullname($fullname);
                  echo getPerfectPartner($perfect['surname'], $perfect['name'], $perfect['patronomyc'], $example_persons_array);
            ?></h4></p>
      </div>
   </div>
</body>
</html>
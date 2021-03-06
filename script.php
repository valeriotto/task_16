<?php

   // берем из массива случайную строку с ФИО и помещаем в перменную
   $fullname = $example_persons_array[random_int(0, count($example_persons_array) - 1)]['fullname'];

   /*getPartsFromFullname принимает как аргумент одну строку — склеенное ФИО.
   Возвращает как результат массив из трёх элементов с ключами ‘name’, ‘surname’ и ‘patronomyc’.*/
   function getPartsFromFullname($fullname){
      $keysArr = ['surname', 'name', 'patronomyc']; // создаем массив с тремя ключами
      $fullnameArr = explode(' ', $fullname); /* создаем массив ФИО применив функцию,
      которая разбивает строку по указанной подстроке*/
      return array_combine($keysArr, $fullnameArr); /* возвращаем результат с помощью функции,
      которая создаёт новый массив, в котором ключами станут значения из $a, а значениями — значения из $b*/
   }

   /*getFullnameFromParts принимает как аргумент три строки — фамилию, имя и отчество.
   Возвращает как результат их же, но склеенные через пробел.*/
   function getFullnameFromParts($surname, $name, $patronomyc){
      //$fullnameArr = getPartsFromFullname($fullname);
      //$surname = $fullnameArr['surname'];
      //$name = $fullnameArr['name'];
      //$patronomyc = $fullnameArr['patronomyc'];
      return $surname . ' ' . $name . ' ' . $patronomyc;
   }

   /*функция getShortName, принимающую как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович»
   и возвращающую строку вида «Иван И.», где сокращается фамилия и отбрасывается отчество.
   Для разбиения строки на составляющие используйте функцию getParstFromFullname.*/
   function getShortName($fullname){
      $fullnameArr = getPartsFromFullname($fullname); // массив с ключами
      return $fullnameArr['name'] . ' ' . mb_substr($fullnameArr['surname'], 0, 1) . '.';
   }

   /* функция getGenderFromName, принимающую как аргумент строку, содержащую ФИО вида «Иванов Иван Иванович»
    возвращаем -1 - женский пол, 0 - пол не удалось определить, 1 - мужской пол*/
    function getGenderFromName($fullname){
       $fullnameArr = getPartsFromFullname($fullname);
       // Признаки женского пола
       if (mb_substr($fullnameArr['patronomyc'], -3) == 'вна' ||
       mb_substr($fullnameArr['name'], -1) == 'а' ||
       mb_substr($fullnameArr['surname'], -2) == 'ва'){
          return -1;
       } elseif ( // признаки мужского пола
         mb_substr($fullnameArr['patronomyc'], -2) == 'ич' ||
         (mb_substr($fullnameArr['name'], -1) == 'й' || mb_substr($fullnameArr['name'], -1) == 'н') ||
         mb_substr($fullnameArr['surname'], -1) == 'в'){
         return 1;
         } else {
            return 0;
         }
    }

   /*функцию getGenderDescription для определения полового состава аудитории*/
   function getGenderDescription($gender){
       $male = 0;
       $female = 0;
       $noMaleNoFemale = 0; // не определен пол

         foreach ($gender as $key => $value){ // перебор
            switch (getGenderFromName($value['fullname'])){ // получаем полы из ФИО
               case 1:
                  $male++;
                  break;
               case -1:
                  $female++;
                  break;
               default:
                  $noMaleNoFemale++;
                  break;
            }
         }

         $genders = count($gender); // Подсчитывает количество элементов всего
         $result = [ // записываем всё в массив
            'male' => round(($male / $genders) * 100, 1), // сначала делим персон одного пола на все персоны, потом округляем
            'female' => round(($female / $genders) * 100, 1),
            'noMaleNoFemale' => round(($noMaleNoFemale / $genders) * 100, 1),
         ];

      // выводим результаты массива
      echo <<<HEREDOCLETTER
      Гендерный состав аудитории:<br>
      Мужчины - {$result['male']}%<br>
      Женщины - {$result['female']}%<br>
      Не удалось определить - {$result['noMaleNoFemale']}%<br>
      HEREDOCLETTER;
   }

   /*функцию getGenderDescriptionWhithFilter для определения полового состава аудитории, с использованием фильтра*/
   function getGenderDescriptionWhithFilter($gender){
      // перебор всего массива
      foreach ($gender as $key => $value) {
          $result[] = (getGenderFromName($value['fullname'])); // создадим массив
      }
      // подсчет и вывод мужчин
      echo 'Мужчины - ' . round(count(array_filter($result, function($num) {
          if ($num == 1) return true;
          else return false;
      })) / count($result) * 100, 1) . '%' . '<br>';
      // подсчет и вывод женщин
      echo "Женщины - " . round(count(array_filter($result, function($num) {
          if ($num == -1) return true;
          else return false;
      })) / count($result) * 100, 1) . '%' . '<br>';
      // подсчет и вывод ни женщин ни мужчин
      echo "Не удалось определить - " . round(count(array_filter($result, function($num) {
          if ($num == 0) return true;
          else return false;
      }))/count($result) * 100, 1) . '%' . '<br>';
   }
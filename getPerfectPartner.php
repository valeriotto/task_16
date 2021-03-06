<?php
   // функция подбирает идеального человека противоположного пола
   function getPerfectPartner($surname, $name, $patronomyc, $fullnameArr) {
      // приводим фамилию, имя, отчество (переданных первыми тремя аргументами) к привычному регистру
      $surname = mb_convert_case($surname, MB_CASE_TITLE_SIMPLE);
      $name = mb_convert_case($name, MB_CASE_TITLE_SIMPLE);
      $patronomyc = mb_convert_case($patronomyc, MB_CASE_TITLE_SIMPLE);
      // склеиваем ФИО, используя функцию getFullnameFromParts
      $fullname = getFullnameFromParts($surname, $name, $patronomyc);
      // определяем пол для ФИО с помощью функции getGenderFromName;
      $gender = getGenderFromName($fullname);
      // проверяем с помощью getGenderFromName, что выбранное из Массива ФИО - противоположного пола
      $maleOrFemale=null;
      do {
      // случайным образом выбираем любого человека в массиве;
         $maleOrFemale = $fullnameArr[rand(0, count($fullnameArr) - 1)];
         if (getGenderFromName($maleOrFemale['fullname']) == $gender) $maleOrFemale = null;
      } while ($maleOrFemale == null);
      //Процент совместимости «Идеально на ...» — случайное число от 50% до 100% с точностью два знака после запятой.
      $rand = round(random_int(5000, 10000) / 100, 2);
      echo getShortName($fullname) . ' + ' . getShortName($maleOrFemale['fullname']) . ' = ' . '<br>';
      echo "♡ Идеально на " . $rand . "% ♡" . '<br>';;
   }

<body>
  <main class="main">
    <div class="shadow">
      <div class="start wrapper">
        <div class="start__content">
          <div class="content-section">
            <h2 class="content-section__title">Как пройти тест?</h2>
            <p class="content-section__subtitle">
            <ol>
              <li>Выберите одну из существующих тем внизу страницы и нажмите на кнопку "Начать" </li>
              <br>
              <li>Ознакомьтесь с лекцией и по необходимости с вебинаром и нажмите на кнопку "Далее" </li>
              <br>
              <li>Пройдите тест (попытка всего одна). Время на прохождения теста неограничено </li>
              <br>
              <li>При выходе с теста до его завершения, будет записан имеющийся результат </li>
              <br>
              <li>В конце теста Вы увидете таблицу с количеством набранных баллов по тесту (при выходе с теста до его завершения, будет записан имеющийся результат). <br>
                На странице с лекцией вы всё еще можете закрыть тест, он будет доступен </li>
              <br>
              Чтобы быстро перейти к тестам, нажмите на кнопку ниже
            </ol>
            </p>
            <a href="#test" class="link-button">Перейти к тестам</a>
          </div>
          <img src="assets/img/woman.png" alt="woman" class="start__image">
        </div>
      </div>
      <div class="about">
        <div class="wrapper">
          <div class="about__content">
            <img src="assets/img/woman2.png" alt="woman" class="about__image">
            <div class="about__content-section">
              <h3 class="about__content-section__title">
                О системе дистанционного обучения <br> ООО “ЛокоТех-Сервис”
              </h3>
              <p class="about__content-section__subtitle">
                У ЛокоТех более 250 точек присутствия по всей России: депо, сервисные участки, станции техобслуживания, мастерские. По договору с заказчиком каждый сотрудник ЛокоТех обязан регулярно проходить обучение. <br><br>
                Раньше специалистов рабочих профессий, например, слесарей, обучали офлайн — организовывали командировки тренеров или отправляли сотрудников в региональные учебные центры. Сейчас же это можно заменить дистанционным обучением! <br><br>
                Система дистанционного обучения (СДО) — это интернет-платформа, в которой можно дистанционно получать знания: смотреть видеоуроки и читать лекции, проходить тестирование, а также следить за своей успеваемостью.
              </p>
            </div>
            <div id="test"></div>
          </div>
        </div>
      </div>
      <div class="wrapper">
        <div class="allTest__content">
          <h3 class="allTest__content__title">Выберите тему<br>для изучения</h3>
          <div class="allTest__block">

            <?php if (@$_GET['page'] == 1) {
              $result = mysqli_query($con, "SELECT * FROM tests ORDER BY date DESC") or die('Error');
              echo  '
              <table class="table">
                <thead>
                  <tr>
                      <th>№</th>
                      <th>Тема</th>
                      <th>Всего вопросов</th>
                      <th>Наивысшая оценка</th>
                      <th></th>
                  </tr>
                </thead><tbody>';
              $c = 1;
              while ($row = mysqli_fetch_array($result)) {
                $title = $row['title'];
                $total = $row['total'];
                $rightanswers = $row['rightanswers'];
                $idexam = $row['idexam'];
                $q12 = mysqli_query($con, "SELECT score FROM history WHERE idexam='$idexam' AND email='$email'") or die('Error98');
                $rowcount = mysqli_num_rows($q12);
                if ($rowcount == 0) {
                  echo '<tr><td>' . $c++ . '</td><td>' . $title . '</td><td>' . $total . '</td><td>' . $rightanswers * $total . '
                  </td>
                  <td><button id="myBtn"><a class="list__link1" href="lectureUser.php?page=tests&step=1&idexam=' . $idexam . '&n=1&t=' . $total . '">Начать</a></button></td>
                  ';
                } else {
                  echo '<tr><td>' . $c++ . '</td><td>' . $title . '</td><td>' . $total . '</td><td>' . $rightanswers * $total . '</td><td><button id="myBtn2" disabled>Пройден</button></td></tr>';
                }
              }
              $c = 0;
              echo '</tbody></table>';
            } ?>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
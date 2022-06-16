<body>
  <main class="main">
    <div class="shadow">
      <!-- Выводит ошибку "Такой email уже существует" -->
      <?php
      if (@$_GET['q7']) {
        echo '<script>alert("' . @$_GET['q7'] . '");</script>';
      }
      ?>
      <?php if (@$_GET['page'] == 0) {
        $result = mysqli_query($con, "SELECT * FROM tests ORDER BY date DESC") or die('Error');
        echo  '
        <div class="homepage1">Панель администратора</div>        
        <div class="homepage">Все темы</div>
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
          echo '
          <tr><td>' . $c++ . '</td><td>' . $title . '</td><td>' . $total . '</td><td>' . $rightanswers * $total . 
          '</td><td><b><a class="list__link1" href="update.php?page=deltest&idexam=' . $idexam . '">
          <span><b>Удалить</b></span></a></b></td></tr>';
        }
        $c = 0;
        echo '
        </tbody></table></table><br>';
      }
      ?>

      <?php if (@$_GET['page'] == 1) {
        $result = mysqli_query($con, "SELECT * FROM user") or die('Error');
        echo  '
        <div class="homepage1">Панель администратора</div>        
        <div class="homepage">Пользователи</div>
        <table class="table">
        <thead>
          <tr>
              <th>№</th>
              <th>Имя пользователя</th>
              <th>Email</th>
              <th></th>
          </tr>
        </thead><tbody>';
        $c = 1;
        while ($row = mysqli_fetch_array($result)) {
          $name = $row['name'];
          $email = $row['email'];

          echo '
          <tr><td>' . $c++ . '</td><td>' . $name . '</td><td>' . $email . '</td><td><a class="list__link1" 
          href="update.php?delmail=' . $email . '"><b>Удалить</b></b></a></td></tr>';
        }
        $c = 0;
        echo '</table></div><br>';
      } ?>

      <?php
      if (@$_GET['page'] == 2 && !(@$_GET['step'])) {
        echo ' 
        <div class="homepage1">Панель администратора</div>        
        <div class="homepage">Добавление курса<br><br>
          <div>
              <form name="form" action="update.php?page=addtests" method="POST">
                  <div>
                      <input class="course" id="name" name="name" placeholder="Введите название теста" 
                      type="text" required>
                  </div><br>
                  <div>
                      <input class="course1" id="total" name="total" placeholder="Введите количество вопросов" 
                      min="0" type="number" required>
                  </div><br>
                  <div>
                      <input class="course1" id="right" name="right" placeholder="Введите количество баллов за правильный ответ" 
                      min="0" type="number" required>
                  </div><br>
                  <div>
                      <textarea class="course" rows="10" cols="100" id="lecture" name="lecture" placeholder="Введите текст лекции" 
                      type="text" required></textarea> 
                  </div><br>
                  <div>
                      <input class="course" id="video" name="video" placeholder="Вставьте URL-адрес видеоролика" 
                      type="text" required>
                  </div><br>
                  <div style="margin: 15px auto">
                      <input class="btn" type="submit" value="Дальше">
                  </div>
              </form>
          </div> 
        </div>';
      }
      ?>

      <?php
      if (@$_GET['page'] == 2) {
        echo '
        <div class="homepage">Введите вопросы и ответы<br><br>
        <form class="form-horizontal title1" name="form" action="update.php?page=addquestion&n=' . @$_GET['n'] . '&idexam=' . @$_GET['idexam'] . '&ch=4 " method="POST">';

        for ($i = 1; $i <= @$_GET['n']; $i++) {
          echo '
          <b>Вопрос ' . $i . '
          <div>
              <label for="question' . $i . ' "></label>  
              <textarea class="course" rows="2" cols="100" name="question' . $i . '" placeholder="Введите вопрос" required></textarea> 
          <div>

          <div>
              <label for="' . $i . '1"></label>  
              <input class="course1" id="' . $i . '1" name="' . $i . '1" placeholder="Вариант ответа 1" type="text" required>
          <div>
              
          <div>
              <label for="' . $i . '2"></label>  
              <input class="course1" id="' . $i . '2" name="' . $i . '2" placeholder="Вариант ответа 2" type="text" required>
          <div>

          <div>
              <label for="' . $i . '3"></label>  
              <input class="course1" id="' . $i . '3" name="' . $i . '3" placeholder="Вариант ответа 3" type="text" required>
          <div>

          <div>
              <label for="' . $i . '4"></label>  
              <input class="course1" id="' . $i . '4" name="' . $i . '4" placeholder="Вариант ответа 4" type="text" required>
          <div><br>

          <b>Правильный ответ</b>:<br>
          <select id="ans' . $i . '" name="ans' . $i . '" placeholder="Выберете правильный вариант ответа ">
          <option value="a">Выберете правильный вариант ответа</option>
          <option value="a">Вариант ответа 1</option>
          <option value="b">Вариант ответа 2</option>
          <option value="c">Вариант ответа 3</option>
          <option value="d">Вариант ответа 4</option></select><br><br>';
        }
        echo '
        <div>
            <label for=""></label>
            <div style="margin: 15px auto">
            <input class="btn" type="submit" value="Закончить">
        </div>

        </form>
        </div>';
      }?>

      <?php
      if (@$_GET['page'] == 3) {
        echo '
        <div class="homepage1">Панель администратора</div>        
        <div class="homepage">Регистрация нового пользователя<br><br>
          <div>
            <form class="reguser" name="form" action="sign.php?page=adminPanel.php?page=3" onSubmit="return validateForm()" method="POST">
                <div>
                    <label for="name"></label>
                    <input class="course1" id="name" name="name" placeholder="Имя пользователя" type="text" required>
                </div>
                <div>
                    <label  title1" for="email"></label>
                    <input class="course1" id="email" name="email" placeholder="Email" type="email" required>
                </div>
                <div>
                    <label for="password"></label>           
                    <input class="course1" id="password" name="password" placeholder="Пароль" type="password" required>    
                </div>
                <div>
                    <label for="cpassword"></label>          
                    <input class="course1" id="cpassword" name="cpassword" placeholder="Повторите пароль" type="password" required>
                </div><br><br>
                <div>
                    <label for=""></label>
                    <input class="btn" type="submit" class="sub btn btn-danger" value="Регистрация" />
                </div><br>
            </form>
        </div>';
      }
      ?>
    </div>
  </main>
</body>
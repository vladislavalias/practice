<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Level1 by Val</title>
    <link href="style.css" rel="stylesheet" type=text/css>
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
  </head>
  <body>
    <form action="index.php" method="post" id="registration-form">
       <div  class="td_title">
        <div class="top_left_1">Ваши данные</div>
        <div class="top_right_1"><i>sign up</i></div>
        <div class="hr_bottom"></div>
        <hr />
      </div>  
      
      <div class="double_block">
        <div class="left_block">
          <table border="0" class="table_style" cellspacing="0">
            <tr>
              <td>имя:</td>
              <td>
                <div style="position: relative">
                  <input type="text" name="name" id="registration-name" />
                  <div class="error">
                    <span class="error-message">Invalid Data</span>
                    <span class="close_error">X</span>
                  </div>
                </div>
              </td>
            </tr>

            <tr>
              <td>пароль:</td>
              <td>
                <div style="position: relative">
                  <input type="password" name="password" id="registration-password" />
                  <div class="error">
                    <span class="error-message">Invalid Data</span>
                    <span class="close_error">X</span>
                  </div>
                </div>
              </td>
            </tr>
            
            <tr>
              <td>повтор пароля:</td>
              <td>
                <div style="position: relative">
                  <input type="password" name="password2" id="registration-password2" />
                  <div class="error">
                    <span class="error-message">Invalid Data</span>
                    <span class="close_error">X</span>
                  </div>
                </div>
              </td>
            </tr>

            <tr>
              <td>e-mail:</td>
              <td>
                <div style="position: relative">
                  <input type="email" name="email" id="registration-email" />
                  <div class="error">
                    <span class="error-message">Invalid Data</span>
                    <span class="close_error">X</span>
                  </div>
                </div>
              </td>
           </tr>

            <tr>
              <td>страна:</td>
              <td>
                <div style="position: relative">
                  <select name="country" id="country_select">
                    <option value="">Выберите страну</option>
                    <option value="ua">Украина</option>
                    <option value="ru">Россия</option>
                    <option value="by">Беларусь</option>
                  </select>
                  <div class="error">
                    <span class="error-message">Invalid Data</span>
                    <span class="close_error">X</span>
                  </div>
                </div>
              </td>
            </tr>
            
            <tr id="city" class="hidden">
              <td>
                <div class="hidden">
                  город:
                </div>
              </td>
              <td>
                <div style="position: relative">
                  <div class="hidden">
                    <select name="city" id="city_ua" class="hidden show_adress_select">
                      <option value="">Выберите город</option>
                      <option value="Kiev">Киев</option>
                      <option value="Odessa">Одесса</option>
                      <option value="Kharkov">Харьков</option>
                      <option value="Zaporojie">Запорожье</option>
                    </select>

                    <select name="city" id="city_ru" class="hidden show_adress_select">
                      <option value="">Выберите город</option>
                      <option value="Moscow">Москва</option>
                      <option value="Saint-Peretsburg">Одесса</option>
                      <option value="Vologda">Вологда</option>
                      <option value="Magadan">Магадан</option>
                      <option value="Satka">Сатка</option>
                    </select>

                    <select name="city" id="city_by" class="hidden show_adress_select">
                      <option value="">Выберите город</option>
                      <option value="Minsk">Минск</option>
                      <option value="Brest">Брест</option>
                      <option value="Urupinsk">Урюпинск</option>
                      <option value="Bobruisk">Бобруйск</option>
                    </select>
                    
                    <div class="error">
                      <span class="error-message">Invalid Data</span>
                      <span class="close_error">X</span>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            
            <tr class="hidden" id="street">
              <td>
                <div class="hidden">
                  улица:
                </div>
              </td>
              <td>
                <div style="position: relative"> 
                  <div class="hidden">
                    <input name="street" type="text" id="street_name"/> 
                    <div class="error">
                      <span class="error-message">Invalid Data</span>
                      <span class="close_error">X</span>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            
            <tr class="hidden" id="house">
              <td>
                <div class="hidden">
                  дом:
                </div>
              </td>
              <td>
                <div style="position: relative"> 
                  <div class="hidden">
                    <input name="house" type="text" id="number_house"/>
                    <div class="error">
                      <span class="error-message">Invalid Data</span>
                      <span class="close_error">X</span>
                    </div>
                  </div>
                </div>
              </td>
            </tr>

            <tr>
              <td>пол:</td>
              <td>
                <div style="position: relative"> 
                  <span>
                    <input class="choose_sex" type="radio" name="sex" value="male" />мужской
                    <input class="choose_sex" type="radio" name="sex" value="female" />женский
                  
                    <div class="error">
                      <span class="error-message">Invalid Data</span>
                      <span class="close_error">X</span>
                    </div>
                  </span>
                </div> 
              </td>
            </tr>

            <tr>
              <td>получать наши данные</td>
              <td>
                <div style="position: relative">
                  <input class="give_agree" type="checkbox" value="agree" />согласен
                  <div class="error">
                    <span class="error-message">Invalid Data</span>
                    <span class="close_error">X</span>
                  </div>
                </div>
              </td>
            </tr>

            <tr>
              <td><input type="reset" /></td>
              <td><input type="submit" /></td>
            </tr>
          </table> 
        </div>
      
      <div class="avatar">
        <div class="ava_pic">
          <div class="choose_pic"><input type="file" /></div>
        </div>
      </div>
    </div> 
      
      <div class="hr_bottom"></div>      
      <div><hr /><div class="end_of_form">&copy; copyright 2013</div></div>
    </form>
  </body>
</html>
<div id="container">
    <h1>Загрузка данных из файла формата MS Excel</h1>
    <div class="tabs">
        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1" title="Wordpress">Общие настройки</label>

        <input id="tab2" type="radio" name="tabs">
        <label for="tab2" title="Windows">База данных</label>

        <input id="tab3" type="radio" name="tabs">
        <label for="tab3" title="HTML5">JSON файл</label>

        <input id="tab4" type="radio" name="tabs">
        <label for="tab4" title="CSS3">Описание</label>
        <form enctype="multipart/form-data" action="" method="post">
        <section id="content1">
            <table>
                <tr>
                    <td>
                        <label for="startRow">Обрабатывать файл MS Excel начиная со строки:</label>
                    </td>
                    <td>
                        <input type="number" id="startRow" value='1' min = 1 name='startPos'>
                    </td>
                </tr>
                <tr class='countField'>
                    <td>
                        <label for="countField">Кол-во полей для загрузки:</label>
                    </td>
                    <td>
                        <input type="number" id="countField" value = 1 onchange='addField();' min = 1 max = 8 name = 'countfield'>
                    </td>
                </tr>
                <tr class='fieldName'>
                    <td>
                        Поле #1
                    </td>
                    <td>
                        <input type='text' placeholder='имя поля' name='field[]' >
                        <input type='number' placeholder='номер столбца в листе MS Excel' name='number[]' min = 1 max = 8>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="file" name="file_load" value='Выбрать файл'></td>
                </tr>
            </table>
        </section>
        <section id="content2">
            <table>
                <tr>
                    <td>
                        <label for="setBD">Сохранять в БД (Да/Нет):</label>
                    </td>
                    <td>
                        <input type="checkbox" id="setBD"  name='checkBD' onclick = 'setTableName();'><br>
                    </td>
                </tr>
                <tr class='bd'>
                    <td>
                        <label for="basename">Имя таблицы-приемника:</label>
                    </td>
                    <td>
                        <input type="text" id="basename" placeholder='имя БД' name='BD'>
                    </td>
                </tr>
            </table>
         </section>
        <section id="content3">
            <table>
                <tr>
                     <td>
                        <label for="setFile">Формировать файл (Да/Нет):</label>
                    </td>
                    <td>
                        <input type="checkbox" id="setFile" onclick = 'setPathFile();' name='checkin'><br>
                    </td>
                </tr>
                <tr class='path'>
                    <td>
                        <label for="pathFile">Сохранять файл в каталоге: </label>
                    </td>
                    <td>
                        <input type="text" id="pathFile" placeholder='путь от корня сайта' name='pathJSON'>
                    </td>
                </tr>
            </table>
       </section>
       <section id="content4">
             <p>
               <h3>Модуль загрузки данных из файла MS Excel (демо-версия)</h3>
               <h4>Порядок действия</h4>
               <ol>
                   <li>
                       На вкладке "Общие настройки" указываем:
                       <ul>
                           <li>с какой строки начинать обработку файла MS Excel;</li>
                           <li>кол-во столбцов (полей) для обработки;</li>
                           <li>указываются наименования полей - то как они будут<strong> называться в БД</strong> и (или) в JSON  файле.</li>
                       </ul>
                   </li>
                   <li>
                       На вкладке "База данных" указываем нужно ли сохранять данные в БД и наименование таблицы-приемника данных;
                   </li>
                   <li>
                       На вкладке "JSON" указываем нужно ли сохранять данные в JSON файле и путь к файлу <strong>от корня сайта</strong>;
                   </li>
                   <li>
                       Нажимаем кнопку "Загрузить".
                   </li>
               </ol>
               <h4>Ограничения демо-версии</h4>
               <ul>
                   <li>
                        Можно обрабатывать данные только одного (активного) листа файла MS Excel
                   </li>
                   <li>
                       Можно загружать данные только в одну таблицу-приемник
                   </li>
                   <li>
                       JSON  файл формируется в utf формате
                   </li>
                   <li>Нельзя сохранить настройки для повторного использования</li>
                   <li>
                       При загрузке  обрабатывается только символьные форматы данных, не учитываются различные варианты структуры таблицы-приемника.
                   </li>
               </ul>
               <h3> Если ли Вам не достаточно демо-версии и выхотите разработать загрузку под свои нужды - мы будем рады помочь Вам в этом:<a href="mailto:pif13@tut.by">связаться с нами</a></h3>
            </p>
        </section>
        <div class='btnSubmit'>
            <input type="submit" value="Загрузить">
        </div>
        </form>
        <div class='btnSubmit'>
            <?php echo $this->showMessage; ?>
        </div>
    </div>
    <div class="info">
        &copy; <a href="mailto:pif13@tut.by">Stoik</a>
    </div>
</div>
function loadTopics(categoryId) {
    var topicSelect = document.getElementById('topic');
    topicSelect.innerHTML = '<option value="">Select Topic</option>'; // Очищаем предыдущие опции

    if (categoryId) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/load-topics/' + categoryId, true);
        xhr.onload = function() {
            if (this.status === 200) {
                var topics = JSON.parse(this.responseText);
                topics.forEach(function(topic) {
                    var option = document.createElement('option');
                    option.value = topic.id;
                    option.textContent = topic.name;
                    topicSelect.appendChild(option);
                });
            }
        };
        xhr.send();
    }
}

// Этот код на JavaScript предназначен для динамической загрузки списка тем (topics) в выпадающий список (select element) на веб-странице, основываясь на выбранной категории (categoryId).
//
//     Давайте разберем его по шагам:
//
//     function loadTopics(categoryId):
//         Определяет функцию loadTopics, которая принимает categoryId в качестве аргумента. Этот аргумент представляет собой идентификатор выбранной категории.
//     var topicSelect = document.getElementById('topic');:
// Получает ссылку на элемент select с id="topic" на странице и сохраняет ее в переменной topicSelect. Это выпадающий список, куда будут загружаться темы.
//     topicSelect.innerHTML = '<option value="">Select Topic</option>';:
// Очищает выпадающий список от всех предыдущих опций, оставляя только одну опцию "Select Topic". Это делается для того, чтобы при выборе новой категории отображались только темы, относящиеся к ней.
// if (categoryId):
// Проверяет, был ли передан categoryId. Если он не передан (например, пользователь выбрал "Select Category" или ничего не выбрал), то загрузка тем не происходит.
//     var xhr = new XMLHttpRequest();:
// Создает объект XMLHttpRequest, который используется для отправки AJAX-запроса на сервер.
// xhr.open('GET', '/load-topics/' + categoryId, true);:
// Настраивает запрос:
//     GET: указывает, что это GET-запрос (получение данных).
// /load-topics/ + categoryId: URL-адрес, на который будет отправлен запрос. categoryId добавляется к URL, чтобы сервер знал, темы какой категории нужно вернуть.
//     true: указывает, что запрос должен быть асинхронным (страница не будет блокироваться во время ожидания ответа).
// xhr.onload = function() { ... };:
// Определяет функцию, которая будет вызвана, когда сервер ответит на запрос.
// if (this.status === 200):
// Проверяет, был ли запрос успешным (статус HTTP 200).
// var topics = JSON.parse(this.responseText);:
// Если запрос успешен, парсит ответ сервера (который должен быть в формате JSON) и сохраняет полученный массив объектов topics в переменную.
// topics.forEach(function(topic) { ... });:
// Перебирает каждый объект topic в массиве topics.
//     var option = document.createElement('option');:
// Создает новый элемент <option> для каждой темы.
//     option.value = topic.id;:
// Устанавливает значение (value) опции равным идентификатору темы (topic.id).
//     option.textContent = topic.name;:
// Устанавливает текст, который будет отображаться в выпадающем списке, равным названию темы (topic.name).
// topicSelect.appendChild(option);:
// Добавляет созданную опцию в выпадающий список topicSelect.
// xhr.send();:
// Отправляет запрос на сервер.
//     В итоге:
//
//     Этот код позволяет динамически обновлять список тем в выпадающем списке на веб-странице, основываясь на выбранной категории. Когда пользователь выбирает категорию, функция loadTopics отправляет AJAX-запрос на сервер, чтобы получить список тем, относящихся к этой категории. Затем она очищает выпадающий список и добавляет новые опции, соответствующие полученным темам.
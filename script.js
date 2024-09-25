// Меню-бургер для телефонов
const burger = document.querySelector("#burger");
const mobileMenu = document.querySelector("#mobile-menu");
burger.addEventListener("click", () => mobileMenu.classList.toggle("opened"));
// Вопросы
const questions = [
    {
        title : "Завтракаете ли вы по утрам?",
        answers : [
            "Да", "Нет", "Да, в обед", "Иногда"
        ],
        image : "images/zavtrak-kofe-narezka-vypechka-sok-apelsinovyi-miusli-iagody.png"
    },
    {
        title : "Чем обычно завтракаете?",
        answers : [
            "Как все, кашей", "Как все, яичница", "Бутер с кофе", "Кофе с сигаретой"
        ],
        image : "images/завтрак2.jpg"
    },
    {
        title : "Сколько чистой воды пьете в течении дня?",
        answers : [
            "Вообще не пью", "Пью, но мало", "Много пью", "Стабильно 1.5л"
        ],
        image : "images/вода1.webp"
    },
    {
        title : "Есть ли физическая нагрузка?",
        answers : [
            "Да, постоянно", "Иногда по настроению", "Нет времени", "Все хочу, но лень"
        ],
        image : "images/спорт2.webp"
    },
    {
        title : "Что мешает похудеть?",
        image : "images/помощь2.png"
    }
]

// Ответы пользователя
const userAnswers = [];
let currentQuestion = 0;
// Элементы для опроса
const next = document.querySelector("#next");
const title = document.querySelector("#qtitle");
const answers = document.querySelector(".answers");
const img = document.querySelector("#img3");
const ownAnswer = document.querySelector(".own-answer");


const showQuestion = () => {
    let question = questions[currentQuestion];
    title.textContent = question.title;
    let answerHTML = "";
    if(question.answers){
        for(let i = 0; i < question.answers.length; i++){
            answerHTML += `<div class="answer"><input type="radio" name="answer" id="answer${i+1}"><label for="answer${i+1}">${question.answers[i]}</label></div>`;
        }
        answerHTML += `<div class="answer"><input type="radio" name="answer" id="answer${question.answers.length + 1}"><label for="answer${question.answers.length + 1}">Свой ответ</label></div><div class="own-answer"><input type="text" placeholder="Впишите свой ответ"></div>`;
        
    }
    answers.innerHTML = answerHTML;
    
    document.querySelectorAll(".answer").forEach(el => el.addEventListener("click", e => {
        let checkedAnswer = document.querySelector(".answer>input:checked");
        let userAnswer = Number(checkedAnswer.id.replace("answer", "")) - 1;
        if(userAnswer === question.answers.length){
            ownAnswer.classList.add("opened");
        }
    }))
    img.src = question.image;
}

// При клике на "Далее"
next.addEventListener("click", () => {
    let checkedAnswer = document.querySelector(".answer>input:checked");
    if(!checkedAnswer){
        alert("Выберите ответ!");
        return;
    }
    let userAnswer = Number(checkedAnswer.id.replace("answer", "")) - 1;
    console.log("Человек ответил", userAnswer);
    if(userAnswer === questions[currentQuestion].answers.length){
        userAnswers.push(ownAnswer.querySelector("input").value);
    }
    else{
        userAnswers.push(questions[currentQuestion].answers[userAnswer]);
    }
    console.log("Ответы пользователя", userAnswers);
    
    currentQuestion++;
    showQuestion();
    
});

showQuestion()
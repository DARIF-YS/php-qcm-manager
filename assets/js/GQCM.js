const translations = {
  ar: {
      question: 'السؤال',
      answers: 'الإجابات',
      correct_answer: 'الإجابة الصحيحة',
      response1: 'إجابة 1',
      response2: 'إجابة 2',
      response3: 'إجابة 3',
      response4: 'إجابة 4'
  },
  fr: {
      question: 'Question',
      answers: 'Réponses',
      correct_answer: 'Bonne réponse',
      response1: 'Réponse 1',
      response2: 'Réponse 2',
      response3: 'Réponse 3',
      response4: 'Réponse 4'
  },
  en: {
    question: 'Question',
    answers: 'Answers',
    correct_answer: 'Correct Answer',
    response1: 'Answer 1',
    response2: 'Answer 2',
    response3: 'Answer 3',
    response4: 'Answer 4'
  }  
};

 // à adapter dynamiquement selon la langue choisie


function ajouterQuestion(currentLang) {
    const t = translations[currentLang];
    let container = document.getElementById("questionsContainer");
    let div = document.createElement("div");
    div.classList.add("question");
    let questionIndex = container.children.length;
    let questionNumber = questionIndex + 1;
    div.innerHTML = `
        <table>
           <tr>
               <td><button type="button" class="delete-btn" onclick="supprimerQuestion(this)">X</button></td>
         </tr>
        <tr>
           <th><label class="questionlabel">${t.question} ${questionNumber}:</label></th>
        </tr>
        <tr>
           <td><input type="text" name="questions[]" required></td>
        </tr>
        <tr>
           <th><label>${t.answers} :</label><th>
        </tr>
        <tr class="reponses-container">
            <td><input type="text" name="reponses[${questionIndex}][]" placeholder="${t.response1}" required></td>
            <td><input type="text" name="reponses[${questionIndex}][]" placeholder="${t.response2}" required></td>
        </tr>
        <tr class="reponses-container">
            <td><input type="text" name="reponses[${questionIndex}][]" placeholder="${t.response3}" required></td>
            <td><input type="text" name="reponses[${questionIndex}][]" placeholder="${t.response4}" required></td>
        <tr><th><label>${t.correct_answer} :</label></th></tr>
        <tr>
          <td><select name="bonne_reponse[]">
            <option value="1">${t.response1}</option>
            <option value="2">${t.response2}</option>
            <option value="3">${t.response3}</option>
            <option value="4">${t.response4}</option>
          </select>
          </tr></td>
        </table>
    `;
    container.appendChild(div);
}
function supprimerQuestion(button) {
  let questionDiv = button.closest(".question");
  questionDiv.remove();
    mettreAJourNumerotation();
}
function mettreAJourNumerotation() {
  let questions = document.querySelectorAll("#questionsContainer .question");
     questions.forEach((question, index) => {
      let label = question.querySelector(".questionlabel");
     label.textContent = `Question ${index + 1} :`;
});
} 
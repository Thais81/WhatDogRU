<?php
include '/wamp64/www/WhatDogRU/dataBase/Database.php';
include '/wamp64/www/WhatDogRU/src/controller/QuestionnaireController.php';

$questionnaireController = new QuestionnaireController();
$questionData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer_id'])) {
    $questionData = $questionnaireController->handlePostAnswer();
} else {
    $questionData = $questionnaireController->start();
}

$question = $questionData['question'];
$userId = $questionData['user_id'];
$answers = $questionData['answers'];
$features = $questionData['features'];
$breed = $questionData['breed'];
$totalrate = $questionData['total_rate'];

?>

<div id="container">
    <?php if (isset($question)) : ?>
        <div class="questionBox">
            <h2 class="getQuestion"><?php echo htmlspecialchars($question->getQuestionContent()); ?></h2>
        </div>
        <form method="POST" id="answerForm">
            <div class="answers">
                <?php foreach ($answers as $answer) : ?>
                    <button type="button" class="chooseAnswer" data-user-id="<?php echo htmlspecialchars($userId); ?>" data-answer-id="<?php echo htmlspecialchars($answer->getAnswerId()); ?>">
                        <?php echo htmlspecialchars($answer->getAnswerContent()); ?>

                    </button>
                <?php endforeach; ?>
            </div>
            <input type="hidden" name="answer_id" id="answer_id">
            <input type="hidden" name="user_id" id="user_id">
        </form>
    <?php elseif (isset($breed)) : ?>
        <div class="resultBox">
            <h1><?php echo htmlspecialchars($breed->getbreedName()); ?></h1>
            <!--  <h2>vos caractéristiques:</h2>
            <?php if ($features) ?>
            <?php foreach ($features as $feature) : ?>
                <div class="featureItem">
                    <p><?php echo htmlspecialchars($feature->getfeatureContent()); ?></p>
                    <p><?php echo htmlspecialchars($feature->getfeaturerate()); ?> €</p>
                </div>
            <?php endforeach; ?>
            <button id="bye">Quitter</button>
            <button type="submit" id='win'>Être recontacté</button>
        </div> -->
        <?php else : ?>
            <div>Pas de données disponibles</div>
        <?php endif; ?>
        </div>

        <script type="text/javascript" src="web/assets/js/script.js"></script>
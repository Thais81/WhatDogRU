<?php
include '/wamp64/www/Roofline_Devis/dataBase/DatabaseConn.php';
include '/wamp64/www/Roofline_Devis/src/controller/QuestionnaireController.php';

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
$offer = $questionData['offer'];
$totalPrice = $questionData['total_price'];

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
    <?php elseif (isset($offer)) : ?>
        <div class="resultBox">
            <h1>Votre résultat: <?php echo htmlspecialchars($totalPrice); ?> €</h1>
            <h2>En détails:</h2>
            <div class='offerItem'>
                <p><?php echo htmlspecialchars($offer->getOfferName()); ?></p>
                <p>À partir de: <?php echo htmlspecialchars($offer->getOfferPrice()); ?> €</p>
            </div>
            <?php if ($features) ?>
            <?php foreach ($features as $feature) : ?>
                <div class="featureItem">
                    <p><?php echo htmlspecialchars($feature->getfeatureContent()); ?></p>
                    <p><?php echo htmlspecialchars($feature->getfeaturePrice()); ?> €</p>
                </div>
            <?php endforeach; ?>
            <button id="bye">Quitter</button>
            <button type="submit" id='win'>Être recontacté</button>
        </div>
    <?php else : ?>
        <div>Pas de données disponibles</div>
    <?php endif; ?>
</div>

<script type="text/javascript" src="web/assets/js/script.js"></script>
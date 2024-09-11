<?php
require 'dataBase/AnswerDAO.php';
require 'dataBase/QuestionDAO.php';
require 'dataBase/UserDAO.php';
require 'dataBase/UserAnswerDAO.php';
require 'dataBase/AskDAO.php';
require 'dataBase/breedDAO.php';
require 'dataBase/FeatureDAO.php';
require 'dataBase/ConductToDAO.php';

class QuestionnaireController
{
    private $userDAO;
    private $userAnswerDAO;
    private $askDAO;
    private $questionDAO;
    private $answerDAO;
    private $featureDAO;
    private $breedDAO;
    private $conductToDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->userAnswerDAO = new UserAnswerDAO();
        $this->askDAO = new AskDAO();
        $this->questionDAO = new QuestionDAO();
        $this->answerDAO = new AnswerDAO();
        $this->featureDAO = new FeatureDAO();
        $this->breedDAO = new breedDAO();
        $this->conductToDAO = new ConductToDAO();
    }

    public function start()
    {
        $user = $this->userDAO->createUser(false);

        if ($user) {
            $question = $this->questionDAO->getFirstQuestion();
            $questionId = $question->getQuestionId();
            $answers = $this->answerDAO->getAnswersByQuestionId($questionId);

            return [
                'user_id' => $user->getUserId(),
                'question' => $question,
                'answers' => $answers,
                'features' => [],
                'breed' => null,
                'total_rate' => null
            ];
        }
        return null;
    }

    public function createUserAnswer($userId, $selectedAnswerId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer_id']) && isset($_POST['user_id'])) {

            $userId = $_POST['user_id'];
            $selectedAnswerId = $_POST['answer_id'];
            $this->userAnswerDAO->createUserAnswer($userId, $selectedAnswerId);
            return $userId && $selectedAnswerId;
        }
        return null;
    }

    public function getNextQuestion($answerId)
    {
        $question = $this->askDAO->getQuestionByAnswerId($answerId);
        if ($question) {
            return $question;
        } else {
            return null;
        }
    }

    public function findFeature($answerId)
    {
        $feature = $this->featureDAO->getFeatureByAnswerId($answerId);
        if ($feature) {
            return $feature;
        } else {
            return null;
        }
    }

    public function isLastAnswer($answerId)
    {
        $answer = $this->answerDAO->isLastAnswer($answerId);
        return $answer;
    }

    public function findBreed($answerId)
    {
        $breed = $this->conductToDAO->getBreedIdByAnswerId($answerId);

        if ($breed) {
            return $breed;
        } else {
            return null;
        }
    }

    public function handlePostAnswer()
    {
        $userId = $_POST['user_id'];
        $selectedAnswerId = $_POST['answer_id'];

        // Créer un user_answer
        $this->createUserAnswer($userId, $selectedAnswerId);

        // vérifier si la réponse est la dernière du questionnaire
        if ($this->isLastAnswer($selectedAnswerId)) {
            return $this->getResultData($userId);
        } else {
            $nextQuestion = $this->getNextQuestion($selectedAnswerId);
            if ($nextQuestion) {
                $questionId = $nextQuestion->getQuestionId();
                $answers = $this->answerDAO->getAnswersByQuestionId($questionId);
                return [
                    'user_id' => $userId,
                    'question' => $nextQuestion,
                    'answers' => $answers,
                    'features' => [],
                    'breed' => null,
                    'total_rate' => null
                ];
            } else {
                // Fin du questionnaire, récupérer tous les features pour les réponses sélectionnées
                return $this->getResultData($userId);
            }
        }
    }

    public function getResultData($userId)
    {
        $answerIds = $this->userAnswerDAO->getAnswerIdsByUserId($userId);
        $features = [];
        $breed = null;
        $breedName = "";
        $breedRate = 0;

        foreach ($answerIds as $answerId) {
            $feature = $this->featureDAO->getFeatureByAnswerId($answerId);
            if ($feature) {
                $features[] = $feature;
            }

            $breedId = $this->conductToDAO->getbreedIdByAnswerId($answerId);
            if ($breedId && !$breed) {
                try {
                    $breed = $this->breedDAO->getbreedById($breedId);
                    if ($breed) {
                        $breedName = $breed->getBreedName();
                        $breedRate = $breed->getBreedRate();
                    }
                } catch (Exception $e) {
                    var_dump($e->getMessage());
                }
            }
        }
        /**array_map() applique une fonction donnée à chaque élément
 d'un tableau et retourne un nouveau tableau avec les résultats.
 array_sum(...)
Cette fonction prend le tableau des prix retourné par array_map()
 et calcule la somme de tous ces prix. */
        $featureRate = array_sum(array_map(function ($feature) {
            return $feature->getFeatureRate();
        }, $features));

        $totalrate = $breedRate + $featureRate;

        return [
            'user_id' => $userId,
            'features' => $features,
            'question' => null,
            'answers' => [],
            'breed' => $breed,
            'total_rate' => $totalrate
        ];
    }
}

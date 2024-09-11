<?php
require 'dataBase/AnswerDAO.php';
require 'dataBase/QuestionDAO.php';
require 'dataBase/UserDAO.php';
require 'dataBase/UserAnswerDAO.php';
require 'dataBase/AskDAO.php';
require 'dataBase/OfferDAO.php';
require 'dataBase/ServiceDAO.php';
require 'dataBase/ConductToDAO.php';

class QuestionnaireController
{
    private $userDAO;
    private $userAnswerDAO;
    private $askDAO;
    private $questionDAO;
    private $answerDAO;
    private $serviceDAO;
    private $offerDAO;
    private $conductToDAO;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->userAnswerDAO = new UserAnswerDAO();
        $this->askDAO = new AskDAO();
        $this->questionDAO = new QuestionDAO();
        $this->answerDAO = new AnswerDAO();
        $this->serviceDAO = new ServiceDAO();
        $this->offerDAO = new OfferDAO();
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
                'services' => [],
                'offer' => null,
                'total_price' => null
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

    public function findService($answerId)
    {
        $service = $this->serviceDAO->getServiceByAnswerId($answerId);
        if ($service) {
            return $service;
        } else {
            return null;
        }
    }

    public function isLastAnswer($answerId)
    {
        $answer = $this->answerDAO->isLastAnswer($answerId);
        if ($answer) {
            return $answer;
        } else {
            return null;
        }
    }

    public function findOffer($answerId)
    {
        $offer = $this->conductToDAO->getOfferIdByAnswerId($answerId);

        if ($offer) {
            return $offer;
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
                    'services' => [],
                    'offer' => null,
                    'total_price' => null
                ];
            } else {
                // Fin du questionnaire, récupérer tous les services pour les réponses sélectionnées
                return $this->getResultData($userId);
            }
        }
    }

    public function getResultData($userId)
    {
        $answerIds = $this->userAnswerDAO->getAnswerIdsByUserId($userId);
        $services = [];
        $offer = null;
        $offerName = "";
        $offerPrice = 0;

        foreach ($answerIds as $answerId) {
            $service = $this->serviceDAO->getServiceByAnswerId($answerId);
            if ($service) {
                $services[] = $service;
            }

            $offerId = $this->conductToDAO->getOfferIdByAnswerId($answerId);
            if ($offerId && !$offer) {
                try {
                    $offer = $this->offerDAO->getOfferById($offerId);
                    if ($offer) {
                        $offerName = $offer->getOfferName();
                        $offerPrice = $offer->getOfferPrice();
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
        $servicePrice = array_sum(array_map(function ($service) {
            return $service->getServicePrice();
        }, $services));

        $totalPrice = $offerPrice + $servicePrice;

        return [
            'user_id' => $userId,
            'services' => $services,
            'question' => null,
            'answers' => [],
            'offer' => $offer,
            'total_price' => $totalPrice
        ];
    }
}

<?php
final class DAOFactory
{
    private static $answerDAO;
    private static $askDAO;
    private static $conductToDAO;
    private static $contactFormDAO;
    private static $offerDAO;
    private static $pairDAO;
    private static $serviceDAO;
    private static $userAnswerDAO;
    private static $userDAO;
    private static $questionDAO;
    private static $packDAO;

    private function __construct() {}

    public static function getAnswerDAO()
    {
        if (!self::$answerDAO) {
            self::$answerDAO = new AnswerDAO();
        }
        return self::$answerDAO;
    }

    public static function getAskDAO()
    {
        if (!self::$askDAO) {
            self::$askDAO = new AskDAO();
        }
        return self::$askDAO;
    }

    public static function getConductToDAO()
    {
        if (!self::$conductToDAO) {
            self::$conductToDAO = new ConductToDAO();
        }
        return self::$conductToDAO;
    }

    public static function getContactFormDAO()
    {
        if (!self::$contactFormDAO) {
            self::$contactFormDAO = new ContactFormDAO();
        }
        return self::$contactFormDAO;
    }

    public static function getOfferDAO()
    {
        if (!self::$offerDAO) {
            self::$offerDAO = new OfferDAO();
        }
        return self::$offerDAO;
    }

    public static function getPairDAO()
    {
        if (!self::$pairDAO) {
            self::$pairDAO = new PairDAO();
        }
        return self::$pairDAO;
    }

    public static function getServiceDAO()
    {
        if (!self::$serviceDAO) {
            self::$serviceDAO = new ServiceDAO();
        }
        return self::$serviceDAO;
    }

    public static function getUserAnswerDAO()
    {
        if (!self::$userAnswerDAO) {
            self::$userAnswerDAO = new UserAnswerDAO();
        }
        return self::$userAnswerDAO;
    }

    public static function getUserDAO()
    {
        if (!self::$userDAO) {
            self::$userDAO = new UserDAO();
        }
        return self::$userDAO;
    }

    public static function getQuestionDAO()
    {
        if (!self::$questionDAO) {
            self::$questionDAO = new QuestionDAO();
        }
        return self::$questionDAO;
    }

    public static function getPackDAO()
    {
        if (!self::$packDAO) {
            self::$packDAO = new PackDAO();
        }
        return self::$packDAO;
    }
}

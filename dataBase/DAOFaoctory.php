<?php
final class DAOFactory
{
    private static $answerDAO;
    private static $askDAO;
    private static $conductToDAO;
    private static $contactFormDAO;
    private static $breedDAO;
    private static $pairDAO;
    private static $featureDAO;
    private static $userAnswerDAO;
    private static $userDAO;
    private static $questionDAO;
    private static $familyDAO;

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

    public static function getBreedDAO()
    {
        if (!self::$breedDAO) {
            self::$breedDAO = new BreedDAO();
        }
        return self::$breedDAO;
    }

    public static function getPairDAO()
    {
        if (!self::$pairDAO) {
            self::$pairDAO = new PairDAO();
        }
        return self::$pairDAO;
    }

    public static function getFeatureDAO()
    {
        if (!self::$featureDAO) {
            self::$featureDAO = new FeatureDAO();
        }
        return self::$featureDAO;
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

    public static function getFamilyDAO()
    {
        if (!self::$familyDAO) {
            self::$familyDAO = new FamilyDAO();
        }
        return self::$familyDAO;
    }
}

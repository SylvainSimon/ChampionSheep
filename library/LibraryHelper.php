<?php

class LibraryHelper {

    /**
     * @return \Repository\AccountRepository
     */
    public static function getAccountRepository() {
        return \DoctrineHelper::getRepository('\Entity\Account');
    }

    /**
     * @return \Repository\GameRepository
     */
    public static function getGameRepository() {
        return \DoctrineHelper::getRepository('\Entity\Game');
    }

    /**
     * @return \Repository\GameModeRepository
     */
    public static function getGameModeRepository() {
        return \DoctrineHelper::getRepository('\Entity\GameMode');
    }

    /**
     * @return \Repository\TagRepository
     */
    public static function getTagRepository() {
        return \DoctrineHelper::getRepository('\Entity\Tag');
    }

    /**
     * @return \Repository\TeamRepository
     */
    public static function getTeamRepository() {
        return \DoctrineHelper::getRepository('\Entity\Team');
    }

    /**
     * @return \Repository\TeamAccountRepository
     */
    public static function getTeamAccountRepository() {
        return \DoctrineHelper::getRepository('\Entity\TeamAccount');
    }

    /**
     * @return \Repository\TournamentRepository
     */
    public static function getTournamentRepository() {
        return \DoctrineHelper::getRepository('\Entity\Tournament');
    }

    /**
     * @return \Repository\TournamentTeamRepository
     */
    public static function getTournamentTeamRepository() {
        return \DoctrineHelper::getRepository('\Entity\TournamentTeam');
    }

}

<?php

use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Loader\XliffFileLoader;

class TranslationHelper {

    /** @var Translator */
    public static $translator = null;
    
    public static function createTranslator($cacheFolder = null, $debug = false) {

        $translator = new Translator("fr", new MessageSelector(), $cacheFolder, $debug);
        $translator->addLoader('yaml', new YamlFileLoader());
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->setFallbackLocales(['fr']);

        $arrayFolder = \FinderHelper::findAllFolders(ROOT . "/src/", false)->depth(0)->name("*Bundle");
        
        foreach ($arrayFolder as $folder) {

            $strPath = ROOT . '/src/' . $folder->getFileName() . '/Resources/translations';
            (!FileSystemHelper::exists($strPath . '/fr/page.fr.yml')) ? : $translator->addResource('yaml', $strPath . '/fr/pages.fr.yml', 'fr', 'page');
            (!FileSystemHelper::exists($strPath . '/fr/email.fr.yml')) ? : $translator->addResource('yaml', $strPath . '/fr/email.fr.yml', 'fr', 'email');
            (!FileSystemHelper::exists($strPath . '/fr/form.fr.yml')) ? : $translator->addResource('yaml', $strPath . '/fr/form.fr.yml', 'fr', 'form');
            (!FileSystemHelper::exists($strPath . '/fr/common.fr.yml')) ? : $translator->addResource('yaml', $strPath . '/fr/common.fr.yml', 'fr', 'common');
        }
        
        $translator->addResource('xlf', ROOT . '/src/CoreBundle/Resources/translations/validators/validators.fr.xlf', 'fr', "messages");
        $translator->addResource('yaml', ROOT . '/src/CoreBundle/Resources/translations/validators/validators.fr.yml', 'fr', "validators");

        self::$translator = $translator;
        return self::$translator;
    }

    public static function trans($key, $parameters = [], $catalog = "modules") {
        return self::$translator->trans($key, $parameters, $catalog);
    }

}

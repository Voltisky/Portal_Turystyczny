<?php

namespace Frontend\MainBundle\Services;

class KonfiguracjaService {

    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->em = $em;
    }

    public function getKonfiguracja() {
        $em = $this->em;
        $konfiguracja = null;

        try {
            $konfiguracja = $em->createQuery("SELECT k, l, di FROM BackendCommonBundle:Konfiguracja k "
                            . "LEFT JOIN k.logo l "
                            . "LEFT JOIN k.default_image di "
                            . "WHERE k.main = true")
                    ->setMaxResults(1)
                    ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker')
                    ->getSingleResult();
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $konfiguracja;
    }

}

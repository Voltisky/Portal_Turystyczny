<?php
/**
 * Created by PhpStorm.
 * User: Karol Włodek
 * Date: 11.05.2017
 * Time: 22:17
 */

namespace Frontend\UserBundle\Form;

use Application\Sonata\MediaBundle\Entity\Media;
use Backend\PoiBundle\Entity\Poi;
use Backend\PoiBundle\Entity\PoiCategory;
use Backend\PoiBundle\Entity\PoiMedia;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ObjectForm extends AbstractType
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    private function getCategories(Poi $entity)
    {
        $result = array();
        /**
         * @type PoiCategory $poiCategory
         */
        foreach ($entity->getPoiCategory() as $poiCategory) {
            if ($poiCategory->getCzyglowny() == false && $poiCategory->getCategory()) {
                $result[] = $poiCategory->getCategory();
            }
        }

        return $result;
    }

    private function getMainCategory(Poi $entity)
    {
        $result = null;
        /**
         * @type PoiCategory $poiCategory
         */
        foreach ($entity->getPoiCategory() as $poiCategory) {
            if ($poiCategory->getCzyglowny() == true && $poiCategory->getCategory()) {
                $result = $poiCategory->getCategory();
            }
        }

        return $result;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @type Poi $entity
         */
        $entity = $builder->getData();
        $builder->add("nazwa", "text", array("required" => true))
            ->add("alias", "text", array("required" => true, "disabled" => true))
            ->add("polozenie", "ckeditor", array("required" => false))
            ->add("opis", "ckeditor", array("required" => false))
            ->add("nrtel", "text", array("required" => false))
            ->add("nrfax", "text", array("required" => false))
            ->add("email", "email", array("required" => false))
            ->add("www", "text", array("required" => false))
            ->add("wgs_x", "number", array("required" => false))
            ->add("wgs_y", "number", array("required" => false))
            ->add("kategoria_glowna", 'entity', array(
                "required" => true,
                "mapped" => false,
                "class" => "Application\Sonata\ClassificationBundle\Entity\Category",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.id != 1'); // Ignore root
                },
                "multiple" => false,
                "data" => $this->getMainCategory($entity),
                "label" => "form.label_kategoria_glowna",
            ))
            ->add("kategorie", 'entity', array(
                "required" => false,
                "mapped" => false,
                "class" => "Application\Sonata\ClassificationBundle\Entity\Category",
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->where('c.id != 1'); // Ignore root
                },
                "multiple" => true,
                "data" => $this->getCategories($entity),
                "label" => "form.label_kategorie",
            ))
//            ->add("adres", 'entity', array(
//                "required" => true,
//                "class" => "Backend\AdministracyjneBundle\Entity\Adres",
//                "label" => "form.label_kategorie",
//            ))
            ->add("ulica", "text", array("required" => false))
            ->add("nrdomu", "text", array("required" => false))
            ->add("media", FileType::class, array(
                "mapped" => false,
                "required" => false
            ))
            ->add('submit', SubmitType::class);

        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $formEvent){
            $data = $formEvent->getData();

            // Alias generator
            $data->setAlias($this->container->get('helper.alias.generator')->generate($data->getNazwa()));
        });

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $formEvent) {
//            dump($formEvent->getForm()->get("media")->getData()); exit;
            /**
             * @type Poi $data
             */
            $data = $formEvent->getData();

            $data->getPoiCategory()->clear();

            $kategoriaGlowna = $formEvent->getForm()->get("kategoria_glowna")->getData();
            $poiCategory = new PoiCategory();
            $poiCategory->setCategory($kategoriaGlowna);
            $poiCategory->setPoi($data);
            $poiCategory->setCzyglowny(true);

            $data->addPoiCategory($poiCategory);

            $kategorie = $formEvent->getForm()->get("kategorie")->getData();
            foreach ($kategorie as $kategoria) {
                $poiCategory = new PoiCategory();
                $poiCategory->setCategory($kategoria);
                $poiCategory->setPoi($data);
                $poiCategory->setCzyglowny(true);

                $data->addPoiCategory($poiCategory);
            }

            $mediaFile = $formEvent->getForm()->get("media")->getData();
            if ($mediaFile) {
                $previousMedia = $data->getPoiMedia()->filter(function ($media) {
                    return ($media->getCzywiodaca() == true) ? true : false;
                });

                foreach ($previousMedia as $m) {
                    $data->getPoiMedia()->removeElement($m);
                }
//                $data->getPoiMedia()->clear();

                $uploadedMedia = $this->uploadImage($mediaFile);
                $poiMedia = new PoiMedia();
                $poiMedia->setPoi($data);
                $poiMedia->setCzywiodaca(true);
                $poiMedia->setMedia($uploadedMedia);
                $poiMedia->setEnabled(true);

                $data->addPoiMedia($poiMedia);
            }
        });
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Backend\PoiBundle\Entity\Poi'
        );
    }

    public function getName()
    {
        return 'object_form';
    }

    private function uploadImage($file)
    {
        $mediaManager = $this->container->get('sonata.media.manager.media');

        $media = new Media();
        $media->setBinaryContent($file);
        $media->setContext('default');
        $media->setProviderName('sonata.media.provider.image');
        $mediaManager->save($media);

        return $media;
    }
}
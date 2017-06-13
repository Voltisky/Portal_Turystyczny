<?php
/**
 * Created by PhpStorm.
 * User: Karol Włodek
 * Date: 13.05.2017
 * Time: 21:30
 */

namespace Backend\AdministracyjneBundle\Command;

use Backend\AdministracyjneBundle\Entity\Adres;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ImportTerytCommand extends ContainerAwareCommand
{
    private $em = null;
    private $output = null;
    private $input = null;
    private $wojewodztwa = array();
    private $powiaty = array();
    private $gminy = array();

    protected function configure()
    {
        parent::configure();

        $this->setName('administracyjne:import:teryt')
            ->setDescription('Import danych z Teryt');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine')->getManager();
        $this->output = $output;

        $output->writeln(["Rozpoczęcie importu", "---------------------"]);
        $this->loadTerc();
        $this->loadSIMC();
        $output->writeln(["---------------------", "Zakończenie importu"]);
    }

    private function loadTerc()
    {
        $filePath = __DIR__ . "/data/TERC.csv";
        $handle = fopen($filePath, "r");

        $counter = 0;
        while (($rows = fgetcsv($handle, 100, ";")) !== false) {
            if ($counter == 0) {
                $counter = 1;
                continue;
            }

            mb_convert_variables("UTF-8", "Windows-1250", $rows);
            if (array(null) !== $rows && $rows[4]) { // ignore blank lines
                $gmi = $rows[2];
                $pow = $rows[1];
                $woj = $rows[0];
                $rodz = $rows[3];

                if (empty($gmi) && empty($pow)) {
                    $this->wojewodztwa[$woj] = $rows;
                } else if (empty($gmi)) {
                    if (!isset($this->powiaty[$woj]))
                        $this->powiaty[$woj] = array();

                    $this->powiaty[$woj][$pow] = $rows;
                } else {
                    if (!isset($this->gminy[$woj]))
                        $this->gminy[$woj] = array();

                    if (!isset($this->gminy[$woj][$pow]))
                        $this->gminy[$woj][$pow] = array();

                    if (!isset($this->gminy[$woj][$pow][$gmi]))
                        $this->gminy[$woj][$pow][$gmi] = array();

                    $this->gminy[$woj][$pow][$gmi][$rodz] = $rows;
                }
            }
        }

        fclose($handle);
    }

    private function loadSIMC()
    {
        $em = $this->em;
        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $filePath = __DIR__ . "/data/SIMC.csv";
        $handle = fopen($filePath, "r");

        $counter = 0;
        while (($rows = fgetcsv($handle, 100, ";")) !== false) {
            $counter++;
        }

        rewind($handle);

        // Utworzenie paska z postępem
        $progressBar = new ProgressBar($this->output, $counter);
        $counter = 0;
        while (($rows = fgetcsv($handle, 100, ";")) !== false) {
            if ($counter == 0) {
                $counter++;
                continue;
            }


            mb_convert_variables("UTF-8", "Windows-1250", $rows);
            if (isset($rows[6]) && $rows[6] && array(null) !== $rows) {
                $this->createAddress($em, $rows);
                $progressBar->advance(); // Zwiększenie aktualnego stanu o 1

                $counter++;
                if ($counter % 100 == 0) {
                    $em->flush();
                    $em->clear();
                }
            }
        }

        $em->flush();

        // Zakończenie nasłuchiwania postępu
        $progressBar->finish();

        fclose($handle);
    }

    private function checkIfAddressExists($em, $sym)
    {
        $result = null;

        $address = $em->createQuery("SELECT a.id FROM BackendAdministracyjneBundle:Adres a
                                    WHERE a.sym = :sym")
            ->setParameter("sym", $sym)
            ->getResult();
        if (count($address) > 0) {
            $result = $address[0]["id"];
        }

        return $result;
    }

    private function createAddress($em, $rows)
    {
        //region Inicjalizacja danych
        $woj = $rows[0];
        $pow = $rows[1];
        $gmi = $rows[2];
        $rodz = $rows[3];
        $rm = $rows[4];
        $mz = $rows[5];
        $nazwa = $rows[6];
        $sym = $rows[7];
        $sympod = $rows[8];
        $stan = new \DateTime($rows[9]);

        $nazwaWoj = $this->wojewodztwa[$woj][4];
        $nazwaPow = $this->powiaty[$woj][$pow][4];
        $nazwaGmi = $this->gminy[$woj][$pow][$gmi][$rodz][4];
        //endregion

        $address = new Adres();
        $addressId = $this->checkIfAddressExists($em, $sym);
        if ($addressId != null) {
            $address = $em->getReference('BackendAdministracyjneBundle:Adres', $addressId);
        }

        $address->setWoj($woj);
        $address->setPow($pow);
        $address->setGmi($gmi);
        $address->setRodzajGmi($rodz);
        $address->setRm($rm);
        $address->setMz((bool)$mz);
        $address->setNazwa($nazwa);
        $address->setSym($sym);
        $address->setSymPod($sympod);
        $address->setStanNa($stan);
        $address->setNazwaWoj($nazwaWoj);
        $address->setNazwaPow($nazwaPow);
        $address->setNazwaGmi($nazwaGmi);

        $em->persist($address);
    }
}
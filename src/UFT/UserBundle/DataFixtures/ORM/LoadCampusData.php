<?php
/**
 * Created by PhpStorm.
 * User: flavio
 * Date: 06/07/16
 * Time: 09:14
 */

namespace UFT\UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UFT\UserBundle\Entity\Campus;

/**
 * Description of LoadUserBundleData
 *
 * @author flaviomelo
 */
class LoadCampusData extends LoadUserBundleData implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $yaml = $this->getModelFixtures();

        foreach ($yaml['Campus'] as $reference => $columns) {
            $campus = $manager->getRepository('UserBundle:Campus')->findBy(array('id' => $columns['id']));
            if (!$campus) {
                $campus = new Campus();
                $campus->setId($columns['id']);
                $campus->setDescricao($columns['descricao']);
                $manager->persist($campus);
                $manager->flush();
            }
        }
    }

    public function getOrder() {
        return 1;
    }

    public function getModelFile() {
        return 'Campus';
    }

}
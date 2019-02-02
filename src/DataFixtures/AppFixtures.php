<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Skill;
use App\Entity\SchoolClass;
use App\Repository\SkillsRepository;
use App\Repository\SchoolClassRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        $skillsRepo = $manager->getRepository('App:Skill');
        $classRepo = $manager->getRepository('App:SchoolClass');

        $class = new SchoolClass();
        $class->setClass('an2');
        $class->setGroupName('A');
        $class->setSite('Cergy');
        $class->setYear('2019');

        $manager->persist($class);

        $skillsNames = ['PHP','Java','SCRUM'];
        
        foreach($skillsNames as $skillsName) {
            $skill = new Skill();
            $skill->setName($skillsName);
            $manager->persist($skill);
        }

        $manager->flush();
        
        $skills = $skillsRepo->findAll();

        $classes = $classRepo->findAll();

        for($i=0;$i<4;$i++) {
            $user = new User();
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setAvatar('http://i.pravatar.cc/300');
            $user->setDescription($faker->text(20));
            $user->setPersonalProject($faker->text(20));
            $user->setSchoolClass($classes[0]);

            $randSkill = array_rand($skills, 1);
            \Doctrine\Common\Util\Debug::dump($skills[$randSkill]);
            // $user->addPersonalSkill($skills[$randSkill]);

            $manager->persist($user);
        }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

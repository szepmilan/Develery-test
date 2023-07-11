<?php

namespace App\DataFixtures;

use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class MessageFixtures extends Fixture implements OrderedFixtureInterface
{
  public function load(ObjectManager $manager): void
  {
    /*$users = $manager->getRepository(User::class)->findAll();
    $userke = $this->getReference('user_1');*/
    $user = $manager->getRepository(User::class)->findOneBy(['name' => 'Erling Haaland']);
    $user2 = $manager->getRepository(User::class)->findOneBy(['name' => 'Christian Horner']);
    $user3 = $manager->getRepository(User::class)->findOneBy(['name' => 'Bereznay Dani']);

    $message = new Message();
    $message->setName('Szoboszlai Dominik');
    $message->setEmail('szoboszlai@gmail.com');
    $message->setText('Liverpool FC');
    $message->setUser($user);
    $manager->persist($message);

    $message2 = new Message();
    $message2->setName('Lionel Messi');
    $message2->setEmail('messi10@gmail.com');
    $message2->setText('Maimi FC');
    $message2->setUser($user);
    $manager->persist($message2);

    $message3 = new Message();
    $message3->setName('Sergio Perez');
    $message3->setEmail('checo.sp@gmail.com');
    $message3->setText('Defender Minister');
    $message3->setUser($user2);
    $manager->persist($message3);

    $message4 = new Message();
    $message4->setName('Max Verstappen');
    $message4->setEmail('max1@gmail.com');
    $message4->setText('Checo is a legend');
    $message4->setUser($user3);
    $manager->persist($message4);

    $manager->flush();
  }

  public function getOrder(): int
  {
    return 2; // smaller means sooner
  }
}

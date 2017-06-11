<?php

namespace AppBundle\Command;


use AppBundle\Entity\User;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('user:create')
            ->setDescription('Creates a user in the database')
            ->setHelp('A command for creating a new user in the database. You need to provide the usernam and a random password is generated for you and stored in the database.');
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $entityManager = $container->get('doctrine.orm.entity_manager');
        $encoder = $container->get('security.password_encoder');
        $helper = $this->getHelper('question');

        // Get user name
        $userNameQuestion = new Question('Please enter username: ', null);
        $userName = $helper->ask($input, $output, $userNameQuestion);

        if (is_null($userName)) {
            $output->writeln('No username specified, aborting!');
            return;
        }

        // Get password
        $passwordQuestion = new Question('Please enter password: ', null);
        $passwordQuestion->setHidden(true);
        $passwordQuestion->setHiddenFallback(false);
        $password = $helper->ask($input, $output, $passwordQuestion);

        $passwordConfirmationQuestion = new Question('Please confirm password: ', null);
        $passwordConfirmationQuestion->setHidden(true);
        $passwordConfirmationQuestion->setHiddenFallback(false);
        $passwordConfirmation = $helper->ask($input, $output, $passwordConfirmationQuestion);

        if (is_null($password) || is_null($passwordConfirmation)) {
            $output->writeln('No password provided, aborting!');
            return;
        }

        if ($password !== $passwordConfirmation) {
            $output->writeln('Passwords do not match, aborting!');
            return;
        }

        // Create user
        $user = new User();
        $user->setUsername($userName);

        $hash = $encoder->encodePassword($user, $password);
        $user->setPassword($hash);

        try {
            $entityManager->persist($user);
            $entityManager->flush();
        } catch (UniqueConstraintViolationException $e) {
            $output->writeln('Username already exists, aborting!');
            return;
        }

        $output->writeln('User creation sucessfull!');
    }
}
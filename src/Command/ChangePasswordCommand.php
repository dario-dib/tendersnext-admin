<?php
// src/Command/ChangePasswordCommand.php
namespace App\Command;

use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(name: 'app:user:change-password', description: 'Change a user password')]
class ChangePasswordCommand extends Command
{
    public function __construct(
        private UserRepository $users,
        private UserPasswordHasherInterface $hasher,
        private EntityManagerInterface $em,
    ) { parent::__construct(); }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED);
        $this->addArgument('password', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $user = $this->users->findOneBy(['email' => $input->getArgument('email')]);
        if (!$user) {
            $io->error('User not found');
            return Command::FAILURE;
        }

        $hash = $this->hasher->hashPassword($user, (string)$input->getArgument('password'));
        $user->setPassword($hash);
        $this->em->flush();

        $io->success('Password updated');
        return Command::SUCCESS;
    }
}

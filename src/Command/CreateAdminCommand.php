<?php
// src/Command/CreateAdminCommand.php
namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(name: 'app:user:create-admin', description: 'Create or reset an admin user')]
class CreateAdminCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher
    ) { parent::__construct(); }

    protected function configure(): void
    {
        $this->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $repo = $this->em->getRepository(User::class);
        $user = $repo->findOneBy(['email' => $email]) ?? new User();
        $isNew = $user->getId() === null;

        $user->setEmail($email);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->hasher->hashPassword($user, $password));

        $this->em->persist($user);
        $this->em->flush();

        $io->success($isNew ? 'Admin created.' : 'Admin updated.');
        return Command::SUCCESS;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User\User;
use App\Services\DataApiInterface;
use Illuminate\Console\Command;

class ImportResources extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resources:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users and their posts from a third party';

    /**
     *
     * @var DataApiInterface
     */
    protected DataApiInterface $dataApi;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(DataApiInterface $dataApi)
    {
        $this->dataApi = $dataApi;

        $this->importUsers();
        // limit email in case of limit reached
        return Command::SUCCESS;
    }

    /**
     * @return void
     */
    public function importUsers(): void
    {
        \Log::info('Importing users!');

        $apiUsers = $this->dataApi->getUsers();

        if (empty($apiUsers)) {
            \Log::info('There is no Users from this API');
            return;
        }

        foreach ($apiUsers as $apiUser) {
            $eloquentUser = User::updateOrCreate([
                'email' => $apiUser['email'],
            ],[
                'name' => $apiUser['name'],
                'email' => $apiUser['email'],
                'foreign_id' => $apiUser['id'],
            ]);

            $this->importPostsForUser($eloquentUser);
        }

        \Log::info('Users are imported successfully!');
    }

    /**
     * @param User $user
     * @return void
     */
    public function importPostsForUser(User $user): void
    {
        $apiPosts = $this->dataApi->getPostsByUser($user->foreign_id);

        if (empty($apiPosts)) {
            \Log::info('There is no Posts for this user: '. $user->name);
            return;
        }

        $user->posts()->createMany($apiPosts);
    }
}

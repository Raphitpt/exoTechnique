<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CreateBackAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-back-account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Création d\'un compte back-office pour un utilisateur.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Questions pour gérer le flux des information
        $name = $this->ask('Entrez le nom de l\'utilisateur');
        $email = $this->ask('Entrez l\'adresse email de l\'utilisateur');
        $password = $this->secret('Entrez le mot de passe de l\'utilisateur');
        $passwordConfirmation = $this->secret('Confirmez le mot de passe de l\'utilisateur');

        // Vérification si les mot de passes corespondent
        if ($password !== $passwordConfirmation) {
            $this->error('Les mots de passe ne correspondent pas.');
            return;
        }

        // Vérification des informations saisies
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaine de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',

            'email.required' => 'L\'email est obligatoire.',
            'email.string' => 'L\'email doit être une chaine de caractères.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.max' => 'L\'email ne doit pas dépasser 255 caractères.',
            'email.unique' => 'L\'email est déjà utilisée.',

            'password.required' => 'Le mot de passe est obligatoire.',
            'password.string' => 'Le mot de passe doit être une chaine de caractères.',
            'password.min' => 'Le mot de passe doit faire au moins 8 caractères.',

        ]);

        // Affichage des erreurs si il y en a
        if ($validator->fails()) {
            $this->error('Les informations saisies sont incorrectes. Voici les erreurs :');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        // Création du compte si il n'y a pas d'erreur
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->email_verified_at = now();
        $user->save();

        $this->info('Le compte a bien été créé.');
    }
}

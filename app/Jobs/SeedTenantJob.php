<?php

namespace App\Jobs;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeedTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $tenantId = $this->tenant->id;
        $tenantDB = "tenant".$tenantId;
        // Nom de la base de données du locataire
        $tenantDB = "tenant" . $tenantId;

        // Chemin vers le fichier SQL
        $sqlFilePath = database_path('madagascar.sql');

        // Vérifier si le fichier existe
        if (File::exists($sqlFilePath)) {
            // Lire le contenu du fichier SQL
            $sqlContent = File::get($sqlFilePath);

            // Remplacer la valeur de la variable db
            $sqlContent = str_replace('db;', $tenantDB . ';', $sqlContent);

            // Ajouter la déclaration USE
            $sqlContent = "USE " . $tenantDB . ";\n" . $sqlContent;

            // Exécuter le contenu du fichier SQL
            DB::unprepared($sqlContent);
            DB::purge();
            DB::reconnect();
        } else {
            // Fichier non trouvé, gérer l'erreur ici
            // Vous pouvez journaliser un avertissement ou envoyer une notification
        }

        // DB::purge();
        // DB::reconnect();
        $this->tenant->run(function(){
            User::create([
                'name' => $this->tenant->name,
                'email' => $this->tenant->email,
                'password' => Hash::make($this->tenant->password),
            ]);
        });
    }
}

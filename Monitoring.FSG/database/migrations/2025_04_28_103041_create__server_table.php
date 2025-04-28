<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('_server', function (Blueprint $table) {
            $table->id();
            /*
            $table->string('name'); // Nom logique du serveur
            $table->string('ip_address'); // Adresse IP
            $table->enum('status', ['online', 'offline', 'warning']); // Statut
            $table->bigInteger('total_space'); // Espace total en octets
            $table->bigInteger('used_space'); // Espace utilisé en octets
            $table->integer('file_count'); // Nombre total de fichiers
            $table->integer('suspicious_files'); // Nombre de fichiers suspects
            $table->dateTime('last_checked_at')->nullable(); // Dernière vérification
            $table->timestamps();
            */
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('_server');
    }
};

/*

id	int	Identifiant auto-incrémenté
name	string	Nom logique du serveur
ip_address	string	Adresse IP (ex: 10.30.1.11)
status	string	online, offline, warning
total_space	bigint	Espace total en octets
used_space	bigint	Espace utilisé en octets
file_count	int	Nombre total de fichiers
suspicious_files	int	Nombre de fichiers suspects
last_checked_at	datetime	Dernière vérification
created_at	timestamp	
updated_at	timestamp	

*/
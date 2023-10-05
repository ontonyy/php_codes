<?php

namespace App\Http\Controllers\Api;
use Gitlab\Client;
use Illuminate\Support\Facades\Log;

class GitLabApiService
{
    public const GITLAB_TALTECH_API = "https://gitlab.cs.ttu.ee";

    public function getProjects(string $authHttpToken, array $parameters): array {
        $client = new Client();
        $client->setUrl(self::GITLAB_TALTECH_API);
        $str = 'glpat-jGj8yt55yPttHbFph1mK';
        $client->authenticate( $authHttpToken, Client::AUTH_HTTP_TOKEN);

        $ownedProjects = $client->projects()->all(["owned" => true, "simple" => true]);

        Log::info('Logged array: ' . print_r($ownedProjects, true));

        $projects = [];
        foreach ($ownedProjects as $project) {
            $name = $project["name"];
            $id = $project["id"];

            Log::info("ADDED project name " . $name . " and id: " . $id);
            $projects[] = [$name => $project];
        }

        return $projects;
    }
}

<?php

namespace App\Console\Commands;

use App\Page;
use App\Package;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;


class SyncPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SyncPage {slug} {url?} {mode?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull the latest version of a page from a git repo.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $slug = $this->argument('slug');
        $url = $this->argument('url');
        $mode = $this->argument('mode');

        $tempdir = "resources/temp";
        $temppath = "resources/temp/resources/views/pages/$slug";
        $themepath = "resources/views/theme";
        $pagepath = "resources/views/theme/pages/$slug";

        File::deleteDirectory($tempdir);
        File::deleteDirectory($pagepath);
        File::deleteDirectory($themepath . "/.git");

        exec("git clone $url $tempdir");

        File::copyDirectory("/resources/views/theme/pages/$slug", $pagepath);

        $pagejson = "/resources/views/theme/pages/$slug/page.json";

        File::deleteDirectory($tempdir);

        //Inject Pages if they don't yet exist
        if (Schema::hasTable('pages')) {

            $page = Page::where('slug', '=', $slug)->first();

            if ($page == null) {
                $page = new \App\Page();
                $page->title = ucfirst($slug);
            }
            $page->slug = $slug;
            if (file_exists($pagejson)) {
                $page->body = null;
                $page->excerpt = null;
                if ($page->status == null) {
                    if ($mode == 'reset') {
                        $page->status = 'ACTIVE';
                    } else {
                        $page->status = 'INACTIVE';
                    }
                }
            }

            $json = file_exists($pagejson);
            if ($json == true && ($mode == 'json' OR $mode == 'all' or $mode == 'reset' or $mode == 'schema')) {
                $json = json_decode(file_get_contents($pagejson));
                if ($mode == 'json' OR $mode == 'reset') {
                    if (isset($json->default)) {
                        $page->json = json_encode($json->default);
                    }
                }
                if ($mode == 'schema' OR $mode == 'reset') {
                    $page->schema = json_encode($json);
                }
            }

            $html = file_exists($pagepath . '/body.html');
            if ($html == true && ($mode == 'html' OR $mode == 'all' OR $mode == 'reset')) {
                $html = file_get_contents($pagepath . '/body.html');
                if ($html !== null) {
                    $page->html = $html;
                }
            }

            $css = file_exists($pagepath . '/css.html');
            if ($css == true && ($mode == 'css' OR $mode == 'all' OR $mode == 'reset')) {
                $css = file_get_contents($pagepath . '/css.html');
                if ($css !== null) {
                    $page->css = $css;
                }
            }

            $scripts = file_exists($pagepath . '/scripts.html');
            if ($scripts == true && ($mode == 'json' OR $mode == 'all' OR $mode == 'reset')) {
                $scripts = file_get_contents($pagepath . '/scripts.html');
                if ($scripts !== null) {
                    $page->scripts = $scripts;
                }
            }
            $page->save();
        }
    }
}

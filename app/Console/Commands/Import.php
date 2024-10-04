<?php

namespace App\Console\Commands;

use App\Models\Link;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fp = fopen(storage_path('app/notion.csv'), 'r');

        $headers = fgetcsv($fp);

        while($content = fgetcsv($fp)) {

            $url = $content[4];

            $missing_link = false;

            if (empty($url)) {
                $url = Str::uuid();
                $missing_link = true;
            }

            $link = Link::query()->firstOrCreate([
                'title' => $content[0],
            ], [
                'url' => $url,
                'description' => '',
                'added_at' => Carbon::parse($content[1])->toDateTimeString(),
            ]);

            $tags = explode(", ", $content[3]);

            $tag_ids = [];

            foreach($tags as $tag) {

                $tag_ids[] = Tag::query()->firstOrCreate(['name' => $tag], ['color' => 'gray', 'description' => $tag])->id;

            }

            if ($missing_link) {
                $tag_ids[] = Tag::query()->firstOrCreate(['name' => 'Missing link'], ['color' => 'red', 'description' => 'Missing link'])->id;
            }

            $link->tags()->syncWithoutDetaching($tag_ids);

        }
    }
}

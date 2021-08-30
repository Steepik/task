<?php

namespace App\Console\Commands;

use App\Models\Logging;
use App\Models\Record;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ParserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:run {--url=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse rss from url';

    /**
     * @var int
     */
    private $responseStatus;

    /**
     * @var string
     */
    private $responseBody;

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
     */
    public function handle()
    {
        if (empty($this->option('url'))) {
            return $this->error('Url is empty');
        }

        try {
            $content = Http::get($this->option('url'));
            $this->responseStatus = $content->status();
            $this->responseBody = $content->body();

            $xml = simplexml_load_string($this->responseBody, null, LIBXML_NOCDATA);

            foreach ($xml->channel->item as $item) {
                if (!Record::where('title', $item->title)->exists()) {
                    $record = new Record();

                    $record->title = $item->title;
                    $record->url = $item->link;
                    $record->short_description = $item->description;
                    $record->author = $item->author ?? null;
                    $record->image = $item->enclosure ? $item->enclosure->attributes()->url : null;

                    $record->save();
                }
            }
        } catch(\Exception $e) {
            $this->responseStatus = 500;
            $this->responseBody = $e->getMessage();

            $this->error($e->getMessage());
        }

        // Logging
        $logging = new Logging();

        $logging->date = now();
        $logging->request_method = 'get';
        $logging->request_url = $this->option('url');
        $logging->response_http_code = $this->responseStatus;
        $logging->response_body = $this->responseBody;

        $logging->save();
    }
}

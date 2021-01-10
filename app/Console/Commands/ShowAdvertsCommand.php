<?php

namespace App\Console\Commands;

use App\Models\Advert;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Helper\Table;

class ShowAdvertsCommand extends Command
{
    private const COLUMNS = [
        'id',
        'title',
        'description',
        'price',
        'created_at',
        'updated_at',
    ];

    protected $signature = 'adverts:show {id? : ID объявления}';
    protected $description = 'Показать список объявлений или одно объявление (если указано)';

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
     * @return void
     */
    public function handle(): void
    {
        $advertId = $this->argument('id');

        if ($advertId) {
            $adverts = Advert::whereId($advertId)->get();
        } else {
            $adverts = Advert::all();
        }

        if ($adverts->count() === 0) {
            $this->output->warning('Нет объявления с таким ID');

            return;
        }

        $table = $this->prepareTable($adverts);
        $table->render();
    }

    /**
     * @param Collection|Advert $adverts
     *
     * @return Table
     */
    public function prepareTable(Collection $adverts): Table
    {
        $table = new Table($this->output);

        $table
            ->setHeaders(self::COLUMNS)
            ->setRows($adverts->toArray())
            ->setStyle('box')
            ->setColumnMaxWidth(2, 60);

        return $table;
    }
}

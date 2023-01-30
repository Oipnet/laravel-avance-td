<?php

namespace App\Console\Commands;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\SizeRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class AlertStockSizeCommand extends Command
{
    const ALERT_FOLDER_PATH = 'alert/';
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:stock {limit=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = $this->argument('limit');

        $products = $this->productRepository->findProductWithStockLessThan($limit);
        $content = [];
        foreach ($products as $product) {
            $content[] = $product->title;
        }

        Storage::put(self::ALERT_FOLDER_PATH.'alert_stock'.(new \DateTime())->format('U').'.txt', implode(PHP_EOL, $content));

        return Command::SUCCESS;
    }
}

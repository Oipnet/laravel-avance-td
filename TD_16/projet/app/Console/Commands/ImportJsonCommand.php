<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\SizeRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ImportJsonCommand extends Command
{
    const IMPORT_FILE_FOLDER = 'import/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:json {fileName} {table=Product} {--dry-run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import de données en base. Format d\'entrée JSON';

    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private ProductRepositoryInterface $productRepository,
        private SizeRepositoryInterface $sizeRepository,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $confirm = $this->ask('Voulez vous importer des données ?', true);

        if (! $confirm) {
            return Command::SUCCESS;
        }

        $errors = $this->validate($this->arguments());
        if (count($errors)) {
            foreach ($errors as $error) {
                $this->error($error);
            }

            return Command::INVALID;
        }

        $this->processImport($this->argument('fileName'), $this->argument('table'), $this->option('dry-run'));

        return Command::SUCCESS;
    }

    private function validate(array $arguments): array
    {
        $errors = [];
        if (! Storage::fileExists(self::IMPORT_FILE_FOLDER.$arguments['fileName'])) {
            $errors[] = 'Le fichier '.$arguments['fileName'].' n\'existe pas';
        }

        if (! in_array($arguments['table'], ['Product', 'Category', 'Size'])) {
            $errors[] = 'L\'import pour la table table '.$arguments['table'].' n\'existe pas';
        }

        return $errors;
    }

    private function processImport(string $fileName, string $table, bool $isDryRun)
    {
        $datas = $this->readFile($fileName);

        $bar = $this->output->createProgressBar(count($datas));
        $bar->start();

        switch ($table) {
            case 'Product':
                foreach ($datas as $data) {
                    $this->processImportProduct($data, $isDryRun);

                    $bar->advance();
                }

                break;
            case 'Category':
                foreach ($datas as $data) {
                    $this->processImportCategory($data, $isDryRun);

                    $bar->advance();
                }

                break;
            case 'Size':
                foreach ($datas as $data) {
                    $this->processImportSize($data, $isDryRun);

                    $bar->advance();
                }

                break;
        }
        $bar->finish();
    }

    private function readFile(string $fileName): array
    {
        $datas = json_decode(Storage::get(self::IMPORT_FILE_FOLDER.$fileName), true);

        return $datas;
    }

    private function processImportProduct(array $data, bool $isDryRun)
    {
        $data['slug'] = Str::slug($data['title']);

        $validator = Validator::make($data, [
            'title' => 'required|max:200',
            'slug' => 'unique:products,slug',
            'description' => 'required',
            'price_in_cents' => 'integer|min:0',
            'category' => 'exists:categories,slug',
            'sizes.*' => 'exists:sizes,code',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $error) {
                $this->error($error[0]);
            }
        } else {
            $validatedData = $validator->validated();

            $category = $this->categoryRepository->findbySlug($validatedData['category']);
            $sizes = [];
            foreach ($validatedData['sizes'] ?? [] as $size) {
                $sizes[] = $this->sizeRepository->findByCode($size);
            }

            if (! $isDryRun) {
                $this->productRepository->create($validatedData, [
                    'category' => $category,
                    'sizes' => $sizes,
                ]);
            }
        }
    }

    private function processImportCategory(mixed $data, bool $isDryRun)
    {
        $data['slug'] = Str::slug($data['libelle']);

        $validator = Validator::make($data, [
            'libelle' => 'required|max:100',
            'slug' => 'unique:categories,slug',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $error) {
                $this->error($error[0]);
            }
        } else {
            $validatedData = $validator->validated();

            if (! $isDryRun) {
                $this->categoryRepository->create($validatedData);
            }
        }
    }

    private function processImportSize(mixed $data, bool $isDryRun)
    {
        $data['slug'] = Str::slug($data['libelle']);

        $validator = Validator::make($data, [
            'code' => 'required|unique:sizes,code|max:6',
            'libelle' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $error) {
                $this->error($error[0]);
            }
        } else {
            $validatedData = $validator->validated();

            if (! $isDryRun) {
                $this->sizeRepository->create($validatedData);
            }
        }
    }
}

<?php

namespace App\Services;

use PHPageBuilder\Repositories\BaseRepository;
use PHPageBuilder\Repositories\PageTranslationRepository;
use PHPageBuilder\Contracts\PageRepositoryContract;
use PHPageBuilder\Contracts\PageContract;
use Exception;
use Illuminate\Support\Facades\Log;

class PageRepository extends BaseRepository implements PageRepositoryContract
{
    /**
     * The pages database table.
     *
     * @var string
     */
    protected $table;

    /**
     * The class that represents each page.
     *
     * @var string
     */
    protected $class;

    /**
     * PageRepository constructor.
     */
    public function __construct()
    {
        $this->table = empty(phpb_config('page.table')) ? 'pages' : phpb_config('page.table');
        parent::__construct();
        $this->class = phpb_instance('page');
    }

    /**
     * Create a new page.
     *
     * @param array $data
     * @return bool|object|null
     * @throws Exception
     */
    public function create(array $data)
    {
        foreach (['name', 'layout'] as $field) {
            if (! isset($data[$field]) || ! is_string($data[$field])) {
                return false;
            }
        }

        $page = parent::create([
            'name' => $data['name'],
            'layout' => $data['layout'],
            'tenant_id' => $data['tenant_id'],
            'theme_id' => $data['theme_id'],
        ]);

        if (! ($page instanceof PageContract)) {
            throw new Exception("Page not of type PageContract");
        }
        
        return $this->replaceTranslations($page, $data);
    }

    public function createWithData(array $data)
    {
        foreach (['name', 'layout', 'data'] as $field) {
            if (! isset($data[$field]) || ! is_string($data[$field])) {
                return false;
            }
        }

        $page = parent::create([
            'name' => $data['name'],
            'layout' => $data['layout'],
            'data' => $data['data'],
            'tenant_id' => $data['tenant_id'],
            'theme_id' => $data['theme_id'],
        ]);
        
        $page->invalidateCache();
        if (! ($page instanceof PageContract)) {
            throw new Exception("Page not of type PageContract");
        }
        return $this->replaceTranslations($page, $data);
    }

    /**
     * Update the given page with the given updated data.
     *
     * @param $page
     * @param array $data
     * @return bool|object|null
     */
    public function update($page, array $data)
    {
        foreach (['name', 'layout'] as $field) {
            if (! isset($data[$field]) || ! is_string($data[$field])) {
                return false;
            }
        }

        $this->replaceTranslations($page, $data);

        $updateResult = parent::update($page, [
            'name' => $data['name'],
            'layout' => $data['layout'],
        ]);
        $page->invalidateCache();
        return $updateResult;
    }

    /**
     * Replace the translations of the given page by the given data.
     *
     * @param PageContract $page
     * @param array $data
     * @return bool
     */
    protected function replaceTranslations(PageContract $page, array $data)
    {
        $activeLanguages = phpb_active_languages();
        foreach (['title', 'meta_title', 'meta_description', 'route'] as $field) {
            foreach ($activeLanguages as $languageCode => $languageTranslation) {
                if (! isset($data[$field][$languageCode])) {
                    Log::debug("Something went wrong here: " . $data[$field]);
                    return false;
                }
            }
        }

        $pageTranslationRepository = new PageTranslationRepository;
        $pageTranslationRepository->destroyWhere(phpb_config('page.translation.foreign_key'), $page->getId());
        foreach ($activeLanguages as $languageCode => $languageTranslation) {
            
            $pageTranslationRepository->create([
                phpb_config('page.translation.foreign_key') => $page->getId(),
                'locale' => $languageCode,
                'title' => $data['title'][$languageCode],
                'meta_title' => $data['meta_title'][$languageCode],
                'meta_description' => $data['meta_description'][$languageCode],
                'route' => $data['route'][$languageCode],
                'tenant_id' => $data['tenant_id'],
                'theme_id' => $data['theme_id'],
            ]);
        }

        return true;
    }

    /**
     * Update the given page with the given updated page data.
     *
     * @param $page
     * @param array $data
     * @return bool|object|null
     */
    public function updatePageData($page, array $data)
    {
        $updateResult = parent::update($page, [
            'data' => json_encode($data),
        ]);
        $page->invalidateCache();
        return $updateResult;
    }

    /**
     * Remove the given page from the database.
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $this->findWithId($id)->invalidateCache();

        return parent::destroy($id);
    }

    /**
     * Return the instances for which the given condition holds.
     *
     * @param string $column         do NOT pass user input here
     * @param string $value
     * @return array
     */
    public function findWhere($column, $value)
    {
        $tenant_id = tenant()->id;
        // Need to add theme ID to this query too
        $theme_id = tenant()->domain()->first()->theme_id;
        $column = $this->removeNonAlphaNumeric($column);
        return $this->createInstances($this->db->select(
            "SELECT * FROM {$this->table} WHERE {$column} = ? AND tenant_id = '{$tenant_id}' AND theme_id = '{$theme_id}'",
            [$value]
        ));
    }

    /**
     * Return the instance with the given id, or null.
     *
     * @param string $id
     * @return object|null
     */
    public function findWithId($id)
    {
        // TODO: Log out the tenant ID here to see what's going on. We might not be able to scope these to tenants since its being accessed by users.
        return $this->createInstances($this->db->select(
            "SELECT * FROM {$this->table} WHERE id = ?",
            [$id]
        ))[0];
    }
}
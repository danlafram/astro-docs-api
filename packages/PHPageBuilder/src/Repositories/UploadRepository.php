<?php

namespace PHPageBuilder\Repositories;

use PHPageBuilder\UploadedFile;

class UploadRepository extends BaseRepository
{
    /**
     * The uploads database table.
     *
     * @var string
     */
    protected $table = 'uploads';

    /**
     * The class that represents each uploaded file.
     *
     * @var string
     */
    protected $class = UploadedFile::class;

    /**
     * Create a new uploaded file.
     *
     * @param array $data
     * @return bool|object
     */
    public function create(array $data)
    {
        // TODO: Add tenant_id to this create.
        $fields = ['public_id', 'original_file', 'mime_type', 'server_file', 'tenant_id'];
        foreach ($fields as $field) {
            if (! isset($data[$field]) || ! is_string($data[$field])) {
                return false;
            }
        }

        return parent::create([
            'public_id' => $data['public_id'],
            'original_file' => $data['original_file'],
            'mime_type' => $data['mime_type'],
            'server_file' => $data['server_file'],
            'tenant_id' => $data['tenant_id'],
        ]);
    }

    /**
     * Return the instances for which the given condition holds.
     *
     * @param string $column         do NOT pass user input here
     * @param string $value
     * @return array
     */
    // public function findWhere($column, $value)
    // {
    //     $column = $this->removeNonAlphaNumeric($column);
    //     return $this->createInstances($this->db->select(
    //         "SELECT * FROM {$this->table} WHERE {$column} = ?",
    //         [$value]
    //     ));
    // }
}

<?php

namespace PHPageBuilder;

class UploadedFile
{
    public $public_id;
    public $original_file;
    /**
     * Return the URL of this uploaded file.
     */
    public function getUrl()
    {
        // Made an update here to handle tenant specific assets
        return phpb_tenant_full_url('/tenancy/assets/' . $this->public_id . '/' . $this->original_file);
    }
}

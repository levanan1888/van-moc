<?php

namespace Botble\Contact\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileUpload implements Rule
{
    protected $extensions;
    protected $maxSize;

    public function __construct($extensions, $maxSize)
    {
        $this->extensions = $extensions;
        $this->maxSize = $maxSize;
    }

    public function passes($attribute, $value)
    {
        if (!$value) {
            return true; // File is optional, so it's considered valid if not provided.
        }

        if (!$value->isValid()) {
            return false;
        }

        $extension = strtolower($value->getClientOriginalExtension());

        // Check if the extension is in the list of allowed extensions
        return in_array($extension, $this->extensions) && $value->getSize() <= $this->maxSize;
    }

    public function message()
    {
        return trans('plugins/contact::contact.form.file.required', ['extensions' => implode(', ', $this->extensions), 'capacity' => (int)$this->maxSize/1000000 ]);
    }
}

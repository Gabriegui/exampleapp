<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueInSchema implements ValidationRule
{
    protected string $schema;
    protected string $table;
    protected string $column;

    public function __construct(string $schema, string $table, string $column)
    {
        $this->schema = $schema;
        $this->table = $table;
        $this->column = $column;
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        if (!DB::table(DB::raw("\"{$this->schema}\".\"{$this->table}\""))
            ->where($this->column, $value)
            ->doesntExist()) {
            $fail('O campo :attribute já está em uso.');
        }
    }
}

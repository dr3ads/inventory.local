<?php

namespace Lib\Items;

use Lib\Processes\ProcessRepository;

class ItemService
{
    protected $itemRepository, $processRepository;

    public function __construct(ItemRepository $itemRepository, ProcessRepository $processRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->processRepository = $processRepository;
    }

    public function createTransaction($data)
    {
        $
    }
}
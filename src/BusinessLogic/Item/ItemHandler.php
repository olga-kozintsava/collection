<?php

declare(strict_types=1);

namespace App\BusinessLogic\Item;

use App\BusinessLogic\Validator;
use App\Entity\Item;
use App\Service\Item\ItemCreate;
use App\Service\Item\ItemCustomFieldCreate;
use Exception;

class ItemHandler
{
    public function __construct(private Validator              $validator,
                                private ItemCreate            $itemCreate,
                                private ItemCustomFieldCreate $itemCustomFieldCreate)
    {
    }

    /**
     * @param $form
     * @param int $id
     * @return Item
     * @throws Exception
     */
    public function handle($form, int $id): Item
    {
        $this->validator->validate($form->getData());
        $item = $this->itemCreate->create($form, $id);
        $this->itemCustomFieldCreate->create($form, $id, $item);
        return $item;
    }
}
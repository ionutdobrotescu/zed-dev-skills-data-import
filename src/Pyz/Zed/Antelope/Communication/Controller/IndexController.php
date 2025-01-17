<?php

namespace Pyz\Zed\Antelope\Communication\Controller;

use Faker\Factory as FakerFactory;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AntelopeFacadeInterface getFacade()
 */
class IndexController extends AbstractController
{
    /**
     * @param Request $request
     * @return array<string,mixed>
     */
    public function addAction(Request $request): array
    {
        $antelopeTransfer = new AntelopeTransfer();
        $name = $request->get('name');
        if (!$name) {
            $name = FakerFactory::create()->name();
        }
        $antelopeTransfer->setName($name);
        $this->getFacade()->createAntelope($antelopeTransfer);
        return $this->viewResponse(['antelope' => $antelopeTransfer]);
    }
}

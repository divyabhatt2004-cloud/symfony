<?php

namespace App\TwigExtension;

use App\Repository\CartProductRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{


    public function getFunctions(): array
    {
        return [
            new TwigFunction('countCartProducts', $this->countCartProducts(...)),
            new TwigFunction('calculation', $this->calculation(...)),

        ];
    }

    public function __construct(
        private readonly CartProductRepository $cartProductRepository,
    )
    {

    }

    public function countCartProducts(): int
    {
        return $this->cartProductRepository->countProducts();
    }

    public function calculation($key): array
    {

        $total = $this->cartProductRepository->total();
//        dd($total("subtotal"));
//        $array =['subtotal'=> $total('subtotal'),'tax' => $total('gst'), 'grandTotal' => $total('total')];
        return  $total[$key];
    }
}

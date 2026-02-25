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

    public function calculation($key): int
    {
        $array =['subtotal'=> 2400,'tax' => 80, 'total' => 2480];
        return  $array[$key];
    }
}

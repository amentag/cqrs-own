<?php

namespace App\Controller;

use App\Common\Command;
use App\Product\Command\AddNewProductCommand;
use App\Product\Command\Handler\AddNewProductCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ProductController
 * @package App\Controller
 *
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("", name="product.create", methods={"POST"})
     */
    public function create(Request $request, AddNewProductCommandHandler $handler)
    {
        $handler->handle($this->getCommand(
            $request->getContent(),
            AddNewProductCommand::class
        ));

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @return object|Command
     */
    protected function getCommand(string $content, string $commandClass)
    {
        return $this->serializer->deserialize($content, $commandClass, 'json');
    }
}

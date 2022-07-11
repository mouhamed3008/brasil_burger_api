<?php
namespace App\Services;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProductDataPersister implements ContextAwareDataPersisterInterface
{
 
    public function __construct(
        EntityManagerInterface $entityManager,
      
        TokenStorageInterface $token,
        UploadFileService $uploadFile,
        RequestStack $requestStack
    
    ) {
        $this->_entityManager = $entityManager;
        $this->token = $token->getToken();
        $this->uploadFile = $uploadFile;
        $this->requestStack = $requestStack;
    
  
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Product;
    }

  
    public function persist($data, array $context = [])
    {

    

    dd($data->getMenus() );

        foreach ($data->getMenus() as $menu){
            dd($data->menus);
            $menu->setMenus($menu->menu);
            $data->addMenu($menu);
            // dd($data);
        }
        // dd('ok');
        // $request = $this->requestStack->getCurrentRequest();
        // if (!empty($request->files->all())) 
        // {
        //     $blob = $this->uploadFile->encodeImage();
        //     $data->setImage($blob);
        // }
        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
      
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $data->setIsActive(0);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}
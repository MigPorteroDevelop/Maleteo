<?php

namespace App\Controller;

use App\Entity\ComentariosMaleteo;
use App\Entity\ClientesMaleteo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MaleteoController extends AbstractController{

    /**
     * @Route("/", name="maleteo")
     */
    public function getMaleteo(){
        return $this->render("maleteo.html.twig");
    }

    /**
     * @Route("/maleteo", name="maleteo")
     */
    public function insertarCliente(Request $request, EntityManagerInterface $em){

        //recogemos los datos del formulario
        $nombre = $request->get('nombre');
        $email = $request->get('email');
        $ciudad = $request->get('ciudades');

       

        if($nombre){
            $cliente = new ClientesMaleteo();
            $cliente->setNombre($nombre);
            $cliente->setEmail($email);
            $cliente->setCiudad($ciudad);

            $em->persist($cliente);
            $em->flush();
           
        }

        $repo = $em->getRepository(ComentariosMaleteo::class);
        $comentarios = $repo->findAll();
        
        return $this->render("maleteo.html.twig",
        [
            'nombre' => $nombre,
            'email' => $email,
            'ciudad' => $ciudad,
            'comentarios' => $comentarios
        ]);
    }
    
    /**
     * @Route("/maleteo")
     */
    public function redireccionar(){
        return $this->render("comentarios.html.twig");
    }


}

?>
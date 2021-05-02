<?php
namespace App\Controller;
use App\Entity\Menu;
use App\Form\MenuType;

use App\Entity\Restaurant;
use App\Form\RestaurantType;

use App\Entity\PropertySearch;
use App\Form\PropretySearchType;
use App\Entity\MenuSerach;
use App\Form\MenuSearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
Use Symfony\Component\Routing\Annotation\Route;
class IndexController extends AbstractController
{

/**
 * @Route("/restaurant/save")
 */
public function save() {
    $entityManager = $this->getDoctrine()->getManager();
    $restaurant = new Restaurant();
    $restaurant->setIdResto(100);
    $restaurant->setNomResto('le bon gout');
    $restaurant->setAdresse('mourouj 4');
    $restaurant->setTelephone('92311568');
    $restaurant->setNomChef('chef yossri chihi');
    $restaurant->setNbEtoile(4);
   
    $entityManager->persist($restaurant);
    $entityManager->flush();
    return new Response('restaurant enregisté avec id '.$restaurant->getId());
    }
/**
 *@Route("/",name="restaurant_list")
 */
public function home(Request $request)
{
$propertySearch = new PropertySearch();
$form = $this->createForm(PropretySearchType::class,$propertySearch);
$form->handleRequest($request);
$articles= [];

if($form->isSubmitted() && $form->isValid()) {
//on récupère le nom de restaurant  tapé dans le formulaire
$NomResto = $propertySearch->getNomResto(); 
if ($NomResto!="")
//si on a fourni un nom de restaurant  on affiche tous les restaurant ayant ce nom
$articles= $this->getDoctrine()->getRepository(Restaurant::class)->findBy(['NomResto' => $NomResto] );
else 
//si si aucun nom n'est fourni on affiche tous les articles
$articles= $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
}
return $this->render('articles/index.html.twig',[ 'form' =>$form->createView(), 'articles' => $articles]); 
}


 /**
 * @IsGranted("ROLE_EDITOR")
 * @Route("/restaurant/new", name="new_restaurant")
 * Method({"GET", "POST"})
 */

public function new(Request $request) {
    $restaurant = new Restaurant();
    $form = $this->createForm(RestaurantType::class,$restaurant);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    $restaurant = $form->getData();
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($restaurant);
    $entityManager->flush();
    return $this->redirectToRoute('restaurant_list');
    }
    return $this->render('articles/new.html.twig',['form' => $form->createView()]);
    }
/**
 * @Route("/art_cat/", name="restaurant_par_menu")
 * Method({"GET", "POST"})
 */
public function restaurantParMenu(Request $request) {
    $menSearch = new MenuSerach();
    $form = $this->createForm(MenuSearchType::class,$menSearch);
    $form->handleRequest($request);
    $articles= [];
    if($form->isSubmitted() && $form->isValid()) {
    $menu = $menSearch->getMenu();
    
    if ($menu!="")
   $articles= $menu->getRestaurants();
    else 
    $articles= $this->getDoctrine()->getRepository(Restaurant::class)->findAll();
    }
    
    return $this->render('articles/restaurantParMenu.html.twig',['form' => $form->createView(),'articles' => $articles]);
    }











/**
 * @Route("/restaurant/{id}", name="restaurant_show")
 */
public function show($id) {
    $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)
    ->find($id);
    return $this->render('articles/show.html.twig',array('restaurant' => $restaurant));
     }
    
/**
 * @IsGranted("ROLE_EDITOR")
 * @Route("/restaurant/edit/{id}", name="edit_restaurant")
 * Method({"GET", "POST"})
 */
public function edit(Request $request, $id) {
    $restaurant = new Restaurant();
    $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
    
    $form = $this->createForm(RestaurantType::class,$restaurant);
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
    
    return $this->redirectToRoute('restaurant_list');
    }
    
    return $this->render('articles/edit.html.twig', ['form' =>$form->createView()]);
    }


/**
 * @IsGranted("ROLE_EDITOR")
 * @Route("/restaurant/delete/{id}",name="delete_restaurant")
 * @Method({"DELETE"})
 */
public function delete(Request $request, $id) {
    $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($restaurant);
    $entityManager->flush();
    
    $response = new Response();
    $response->send();
    return $this->redirectToRoute('restaurant_list');
    }
   /**
 * @Route("/menu/newMenu", name="new_menu")
 * Method({"GET", "POST"})
 */
 public function newCategory(Request $request) {
    $menu = new Menu();
    $form = $this->createForm(MenuType::class,$menu);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    $restaurant = $form->getData();
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($menu);
    $entityManager->flush();
    }
   return $this->render('articles/newMenu.html.twig',['form'=>$form->createView()]);
    }

}
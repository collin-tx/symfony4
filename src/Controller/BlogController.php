<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use src\Entity\BlogPost;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
  private const POSTS = [
    [
      'id' => 1,
      'slug' => 'hello-world',
      'title' => 'Hello World!'
    ],
    [
      'id' => 2,
      'slug' => 'another-post',
      'title' => 'This is another post!'
    ],
    [
      'id' => 3,
      'slug' => 'last-example',
      'title' => 'This is the last example, period.'
    ],
  ];

  /**
   * @Route("/{page}", name="blog_list")
   */

  public function list($page = 1, Request $request, $id)
  {
    // $limit = $request->get('limit', 10);
    // return $this->json(
    //   [
    //     'page' => $page,
    //     'limit' => $limit,
    //     'data' => array_map(function ($item) {
    //       return $this->generateUrl('blog_by_id', ['id' => $item['id']]);
    //     }, self::POSTS)
    //   ]
    // );

    $post = $this->getDoctrine()
    ->getRepository(BlogPost::class)
    ->find($id);


    return new Response($post);
  }

  /**
   * @Route("/{id}", name="blog_by_id", requirements={"id"="\d+"})
   */
  public function post($id)
  {
    // return $this->json(
    //   self::POSTS[array_search($id, array_column(self::POSTS, 'id'))]
    // );

    $post = $this->getDoctrine()
      ->getRepository(BlogPost::class)
      ->find($id);


      return new Response($post);



  }

  /**
   * @Route("/{slug}", name="blog_by_slug")
   */
  public function postBySlug($slug)
  {
    return $this->json(
      self::POSTS[array_search($slug, array_column(self::POSTS, 'slug'))]
    );
  }
}
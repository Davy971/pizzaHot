namespace OC\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\User;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
     /**
     * Lists all Users.
     *
     */
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }
    public function editAction(Request $request, User $id)
    {

        $editForm = $this->createForm('AppBundle\Form\UserType', $id);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($id);
            $em->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', array(
            'article' => $id,
            'edit_form' => $editForm->createView(),

        ));

}
<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class SignIn extends \Core\Controller
{
    public $dziala = null;
    
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('SignIn/index.html');
    }

    protected function before()
    {
        if (User::signIn(User::getLogin(), User::getPassword()))
        {
            // session_start();
        }       
    }

}

// <?php

    

//     if((!isset($_POST['login'])) || (!isset($_POST['password'])))
//     {
//         header('Location: index.php');
//         exit();
//     }

  
//     {


//         $login = htmlentities($login, ENT_QUOTES, "UTF-8");
//         //$password = htmlentities($password, ENT_QUOTES, "UTF-8");

                
//                 if (password_verify($password, $line['pass']))
//                 {
//                     $_SESSION['userlogged'] = true;
                
//                     $_SESSION['id'] = $line['id'];
//                     $_SESSION['user'] = $line['username'];

//                     unset($_SESSION['error']);
//                     $result->close();

//                     header('Location: show-balance.php');
//                 }
//                 else
//                 {
//                     $_SESSION['error'] = '<span style="color:red">Incorrect username or password!</span>';
//                     header('location: index.php');  
//                 }
//             }
//             else
//             {
//                 $_SESSION['error'] = '<span style="color:red">Incorrect username or password!</span>';
//                 header('location: index.php');
//             }
//         }

//         $connection->close();
//     }   

// ?>
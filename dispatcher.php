<?php
require_once "util/Authentication.php";

$action = ''; //dato che arriva via post per stabilire cosa fare es: insertProgetto
if(!empty($_POST)) {
    if(isset($_POST['action'])) {
        $action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING);
        dispatch($action);
    }
}

function dispatch($action)
{
    switch ($action) {
        case 'login':
            $username = '';
            $password = '';
            if(isset($_POST['username'])) {
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
                if(isset($_POST['password'])) {
                    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
                    $authentication = new Authentication();
                    $token = $authentication->login($username, $password);
                    setcookie('token',$token,time()+1200);
                    if($_SESSION['ruolo'] == 'ADMIN') {
                        header("Location: admin-dashboard.php");
                    } else if ($_SESSION['ruolo'] == 'USER') {
                        header("Location: user-dashboard.php");
                    }
                } else {
                    header("Location: index.php");
                }
            } else {
                header("Location: index.php");
            }
            break;
        case 'logout':
            session_destroy();
            setcookie('token','',0);
            header("Location: index.php");
            break;
        case 'insertQuestionario':
            $nomeQuestionario = '';
            $classe = '';
            if(isset($_POST['nomeQuestionario'])) {
                if(isset($_POST['classe'])) {
                    $nomeQuestionario = filter_input(INPUT_POST, 'nomeQuestionario', FILTER_SANITIZE_STRING);
                    $classe = $_POST['classe'];
                    require_once "controller/QuestionarioController.php";
                    require_once "controller/ClasseController.php";
                    require_once "model/Questionario.php";
                    require_once "model/Classe.php";
                    $questionarioController = new QuestionarioController();
                    $classeController = new ClasseController();
                    $classe = $classeController->read($classe);
                    $idQuestionario = str_replace("-","",$classe->getNomeClasse()).rand(0,100);
                    $questionario = new Questionario(
                        $idQuestionario,
                        $nomeQuestionario,
                        $classe
                    );
                    $questionarioController->insert($questionario);
                    setcookie("questionarioSelezionato", $questionario->getIdQuestionario());
                    header('Location: gestisci-questionario.php');
                }
            }
            break;
        case 'insertClasse':
            $nomeClasse = '';
            if(isset($_POST['nomeClasse'])){
                $nomeClasse = filter_input(INPUT_POST, 'nomeClasse', FILTER_SANITIZE_STRING);
                require_once "model/Classe.php";
                require_once "controller/ClasseController.php";
                $classe = new Classe(0, $nomeClasse);
                $classeController = new ClasseController();
                $classeController->insert($classe);
                setcookie("insrimentoClasse", $nomeClasse);
                header("Location: aggiungi-classe.php");
            }
            break;
        case 'mostraQuestionario':
            $idQuestionario = '';
            if(isset($_POST['questionario'])) {
                echo 'sonoqui';
                $idQuestionario = $_POST['questionario'];
                setcookie("questionarioSelezionato", $idQuestionario);
                header('Location: gestisci-questionario.php');
            }
            break;
        case 'deleteProgetto':
            $idProgetto = '';
            if(isset($_POST['progetto'])) {
                $idProgetto = $_POST['progetto'];
                require_once  "controller/ProgettoController.php";
                $progettoCotroller = new ProgettoController();
                $progettoCotroller->delete($idProgetto);
                header('Location: gestisci-questionario.php');
            }
            break;
        case 'insertProgetto':
            $nomeProgetto = '';
            $dettagliProgetto = '';
            $questionario = '';
            if(isset($_POST['nomeProgetto'])) {
                if(isset($_POST['dettagli'])) {
                    if(isset($_POST['questionario'])) {
                        $nomeProgetto = $_POST['nomeProgetto'];
                        $dettagliProgetto = $_POST['nomeProgetto'];
                        $questionario = $_POST['questionario'];
                        require_once "model/Progetto.php";
                        require_once "controller/ProgettoController.php";
                        require_once "controller/QuestionarioController.php";
                        $questionarioController = new QuestionarioController();
                        $progetto = new Progetto(
                            0,
                            $nomeProgetto,
                            $dettagliProgetto,
                            $questionarioController->read($questionario)
                        );
                        $progettoCotroller = new ProgettoController();
                        $progettoCotroller->insert($progetto);
                        header('Location: gestisci-questionario.php');
                    }
                }
            }
            break;
    }
}
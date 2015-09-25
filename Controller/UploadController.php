<?php
namespace edcBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use edcBundle\Utilidades\Document;
use edcBundle\Entity\ficheros;

class UploadController extends Controller
{
	public function indexAction()
	{
		// return $this->render('edcBundle:Default:index.html.twig');
	}

	// ****************************************
	public function subiendo($fichSubir, $descripcion) {
		if (($fichSubir instanceof UploadedFile) && ($fichSubir->getError() == '0'))
		{
			$originalName = $fichSubir->getClientOriginalName();
			$name_array = explode('.', $originalName);
			$file_type = $name_array[sizeof($name_array) - 1];
			$valid_filetypes = array('jpg', 'jpeg');
			if(in_array(strtolower($file_type), $valid_filetypes))
			{
				$document = new Document();
				$document->setFile($fichSubir);
				$document->setSubDirectory('ficheros');
				$nomDefinitivo = "1234_".$originalName; // por ejemplo el id de un usuario
				// Si queremos q lo guarde con un nombre al azar entonces será:
				// $nomDefinitivo = $fichSubir->getFilename();
				$document->processFile($nomDefinitivo);
				
				// Una vez subido, meterlo en la BD
				$ficheroAux = new ficheros();
				$ficheroAux->setDescFichero($descripcion);
				$ficheroAux->setNomFichero($nomDefinitivo);
				
				$em = $this->getDoctrine()->getManager();
				$em->persist($ficheroAux);
				$em->flush();
				//redireccinar
				$this->get('session')->getFlashBag()->add(
						'mensaje',
						'El archivo '.$originalName.' se ha subido correctamente'
				);
				//redirecciono
				return $this->redirect($this->generateUrl('subirArchivo'));
			}else
			{
				$this->get('session')->getFlashBag()->add(
						'mensaje',
						'la extensión del archivo no es la correcta'
				);
				//redireccionar
				return $this->redirect($this->generateUrl('subirArchivo'));
			}
		}else
		{
			$this->get('session')->getFlashBag()->add(
					'mensaje',
					'"no entró o se produjo algún error inesperado'
			);
			//redireccionar
			return $this->redirect($this->generateUrl('subirArchivo'));
			//die("no entró o se produjo algún error inesoperado");
		}
	}
	
	// **************************************************
	public function subirArchivoAction(Request $request)
	{
		if ($request->getMethod() == 'POST') 
        {
             $arrArchivos = $request->files->get('archivo');
             $arrDescArchivo = $_POST["descArchivo"];
             $cont = 0;
             foreach ($arrArchivos as $clave => $valor) {
             	$this->subiendo($valor, $arrDescArchivo[$cont]);
             	$cont++;
             }
        }
        return $this->render('edcBundle:Upload:subirArchivo.html.twig');
	}
}
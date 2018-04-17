<?php
namespace OCA\Editor\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\ContentSecurityPolicy;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\JSONResponse;

use OCA\Editor\Db\File;
use OCA\Editor\Db\FileMapper;

class PageController extends Controller {
	private $mapper;

	public function __construct($AppName, IRequest $request, FileMapper $mapper){
		parent::__construct($AppName, $request);
		$this->mapper = $mapper;
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index() {


	 
		$tmpl = new TemplateResponse($this->appName, 'index');//, [
         //   'appName'            => $this->appName,
        //], '');

        $policy = new ContentSecurityPolicy();
        $policy->addAllowedChildSrcDomain('*');
        $policy->addAllowedFrameDomain('*');
        $policy->addAllowedScriptDomain('*');
        $policy->allowInlineStyle(true);
        $policy->addAllowedStyleDomain('*');
        $policy->addAllowedFontDomain('*');
        $tmpl->setContentSecurityPolicy($policy);



       return $tmpl;
		//return new TemplateResponse('editor', 'index');  // templates/index.php
	}
	/*
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function getfiles() {
		$tmpl = new JSONResponse($this->mapper->findAll());//, [
         //   'appName'            => $this->appName,
        //], '');

       return $tmpl;
		//return new TemplateResponse('editor', 'index');  // templates/index.php
	}
	/*
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function getfile($id) {
		$tmpl = new JSONResponse($this->mapper->find($id));//, [
         //   'appName'            => $this->appName,
        //], '');

       return $tmpl;
		//return new TemplateResponse('editor', 'index');  // templates/index.php
	}
	/*
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function setfile($title, $content) {
		$file = new File();
		$file->setTitle($title);
		$file->setContent($content);

		$tmpl = new JSONResponse($this->mapper->insert($file));//, [
         //   'appName'            => $this->appName,
        //], '');

       return $tmpl;
		//return new TemplateResponse('editor', 'index');  // templates/index.php
	}
	/*
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function destroyfile($id) {
		 try 
		 {
             $file = $this->mapper->find($id);
         } 
         catch(Exception $e) 
         {
             return new DataResponse([], Http::STATUS_NOT_FOUND);
         }
         $this->mapper->delete($file);
         $tmpl = new JSONResponse($file);
         return $tmpl;
	}
	/*
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function updatefile($id, $title, $content) {
		 try 
         {
             $file = $this->mapper->find($id);//$id);
         } 
         catch(Exception $e) 
         {
             return new DataResponse([], Http::STATUS_NOT_FOUND);
         }
         $file->setTitle($title);
         $file->setContent($content);
         $tmpl = new JSONResponse($this->mapper->update($file));

         return $tmpl;
	}
}

<?php
namespace Base\Controller;

use RuntimeException;
use Base\Controller\AbstractFormController;
use Zend\View\Model\ViewModel;

/**
 * Class AbstractCrudController
 * @package Base\Controller
 */
abstract class AbstractCrudController extends AbstractFormController
{
    const INT_ITENS_PER_PAGE = 10;

    /**
     * Index - Lista Resultados
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $arrForPagination = $this->getParamsForPagination();

        $arrDataPaged = $this->getService()->getRepository()->findBy(
            [],
            [],
            $arrForPagination['intItensPerPage'],
            $arrForPagination['intOffset']
        );

        return new ViewModel(
            [
                'data' => $arrDataPaged,
                'page' => $arrForPagination['intPage'],
                'flashMessenger' => $this->flashMessenger()
            ]
        );
    }

    /**
     * InserirAction
     *
     * @return ViewModel
     */
    public function inserirAction()
    {
        $form = $this->getForm();
        $service = $this->getService();

        $objRequest = $this->getRequest();

        if ($objRequest->isPost()) {
            $form->setData($objRequest->getPost());
            if ($form->isValid()) {
                try {
                    $resultOfInsert = $service->save($form->getData());
                    if ($resultOfInsert instanceof $this->strEntity) {
                        $this->flashMessenger()->addSuccessMessage('Cadastrado com sucesso!');

                        return $this->redirect()
                            ->toRoute($this->route, array('controller' => $this->controller, 'action' => 'index'));
                    }
                } catch (\Exception $objException) {
                    $this->flashMessenger()->addErrorMessage($objException->getMessage());
                }

                return $this->redirect()->toRoute(
                    $this->route,
                    array('controller' => $this->controller, 'action' => 'editar')
                );
            } else {
                $this->flashMessenger()->addErrorMessage(
                    "Formulário inválido, verifique os dados inseridos e tente novamente"
                );

                return new ViewModel([
                    'form' => $form
                ]);
            }
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    /**
     * Edita um registro
     */
    public function editarAction()
    {
        $form = $this->getForm();
        $service = $this->getService();
        $intIdFromRoute = $this->params()->fromRoute('id', 0);
        $entityForEdit = $service->find((int)$intIdFromRoute);

        if (!$entityForEdit) {
            $this->flashMessenger()->addErrorMessage('Não foi encontrado o resgistro.');

            return new ViewModel([
                'form' => $form,
                'id' => $intIdFromRoute
            ]);
        }

        $objRequest = $this->getRequest();

        if ($objRequest->isPost()) {
            $form->setData($objRequest->getPost());
            if ($form->isValid()) {
                $arrDataForEdit = $form->getData();
                $arrDataForEdit['id'] = (int)$intIdFromRoute;
                try {
                    if ($service->save($arrDataForEdit)) {
                        $this->flashMessenger()->addSuccessMessage('Atualizado com sucesso!');
                    }
                } catch (\Exception $objException) {
                    $this->flashMessenger()->addErrorMessage($objException->getMessage());
                }

                return $this->redirect()->toRoute(
                    $this->route,
                    array('controller' => $this->controller, 'action' => 'editar', 'id' => $intIdFromRoute)
                );
            } else {
                $this->flashMessenger()->addErrorMessage(
                    "Formulário inválido, verifique os dados inseridos e tente novamente"
                );

                return new ViewModel([
                    'form' => $form,
                    'id' => $intIdFromRoute
                ]);
            }
        }

        $form->setData($entityForEdit->toArray());

        return new ViewModel([
            'form' => $form,
            'id' => $intIdFromRoute
        ]);
    }

    /**
     * Exclui um registro
     *
     * @return \Zend\Http\Response
     */
    public function excluirAction()
    {
        $service = $this->getService();
        $id = $this->params()->fromRoute('id', 0);

        if ($service->remove(array('id' => $id))) {
            $this->flashMessenger()->addSuccessMessage('Registro deletado com sucesso!');
        } else {
            $this->flashMessenger()->addErrorMessage('Não foi possivel deletar o registro!');
        }

        return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
    }

    /**
     * Metodo para recuperar dados para realizar a paginacao
     *
     * @return array
     */
    public function getParamsForPagination()
    {
        $arrParamsForCreatePagination = $this->getRequest()->isPost()
            ? $this->getRequest()->getPost()
            : $this->params()->fromRoute();

        $intPage = $this->getIntPage($arrParamsForCreatePagination);
        $intItensPerPage = $this->getIntItensPerPage($arrParamsForCreatePagination);
        $intOffset = $intPage * $intItensPerPage;

        return [
            'intPage' => $intPage,
            'intItensPerPage' => $intItensPerPage,
            'intOffset' => $intOffset
        ];
    }

    /**
     * Atraves de um array, recupere o valor de intPage ou retorne 0
     *
     * @param $arrParams
     *
     * @return int
     */
    public function getIntPage($arrParams)
    {
        return (isset($arrParams['intPage']) && ($arrParams['intPage'] > 0))
            ? (int)($arrParams['intPage'] - 1)
            : 0;
    }


    /**
     * Atraves de um array, recupere o valor de intItensPerPage ou retorne 0
     *
     * @param $arrParams
     *
     * @return int
     */
    public function getIntItensPerPage($arrParams)
    {
        return (isset($arrParams['intItensPerPage']) && ($arrParams['intItensPerPage'] > 0))
            ? (int)$arrParams['intItensPerPage']
            : self::INT_ITENS_PER_PAGE;
    }
}

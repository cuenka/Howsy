<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GoogleMapsApi;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RestController
 * @package App\Controller
 */
class RestController extends Controller
{
    /**
     * Return a list of companies or employees depending of parameter type
     * @param Request $request
     * @return Response
     * @Route("/rest/list-all", name="rest_list_all", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of all properties",
     * )
     */
    public function listAll(Request $request)
    {
        try {

            $entityManager = $this->getDoctrine()->getManager();
            $properties = $entityManager->getRepository(Property::class)->findAllPropertiesAsArray();

            return new JsonResponse($properties, Response::HTTP_OK);
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Return a list of properties depending of parameters
     * @param Request $request
     * @return Response
     * @Route("/rest/list-property", name="rest_list_property", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of all properties that match parameters",
     * )
     */
    public function listProperty(ValidatorInterface $validator, Request $request)
    {
        try {
            if ($request->isXmlHttpRequest()) {
                $parameters = json_decode($request->getContent(), true);
                $paramValidator = $this->get('app.service.property_validator');

                if ($paramValidator->isValid($parameters) === false) {
                    return new JsonResponse('At least 1 of the parameters is not valid', Response::HTTP_BAD_REQUEST);
                }
                $cleanParameters = $paramValidator->validateRequestLite($parameters);
                $entityManager = $this->getDoctrine()->getManager();
                $properties = $entityManager->getRepository(Property::class)->findBySearch($cleanParameters);

                return new JsonResponse($properties, Response::HTTP_OK);
            } else {
                return new JsonResponse("Invalid request", Response::HTTP_BAD_REQUEST);
            }
        } catch (\Exception $exception) {
            return new JsonResponse($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Create and Persist a new property
     * Return OK and status 201 if the data is correct or 400
     * @param Request $request
     * @return JsonResponse
     * @Route("/rest/add", name="rest_add", methods={"POST"})
     * @SWG\Response(
     *     response=200,
     *     description="Information persisted"
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Information not persisted, missing mandatory data or not validated"
     * )
     * @SWG\Parameter(
     *     name="addressline1",
     *     in="body",
     *     type="string",
     *     description="address line 1 of Property",
     *     @SWG\Schema(type="string")
     * )
     * @SWG\Parameter(
     *     name="addressline2",
     *     in="body",
     *     type="string",
     *     description="(* Not Mandatory)address line 2 of Property",
     *     @SWG\Schema(type="string")
     * )
     * @SWG\Parameter(
     *     name="city",
     *     in="body",
     *     type="string",
     *     description="(* Not Mandatory), city",
     *     @SWG\Schema(type="string")
     * )
     * @SWG\Parameter(
     *     name="postcode",
     *     in="body",
     *     type="string",
     *     description="(* Not Mandatory) postcode",
     *     @SWG\Schema(type="string")
     * )
     * )
     */
    public function add(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $parameters = json_decode($request->getContent(), true);
        $paramValidator = $this->get('app.service.property_validator');
        if ($paramValidator->isValid($parameters) === false) {
            return new JsonResponse('At least 1 of the parameters is not valid', Response::HTTP_BAD_REQUEST);
        }
        $cleanParameters = $paramValidator->validateRequest($parameters);
        $googleMapsApi = $this->get('app.service.google_maps_api');
        $googleMapsApi->getData($cleanParameters);
        $property = new Property();
        $property->setAddressLine1($cleanParameters['addressline1'])
            ->setAddressLine2($cleanParameters['addressline2'])
            ->setCity($cleanParameters['city'])
            ->setPostCode($cleanParameters['postcode'])
            ->setLatitude($googleMapsApi->getLatitude())
            ->setLongitude($googleMapsApi->getLongitude());

        $entityManager->persist($property);
        $entityManager->flush();

        return new JsonResponse('OK', Response::HTTP_CREATED);
    }
}

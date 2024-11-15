<?php

namespace App\Http\Controllers\Annotations ;

/**
 * @OA\Security(
 *     security={
 *         "BearerAuth": {}
 *     }),

 * @OA\SecurityScheme(
 *     securityScheme="BearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"),

 * @OA\Info(
 *     title="Your API Title",
 *     description="Your API Description",
 *     version="1.0.0"),

 * @OA\Consumes({
 *     "multipart/form-data"
 * }),

 *

 * @OA\GET(
 *     path="/api/professionnel/prestations/1",
 *     summary="Liste des prestation par prof",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Prestations"},
*),


 * @OA\GET(
 *     path="/api/prestations/{prestation}",
 *     summary="Detail prestation",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Prestations"},
*),


 * @OA\DELETE(
 *     path="/api/prestations/{id}",
 *     summary="Supprimer une prestation",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="204", description="Deleted successfully"),
 * @OA\Response(response="401", description="Unauthorized"),
 * @OA\Response(response="403", description="Forbidden"),
 * @OA\Response(response="404", description="Not Found"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Prestations"},
*),


 * @OA\PUT(
 *     path="/api/prestations/{id}",
 *     summary="Modifier une prestation",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/x-www-form-urlencoded",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="id", type="integer"),
 *                     @OA\Property(property="libelle", type="string"),
 *                     @OA\Property(property="description", type="string"),
 *                     @OA\Property(property="prix", type="integer"),
 *                     @OA\Property(property="duree", type="string"),
 *                     @OA\Property(property="categorie_id", type="integer"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Prestations"},
*),


 * @OA\POST(
 *     path="/api/prestations",
 *     summary="Ajouter une prestation",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="201", description="Created successfully"),
 * @OA\Response(response="400", description="Bad Request"),
 * @OA\Response(response="401", description="Unauthorized"),
 * @OA\Response(response="403", description="Forbidden"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *                 type="object",
 *                 properties={
 *                     @OA\Property(property="libelle", type="string"),
 *                     @OA\Property(property="type_prestation", type="string"),
 *                     @OA\Property(property="description", type="string"),
 *                     @OA\Property(property="categorie_id", type="integer"),
 *                     @OA\Property(property="duree", type="string"),
 *                     @OA\Property(property="type_prix", type="string"),
 *                     @OA\Property(property="prix", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Prestations"},
*),


 * @OA\GET(
 *     path="/api/prestations",
 *     summary="Afficher les prestations",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Prestations"},
*),


*/

 class PrestationsAnnotationController {}

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
 *     path="/api/produits/{produit}",
 *     summary="Detail produit",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Produits"},
*),


 * @OA\DELETE(
 *     path="/api/produits/{id}",
 *     summary="Supprimer un produit",
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
 *     tags={"Produits"},
*),


 * @OA\PUT(
 *     path="/api/produits/{id}",
 *     summary="Modifier  un produit",
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
 *                     @OA\Property(property="nom", type="string"),
 *                     @OA\Property(property="description", type="string"),
 *                     @OA\Property(property="image", type="string"),
 *                     @OA\Property(property="professionnel_id", type="integer"),
 *                     @OA\Property(property="categorie_id", type="integer"),
 *                     @OA\Property(property="prix", type="string"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Produits"},
*),


 * @OA\POST(
 *     path="/api/produits",
 *     summary="Ajouter un produit",
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
 *                     @OA\Property(property="nom", type="string"),
 *                     @OA\Property(property="description", type="string"),
 *                     @OA\Property(property="image", type="string"),
 *                     @OA\Property(property="prix", type="integer"),
 *                     @OA\Property(property="professionnel_id", type="integer"),
 *                     @OA\Property(property="categorie_id", type="integer"),
 *                 },
 *             ),
 *         ),
 *     ),
 *     tags={"Produits"},
*),


 * @OA\GET(
 *     path="/api/produits",
 *     summary="Afficher  la liste des produits",
 *     description="",
 *         security={
 *    {       "BearerAuth": {}}
 *         },
 * @OA\Response(response="200", description="OK"),
 * @OA\Response(response="404", description="Not Found"),
 * @OA\Response(response="500", description="Internal Server Error"),
 *     @OA\Parameter(in="header", name="User-Agent", required=false, @OA\Schema(type="string")
 * ),
 *     tags={"Produits"},
*),


*/

 class ProduitsAnnotationController {}

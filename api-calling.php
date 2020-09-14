<?php
/**
Plugin Name: API calling
description: >-
  Add API information using shortcode
Version: 1.0
Author: armoodillo
License: GNUv3.0
Text Domain: beside.ci-uat.net
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function callAPI($method, $url, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'username: website_caller',
      'password: W3bs1t#_call#r',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}




//create members

$data_array =  array(
    "firstName" => $user['first_name'],
    "lastName": "Test_LastName",
    "languageCode": "en",
    "dateOfBirth": "1998-03-18T02:54:03.030+0200",
    "salutationCode": "MALE",
    "nationalityCode": "ae",
    "telephoneList" => array[
        {
            "telephoneNumber"  => $this->request->data['mobile_number'],
            "countryCode": "ae",
            "telephoneType": "MOBILE",
            "isPrimary": true,
            "attributes": [
                {
                    "attributeName": "HASVERIFIEDMOBILE",
                    "attributeValue": "true",
                    "dataType": "BOOLEAN"
                }
            ]
        }
    ],
    "emailList": [
        {
            "emailAddress": "qivostest@qivos.com",
            "isPrimary": true
        }
    ],
    "consentList": [
        {
            "name": "EMAIL",
            "flag": true,
            "metadata": [
                {
                    "key": "User-Agent",
                    "value": "Chrome"
                },
                {
                    "key": "Source",
                    "value": "WEBSITE"
                }
            ]
        },
        {
            "name": "SMS",
            "flag": true,
            "metadata": [
                {
                    "key": "User-Agent",
                    "value": "Chrome"
                },
                {
                    "key": "Source",
                    "value": "WEBSITE"
                }
            ]
        },
        {
            "name": "VIBER",
            "flag": true,
            "metadata": [
                {
                    "key": "User-Agent",
                    "value": "Chrome"
                },
                {
                    "key": "Source",
                    "value": "WEBSITE"
                }
            ]
        }
    ],
    "loyaltyMembershipData": [
        {
            "schemaCode": "0000",
            "registrationCountryCode": "ae",
            "category": "WHITE",
            "registrationSource": "WEBSITE",
            "passwordData": {
                "password": "zxcv1234",
                "credentialCode": "DEFAULT"
            },
            "attributes": [
                {
                    "attributeName": "HAS_DOWNLOAD_MOBILE_APP",
                    "attributeValue": "false",
                    "dataType": "BOOLEAN"
                },
                {
                    "attributeName": "HAS_UPDATED_DETAILS",
                    "attributeValue": "true",
                    "dataType": "BOOLEAN"
                },
                {
                    "attributeName": "CANREDEEM",
                    "attributeValue": "false",
                    "dataType": "BOOLEAN"
                }
            ],
            "loyaltyCardData": {
                "type": "Permanent"
            }
        }
    ]
    


    
    );
    
    
          
          
$make_call = callAPI('POST', 'https://beside.ci-uat.net/qc-api/v1.0/persons', json_encode($data_array));
$response = json_decode($make_call, true);
$errors   = $response['response']['errors'];
$data     = $response['response']['data'][0];










?>

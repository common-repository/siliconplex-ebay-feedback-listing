<?php 

/**
 * @package  SpEbay
 
 * Powered by Siliconplex
 * Contact: Usama Ayaz
 * Email: usama.ayaz@siliconplex.com
 * Website: http://www.siliconplex.com

 * 
 */


 
namespace SpEFLInc\Api;

class EbayFeedbacksApi
{
 
 private $secretKey = 'SP EBAY FEEDBACKS REVIEWS'; 

 public function getSecretKey(){
      return $this->secretKey;
 }	 

 public function SpEbayFeedbackHandler(){

            if (isset($_POST['page'])) {
              $page = (int)$_POST['page'];
            } else {
              $page = 1;
            }

            check_ajax_referer( $this->getSecretKey() );
           
            $user_id = get_option('sp_ebay_auth_user_id');
            $token = get_option('sp_ebay_auth_token');
            $client_id = get_option('sp_ebay_auth_app_id');
            $client_secret = get_option('sp_ebay_auth_cert_id');
            $dev_id = get_option('sp_ebay_auth_dev_id');


            $xmlRequest = '<?xml version="1.0" encoding="utf-8" ?>
            <GetFeedbackRequest xmlns="urn:ebay:apis:eBLBaseComponents">
              <RequesterCredentials>
              <eBayAuthToken>'.$token.'</eBayAuthToken>
              </RequesterCredentials>
              <UserID>'.$user_id.'</UserID>
              <DetailLevel>ReturnAll</DetailLevel>
              <FeedbackType>FeedbackReceivedAsSeller</FeedbackType>
              <Pagination>
                  <EntriesPerPage>10</EntriesPerPage>
                  <PageNumber>'.$page.'</PageNumber>
              </Pagination>
            </GetFeedbackRequest>';

            $endpoint = "https://api.ebay.com/ws/api.dll";
            
            $result = wp_remote_post( 
              $endpoint, 
                array(
                    'method' => "POST",
                    'timeout' => 300,
                    'redirection' => 5,
                    'httpversion' => '1.0',
                    'headers' => array(
                            'X-EBAY-API-CALL-NAME'=> 'GetFeedback',
                            'X-EBAY-API-SITEID'=> 3,
                            'X-EBAY-API-DEV-NAME'=>$dev_id,
                            'X-EBAY-API-APP-NAME'=>$client_id,
                            'X-EBAY-API-CERT-NAME'=>$client_secret,
                            'X-EBAY-API-COMPATIBILITY-LEVEL'=>863,
                            'X-EBAY-API-DETAIL-LEVEL' => 0,
                            'Content-Type'=>'text/xml'
                    ),
                    'body' => $xmlRequest,
                    'sslverify' => false
                )
            );
           
            if(is_wp_error($result)){
              $rs = array("Errors"=>array("LongMessage"=>"HTTP API Call Error"));
              $json = json_encode($rs);

            }else{
              $xml = simplexml_load_string($result['body']); // where $xml_string is the XML data you'd like to use (a well-formatted XML string). If retrieving from an external source, you can use file_get_contents to retrieve the data and populate this variable.
              $json = json_encode($xml); // convert the XML string to JSON
              
            }
            
            echo $json;
           
            // Handle the ajax request
            wp_die(); // All ajax handlers die when finished

    }




  }
<?php
namespace ReviewExpressApi;

use GuzzleHttp\Client;

class ReviewExpressApi
{
    /**
     * Url prefix
     */
    const URL_PREFIX = "https://api.tripadvisor.com/api/partner/1.0";

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Review Express API key
     *
     * @var string
     */
    protected $api_key;

    /**
     * Constructor
     *
     * @param string $api_key Your TripAdvisor Review Express API Key
     */
    public function __construct($api_key)
    {
        $this->client = new Client([
            'base_uri' => self::URL_PREFIX,
            'headers' => ['X-TripAdvisor-API-Key' => $api_key]
        ]);

        $this->api_key = $api_key;
    }

    /**
     * Create new email requests.
     *
     * @param array $body Request body
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function create(array $body)
    {
        return $this->client->post("email_requests", [
            'json' => $body
        ]);
    }

    /**
     * List the data for a single email request by request id.
     *
     * @param int $request_id The request id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listByRequestId($request_id)
    {
        return $this->client->get("email_requests/" . $request_id);
    }

    /**
     * List the data for a email request by partner request id.
     *
     * @param string $partner_request_id The partner request id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listByPartnerRequestId($partner_request_id)
    {
        return $this->client->get("email_requests", [
            'query' => ['partner_request_id' => $partner_request_id]
        ]);
    }

    /**
     * List the data for a email request by location id.
     *
     * @param string $location_id The location id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function listByLocationID($location_id)
    {
        return $this->client->get("email_requests", [
            'query' => ['location_id' => $location_id]
        ]);
    }

    /**
     * Update existing requests by request id.
     *
     * @param int   $request_id The request id
     * @param array $body       The request body
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateByRequestId($request_id, array $body)
    {
        return $this->client->put("email_requests/" . $request_id, [
            'json' => $body
        ]);
    }

    /**
     * Update existing requests by partner request id.
     *
     * @param string $partner_request_id The partner request id
     * @param array  $body               The request body
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateByPartnerRequestId($partner_request_id, array $body)
    {
        return $this->client->put("email_requests", [
            'query' => ['partner_request_id' => $partner_request_id],
            'json' => $body
        ]);
    }

    /**
     * Update existing requests in the batch form.
     *
     * @param array $body The request body
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function updateBatch(array $body)
    {
        return $this->client->put("email_requests", [
            'json' => $body
        ]);
    }

    /**
     * Cancel email requests by request id.
     *
     * @param int $request_id The request id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function cancelByRequestId($request_id)
    {
        return $this->client->delete("email_requests/" . $request_id);
    }

    /**
     * Cancel email requests by partner request id.
     *
     * @param string $partner_request_id The partner request id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function cancelByPartnerRequestId($partner_request_id)
    {
        return $this->client->put("email_requests/", [
            'query' => ['partner_request_id' => $partner_request_id]
        ]);
    }

    /**
     * Cancel email requests in the batch form.
     *
     * @param array $body The body request body
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function cancelBatch(array $body)
    {
        return $this->client->put("email_requests", [
            'json' => $body
        ]);
    }


    /**
     * Check if your mapped hotels have opted-in to the Review Express program.
     *
     * @return mixed
     */
    public function checkStatusAll()
    {
        return $this->client->get("location_mappings" , [
            'query' => ['key' => $this->api_key]
        ]);
    }

    /**
     * Check if your mapped hotels have opted-in to the Review Express program.
     * By opted in current status.
     *
     * @param bool $opted_in Current status.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function checkStatusByOptedIn($opted_in = true)
    {
        return $this->client->get("location_mappings", [
            'query' => ['key' => $this->api_key, "review_express_opted_in" => $opted_in]
        ]);
    }

    /**
     * Check if your mapped hotels have opted-in to the Review Express program.
     * By partner id
     *
     * @param string $partner_id The partner id.
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function checkStatusByPartnerId($partner_id)
    {
        return $this->client->get("location_mappings/" . $partner_id, [
            'query' => ['key' => $this->api_key]
        ]);
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::URL_PREFIX;
    }
}

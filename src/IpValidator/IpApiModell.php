<?php


namespace Frbr18\IpValidator;

class IpApiModell
{
    public function getIpInfo($ipPost)
    {
        // Checks if ip-address is valid ipv4 or ipv6
        $validIpv4 = (filter_var($ipPost, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) ? "Valid" : "Invalid";
        $validIpv6 = (filter_var($ipPost, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) ? "Valid" : "Invalid";
        //Checks if the ip-address has domain
        $domain = ($validIpv4 == "Valid" || $validIpv6 == "Valid") ? gethostbyaddr($ipPost) : "No domain";
        // Set up the data for the view
        $json = [
            "ip" => $ipPost,
            "validIpv4" => $validIpv4,
            "validIpv6" => $validIpv6,
            "domain" => $domain,
        ];
        return $json;
    }

    public function getIpStack($ip)
    {
        if (!$ip) {
            $ip = "82.209.144.136";
        }
        $curl = curl_init();
        $url = "http://api.ipstack.com/" . $ip . "?access_key=3b87b7c70d0dc72a0f11b8164a883847";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 4);
        $data = json_decode(curl_exec($curl));
        $json = [
            "ip" => $data->ip,
            "latitude" => $data->latitude,
            "longitude" => $data->longitude,
            "type" => $data->type,
            "country" => $data->country_name,
            "city" => $data->city
        ];
        return $json;
    }
}

Port API Module
---

## Port::**create**
Create a new Port object

* **URL**: https://www.x4b.net/apiv2/Port/create
* **URL Params**: 

    **value[lower]** - int: the numerical port (low) on the filter side

    **value[upper]** - int: the numerical port (upper) on the filter side

    **value[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

    **value[domain]** - string: domain name (optional) - (HTTP/HTTPS) only

    **value[method]** - string: the backend communication method of the port. e.g tunnel or rp

    **value[region]** - int: the region ID this port applies to, can be null if applies to all service regions

    **value[lease]** - int: The lease ID linked to

    **value[lb_method]** - string: the LB method (default, ip_hash, least_conn)

    **value[backend_mode]** - string: the backend mode (simple, lb)

    **value[type]** - string: entry type single, range or dmz

    **value[backend]** - object: matching the syntax of the PortBackend module

    **value[backends]** - array: array of the above backend

    **value[backend_protocol]** - string: protocol used when communicating with the backend, ssl or default - (HTTP/HTTPS) only

    **value[keepalive]** - int: maximum number of idle connections to keep open to the backend ready for new clients - (HTTP/HTTPS) only

* **Returns**: 
```
{
    "status": "ok"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Port::**bulk**
method not documented

## Port::**insert**
Synonym for Create

* **URL**: https://www.x4b.net/apiv2/Port/insert
* **URL Params**: see create
* **Returns**: see create
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Port::**get**
Get the value of a Port object matching a query

* **URL**: https://www.x4b.net/apiv2/Port/get
* **URL Params**: 

    **query[id]** - int: ID of the Port object

    **query[lower]** - int: the numerical port (low) on the filter side

    **query[upper]** - int: the numerical port (upper) on the filter side

    **query[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

    **query[domain]** - string: the protocol of the port. e.g http, ftp, tcp

    **query[method]** - string: the backend communication method of the port. e.g tunnel or rp

    **query[region]** - int: the region ID this port applies to, can be null if applies to all service regions

    **query[lease]** - int: The lease ID linked to

    **query[lb_method]** - string: the LB method (default, ip_hash, least_conn)

    **query[backend_mode]** - string: the backend mode (simple, lb)

    **query[backend_protocol]** - not documented

    **query[keepalive]** - not documented

* **Returns**: 
```
{
    "id": "int: ID of the Port object",
    "lower": "int: the numerical port (low) on the filter side",
    "upper": "int: the numerical port (upper) on the filter side",
    "protocol": "string: the protocol of the port. e.g http, ftp, tcp",
    "domain": "string: domain name (optional) - (HTTP\/HTTPS) only",
    "method": "string: the backend communication method of the port. e.g tunnel or rp",
    "region": "int: the region ID this port applies to, can be null if applies to all service regions",
    "lease": "int: The lease ID linked to",
    "lb_method": "string: the LB method (default, ip_hash, least_conn)",
    "backend_mode": "string: the backend mode (simple, lb)",
    "fw": "int: ID of the Firewall Profile",
    "type": "string: entry type single, range or dmz",
    "backend": "object: matching the syntax of the PortBackend module",
    "backends": "array: array of the above backend",
    "backend_protocol": "string: protocol used when communicating with the backend, ssl or default - (HTTP\/HTTPS) only",
    "keepalive": "int: maximum number of idle connections to keep open to the backend ready for new clients - (HTTP\/HTTPS) only"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Port::**update**
Change the values in a Port object

* **URL**: https://www.x4b.net/apiv2/Port/update
* **URL Params**: 

    **query[id]** - int: ID of the Port object

    **query[lower]** - int: the numerical port (low) on the filter side

    **query[upper]** - int: the numerical port (upper) on the filter side

    **query[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

    **query[domain]** - string: the protocol of the port. e.g http, ftp, tcp

    **query[method]** - string: the backend communication method of the port. e.g tunnel or rp

    **query[region]** - int: the region ID this port applies to, can be null if applies to all service regions

    **query[lease]** - int: The lease ID linked to

    **query[lb_method]** - string: the LB method (default, ip_hash, least_conn)

    **query[backend_mode]** - string: the backend mode (simple, lb)

    **query[backend_protocol]** - not documented

    **query[keepalive]** - not documented

    **value[lower]** - int: the numerical port (low) on the filter side

    **value[upper]** - int: the numerical port (upper) on the filter side

    **value[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

    **value[domain]** - string: domain name (optional) - (HTTP/HTTPS) only

    **value[method]** - string: the backend communication method of the port. e.g tunnel or rp

    **value[region]** - int: the region ID this port applies to, can be null if applies to all service regions

    **value[lease]** - int: The lease ID linked to

    **value[lb_method]** - string: the LB method (default, ip_hash, least_conn)

    **value[backend_mode]** - string: the backend mode (simple, lb)

    **value[type]** - string: entry type single, range or dmz

    **value[backend]** - object: matching the syntax of the PortBackend module

    **value[backends]** - array: array of the above backend

    **value[backend_protocol]** - string: protocol used when communicating with the backend, ssl or default - (HTTP/HTTPS) only

    **value[keepalive]** - int: maximum number of idle connections to keep open to the backend ready for new clients - (HTTP/HTTPS) only

* **Returns**: 
```
{
    "id": "int: ID of the Port object",
    "lower": "int: the numerical port (low) on the filter side",
    "upper": "int: the numerical port (upper) on the filter side",
    "protocol": "string: the protocol of the port. e.g http, ftp, tcp",
    "domain": "string: domain name (optional) - (HTTP\/HTTPS) only",
    "method": "string: the backend communication method of the port. e.g tunnel or rp",
    "region": "int: the region ID this port applies to, can be null if applies to all service regions",
    "lease": "int: The lease ID linked to",
    "lb_method": "string: the LB method (default, ip_hash, least_conn)",
    "backend_mode": "string: the backend mode (simple, lb)",
    "fw": "int: ID of the Firewall Profile",
    "type": "string: entry type single, range or dmz",
    "backend": "object: matching the syntax of the PortBackend module",
    "backends": "array: array of the above backend",
    "backend_protocol": "string: protocol used when communicating with the backend, ssl or default - (HTTP\/HTTPS) only",
    "keepalive": "int: maximum number of idle connections to keep open to the backend ready for new clients - (HTTP\/HTTPS) only"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Port::**delete**
Delete a Port object matching a query

* **URL**: https://www.x4b.net/apiv2/Port/delete
* **URL Params**: 

    **query[id]** - int: ID of the Port object

    **query[lower]** - int: the numerical port (low) on the filter side

    **query[upper]** - int: the numerical port (upper) on the filter side

    **query[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

    **query[domain]** - string: the protocol of the port. e.g http, ftp, tcp

    **query[method]** - string: the backend communication method of the port. e.g tunnel or rp

    **query[region]** - int: the region ID this port applies to, can be null if applies to all service regions

    **query[lease]** - int: The lease ID linked to

    **query[lb_method]** - string: the LB method (default, ip_hash, least_conn)

    **query[backend_mode]** - string: the backend mode (simple, lb)

    **query[backend_protocol]** - not documented

    **query[keepalive]** - not documented

* **Returns**: 
```
{
    "status": "ok"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Port::**all**
Get the value of a Port objects matching a query

* **URL**: https://www.x4b.net/apiv2/Port/all
* **URL Params**: 

    **query[id]** - int: ID of the Port object

    **query[lower]** - int: the numerical port (low) on the filter side

    **query[upper]** - int: the numerical port (upper) on the filter side

    **query[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

    **query[domain]** - string: the protocol of the port. e.g http, ftp, tcp

    **query[method]** - string: the backend communication method of the port. e.g tunnel or rp

    **query[region]** - int: the region ID this port applies to, can be null if applies to all service regions

    **query[lease]** - int: The lease ID linked to

    **query[lb_method]** - string: the LB method (default, ip_hash, least_conn)

    **query[backend_mode]** - string: the backend mode (simple, lb)

    **query[backend_protocol]** - not documented

    **query[keepalive]** - not documented

    **page** - optional structure with "start" and "limit" members to page the output

* **Returns**: 
```
[
    {
        "id": "int: ID of the Port object",
        "lower": "int: the numerical port (low) on the filter side",
        "upper": "int: the numerical port (upper) on the filter side",
        "protocol": "string: the protocol of the port. e.g http, ftp, tcp",
        "domain": "string: domain name (optional) - (HTTP\/HTTPS) only",
        "method": "string: the backend communication method of the port. e.g tunnel or rp",
        "region": "int: the region ID this port applies to, can be null if applies to all service regions",
        "lease": "int: The lease ID linked to",
        "lb_method": "string: the LB method (default, ip_hash, least_conn)",
        "backend_mode": "string: the backend mode (simple, lb)",
        "fw": "int: ID of the Firewall Profile",
        "type": "string: entry type single, range or dmz",
        "backend": "object: matching the syntax of the PortBackend module",
        "backends": "array: array of the above backend",
        "backend_protocol": "string: protocol used when communicating with the backend, ssl or default - (HTTP\/HTTPS) only",
        "keepalive": "int: maximum number of idle connections to keep open to the backend ready for new clients - (HTTP\/HTTPS) only"
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Port::**describe**
Provides any available description for the Port API module

* **URL**: https://www.x4b.net/apiv2/Port/describe
* **URL Params**: 

* **Returns**: this
* **Error Response**: 
```
{
    "error": "Error Message"
}
```

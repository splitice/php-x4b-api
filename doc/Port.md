Port API Module
---

## create
Create a new Port object

* **URL**: https://www.x4b.net/apiv2/Port/create
* **URL Params**: 
**value[lower]** - int: the numerical port (low) on the filter side

**value[upper]** - int: the numerical port (upper) on the filter side

**value[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

**value[method]** - string: the backend communication method of the port. e.g tunnel, vpn, rp

**value[server]** - int: the server ID this port applies to, can be null if applies to all servers

**value[lease]** - int: The lease ID linked to

**value[lb_method]** - string: the LB method (default, ip_hash, least_conn)

**value[backend_mode]** - string: the backend mode (simple, lb)

**value[type]** - string: entry type single, range or dmz

**value[backend]** - object: matching the syntax of the PortBackend moduley

**value[domain]** - string: domain name (optional) - (HTTP/HTTPS) only

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
## insert
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
## get
Get the value of a Port object matching a query

* **URL**: https://www.x4b.net/apiv2/Port/get
* **URL Params**: 
**query[id]** - int: ID of the Port object

**query[lower]** - int: the numerical port (low) on the filter side

**query[upper]** - int: the numerical port (upper) on the filter side

**query[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

**query[method]** - string: the backend communication method of the port. e.g tunnel, vpn, rp

**query[server]** - int: the server ID this port applies to, can be null if applies to all servers

**query[lease]** - int: The lease ID linked to

**query[lb_method]** - string: the LB method (default, ip_hash, least_conn)

**query[backend_mode]** - string: the backend mode (simple, lb)

* **Returns**: 
```
{
    "id": "int: ID of the Port object",
    "lower": "int: the numerical port (low) on the filter side",
    "upper": "int: the numerical port (upper) on the filter side",
    "protocol": "string: the protocol of the port. e.g http, ftp, tcp",
    "method": "string: the backend communication method of the port. e.g tunnel, vpn, rp",
    "server": "int: the server ID this port applies to, can be null if applies to all servers",
    "lease": "int: The lease ID linked to",
    "lb_method": "string: the LB method (default, ip_hash, least_conn)",
    "backend_mode": "string: the backend mode (simple, lb)",
    "fw": "int: ID of the Firewall Profile",
    "type": "string: entry type single, range or dmz",
    "backend": "object: matching the syntax of the PortBackend moduley",
    "domain": "string: domain name (optional) - (HTTP\/HTTPS) only",
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
## update
Change the values in a Port object

* **URL**: https://www.x4b.net/apiv2/Port/update
* **URL Params**: 
**query[id]** - int: ID of the Port object

**query[lower]** - int: the numerical port (low) on the filter side

**query[upper]** - int: the numerical port (upper) on the filter side

**query[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

**query[method]** - string: the backend communication method of the port. e.g tunnel, vpn, rp

**query[server]** - int: the server ID this port applies to, can be null if applies to all servers

**query[lease]** - int: The lease ID linked to

**query[lb_method]** - string: the LB method (default, ip_hash, least_conn)

**query[backend_mode]** - string: the backend mode (simple, lb)

**value[lower]** - int: the numerical port (low) on the filter side

**value[upper]** - int: the numerical port (upper) on the filter side

**value[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

**value[method]** - string: the backend communication method of the port. e.g tunnel, vpn, rp

**value[server]** - int: the server ID this port applies to, can be null if applies to all servers

**value[lease]** - int: The lease ID linked to

**value[lb_method]** - string: the LB method (default, ip_hash, least_conn)

**value[backend_mode]** - string: the backend mode (simple, lb)

**value[type]** - string: entry type single, range or dmz

**value[backend]** - object: matching the syntax of the PortBackend moduley

**value[domain]** - string: domain name (optional) - (HTTP/HTTPS) only

**value[backend_protocol]** - string: protocol used when communicating with the backend, ssl or default - (HTTP/HTTPS) only

**value[keepalive]** - int: maximum number of idle connections to keep open to the backend ready for new clients - (HTTP/HTTPS) only

* **Returns**: 
```
{
    "id": "int: ID of the Port object",
    "lower": "int: the numerical port (low) on the filter side",
    "upper": "int: the numerical port (upper) on the filter side",
    "protocol": "string: the protocol of the port. e.g http, ftp, tcp",
    "method": "string: the backend communication method of the port. e.g tunnel, vpn, rp",
    "server": "int: the server ID this port applies to, can be null if applies to all servers",
    "lease": "int: The lease ID linked to",
    "lb_method": "string: the LB method (default, ip_hash, least_conn)",
    "backend_mode": "string: the backend mode (simple, lb)",
    "fw": "int: ID of the Firewall Profile",
    "type": "string: entry type single, range or dmz",
    "backend": "object: matching the syntax of the PortBackend moduley",
    "domain": "string: domain name (optional) - (HTTP\/HTTPS) only",
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
## delete
Delete a Port object matching a query

* **URL**: https://www.x4b.net/apiv2/Port/delete
* **URL Params**: 
**query[id]** - int: ID of the Port object

**query[lower]** - int: the numerical port (low) on the filter side

**query[upper]** - int: the numerical port (upper) on the filter side

**query[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

**query[method]** - string: the backend communication method of the port. e.g tunnel, vpn, rp

**query[server]** - int: the server ID this port applies to, can be null if applies to all servers

**query[lease]** - int: The lease ID linked to

**query[lb_method]** - string: the LB method (default, ip_hash, least_conn)

**query[backend_mode]** - string: the backend mode (simple, lb)

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
## all
Get the value of a Port objects matching a query

* **URL**: https://www.x4b.net/apiv2/Port/all
* **URL Params**: 
**query[id]** - int: ID of the Port object

**query[lower]** - int: the numerical port (low) on the filter side

**query[upper]** - int: the numerical port (upper) on the filter side

**query[protocol]** - string: the protocol of the port. e.g http, ftp, tcp

**query[method]** - string: the backend communication method of the port. e.g tunnel, vpn, rp

**query[server]** - int: the server ID this port applies to, can be null if applies to all servers

**query[lease]** - int: The lease ID linked to

**query[lb_method]** - string: the LB method (default, ip_hash, least_conn)

**query[backend_mode]** - string: the backend mode (simple, lb)

* **Returns**: 
```
[
    {
        "id": "int: ID of the Port object",
        "lower": "int: the numerical port (low) on the filter side",
        "upper": "int: the numerical port (upper) on the filter side",
        "protocol": "string: the protocol of the port. e.g http, ftp, tcp",
        "method": "string: the backend communication method of the port. e.g tunnel, vpn, rp",
        "server": "int: the server ID this port applies to, can be null if applies to all servers",
        "lease": "int: The lease ID linked to",
        "lb_method": "string: the LB method (default, ip_hash, least_conn)",
        "backend_mode": "string: the backend mode (simple, lb)",
        "fw": "int: ID of the Firewall Profile",
        "type": "string: entry type single, range or dmz",
        "backend": "object: matching the syntax of the PortBackend moduley",
        "domain": "string: domain name (optional) - (HTTP\/HTTPS) only",
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
## describe
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
